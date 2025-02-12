<?php
/*  Rheda: visualizer and control panel
 *  Copyright (C) 2016  o.klimenko aka ctizen
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Rheda;

use Common\GameConfig;

include_once __DIR__ . "/../helpers/Array.php";
include_once __DIR__ . "/../../../Common/YakuMap.php";

class GameFormatter
{
    /**
     * @param array $gamesData
     *
     * @return array
     */
    public function formatGamesData(&$gamesData)
    {
        $result = [];
        foreach ($gamesData['games'] as $gameId => $game) {
            $players = [];
            foreach ($game['players'] as $playerId) {
                $finalScore = $game['final_results'][$playerId];
                $players []= $this->_enrichWithInitials([
                    'tenhou_id' => $gamesData['players'][$playerId]['tenhou_id'],
                    'title' => $gamesData['players'][$playerId]['title'],
                    'score' => number_format($finalScore['score'], 0, '.', ','),
                    'label' => ($finalScore['rating_delta'] > 0
                        ? 'success'
                        : ($finalScore['rating_delta'] < 0
                            ? 'danger'
                            : 'info'
                        )
                    ),
                    'rating_delta' => ($finalScore['rating_delta'] > 0 ? '+' : '') .
                        number_format($finalScore['rating_delta'], 1, '.', ','),
                    'id' => $playerId
                ]);
            }

            $iterator = 0;
            $winds = ['東', '南', '西', '北'];
            foreach ($players as $key => $player) {
                $players[$key]['wind'] = $winds[$iterator];
                $iterator += 1;
            }

            // Some client-side stats
            $bestHan = 0;
            $bestFu = 0;
            $bestHandPlayers = [];
            $chomboCount = 0;
            $ronWins = 0;
            $doubleronWins = 0;
            $tripleronWins = 0;
            $tsumoWins = 0;
            $draws = 0;
            $firstYakuman = true;

            foreach ($game['rounds'] as $round) {
                switch ($round['outcome']) {
                    case 'ron':
                        $ronWins++;
                        break;
                    case 'multiron':
                        if ($round['multi_ron'] == 2) {
                            $doubleronWins ++;
                        }
                        if ($round['multi_ron'] == 3) {
                            $tripleronWins ++;
                        }
                        break;
                    case 'tsumo':
                        $tsumoWins++;
                        break;
                    case 'chombo':
                        $chomboCount++;
                        continue 2; // explicit continue to prevent further hands calc
                    case 'draw':
                        $draws++;
                        continue 2; // explicit continue to prevent further hands calc
                    case 'abort':
                        $draws++;
                        continue 2; // explicit continue to prevent further hands calc
                }

                if ($round['outcome'] != 'multiron') {
                    $roundsData = [$round];
                } else {
                    $roundsData = $round['wins'];
                }

                foreach ($roundsData as $roundData) {
                    if (empty($roundData['winner_id'])) {
                        continue;
                    }

                    $winner = $gamesData['players'][$roundData['winner_id']]['title'];

                    if ($roundData['han'] < 0) { // yakuman
                        $bestHan = $bestFu = 200;
                        if ($firstYakuman) {
                            $bestHandPlayers = [];
                            $firstYakuman = false;
                        }
                        array_push($bestHandPlayers, $winner);
                    }

                    if (($roundData['han'] > $bestHan) || ($roundData['han'] == $bestHan && $round['fu'] > $bestFu)) {
                        $bestHan = $roundData['han'];
                        $bestFu = $roundData['fu'];
                        $bestHandPlayers = [];
                        array_push($bestHandPlayers, $winner);
                    }

                    if ($roundData['han'] == $bestHan && $roundData['fu'] == $bestFu) {
                        if (!in_array($winner, $bestHandPlayers)) {
                            array_push($bestHandPlayers, $winner);
                        }
                    }
                }
            }

            $penalties = array_map(function ($p) use ($gamesData) {
                $p['who'] = $gamesData['players'][$p['who']]['title'];
                return $p;
            }, $game['penalties']);

            $result [] = [
                'index' => $gameId,
                'endDate' => $game['date'],
                'hash' => $game['hash'],
                'players' => $players,
                'replayLink' => empty($game['replay_link']) ? null : $game['replay_link'],
                'bestHandPlayers' => implode(', ', $bestHandPlayers),
                'bestHandCost' => ($bestHan == 200
                    ? _t('yakuman')
                    : ($bestHan > 4
                        ? _p('%d han', $bestHan)
                        : _p('%d han, %d fu', $bestHan, $bestFu)
                    )
                ),
                'ronWins' => $ronWins + 2 * $doubleronWins + 3 * $tripleronWins,
                'tsumoWins' => $tsumoWins,
                'draws' => $draws,
                'chombo' => $chomboCount,
                'penalties' => $penalties,
                'showPenalties' => !empty($penalties),
                'logItems' => $this->_makeLog($game['rounds'], $gamesData['players'])
            ];
        }

        return $result;
    }

    /**
     * @param array $array
     * @return array
     */
    protected function _enrichWithInitials(array $array)
    {
        // TODO: make more universal
        if (!empty($array['title'])) {
            $nameparts = explode(' ', $array['title']);
            $array['firstname'] = reset($nameparts);
            $array['surname'] = end($nameparts);
            $array['name_initial'] = mb_substr($nameparts[0], 0, 1, 'utf8');
            $array['display_short'] = $array['surname'] . ' ' . $array['name_initial'] . '.';
        }

        if (!empty($array['loserName'])) {
            $nameparts = explode(' ', $array['loserName']);
            $array['loserFirstname'] = reset($nameparts);
            $array['loserSurname'] = end($nameparts);
            $array['loserInitial'] = mb_substr($nameparts[0], 0, 1, 'utf8');
            $array['loserShort'] = $array['loserSurname'] . ' ' . $array['loserInitial'] . '.';
        }

        if (!empty($array['winnerName'])) {
            $nameparts = explode(' ', $array['winnerName']);
            $array['winnerFirstname'] = reset($nameparts);
            $array['winnerSurname'] = end($nameparts);
            $array['winnerInitial'] = mb_substr($nameparts[0], 0, 1, 'utf8');
            $array['winnerShort'] = $array['winnerSurname'] . ' ' . $array['winnerInitial'] . '.';
        }

        if (!empty($array['paoPlayerName'])) {
            $nameparts = explode(' ', $array['paoPlayerName']);
            $array['paoPlayerFirstname'] = reset($nameparts);
            $array['paoPlayerSurname'] = end($nameparts);
            $array['paoPlayerInitial'] = mb_substr($nameparts[0], 0, 1, 'utf8');
            $array['paoPlayerShort'] = $array['paoPlayerSurname'] . ' ' . $array['paoPlayerInitial'] . '.';
        }

        return $array;
    }

    /**
     * @param array $game
     * @param array $playersData
     * @return array
     */
    protected function _makeLog($game, &$playersData): array
    {
        $rounds = [];
        foreach ($game as $round) {
            $roundWind = '東';
            $roundIndex = $round['round_index'];

            if ($round['round_index'] > 4) {
                $roundWind = '南';
                $roundIndex = ($round['round_index'] - 4);
            }

            if ($round['round_index'] > 8) {
                $roundWind = '西';
                $roundIndex = ($round['round_index'] - 8);
            }

            if ($round['round_index'] > 12) {
                $roundWind = '北';
                $roundIndex = ($round['round_index'] - 12);
            }

            $riichiSource = ($round['outcome'] == 'multiron' ? $round['wins'][0] : $round);

            $rounds []= $this->_enrichWithInitials([
                'roundWind'         => $roundWind,
                'roundIndex'        => $roundIndex,
                'roundTypeRon'      => $round['outcome'] == 'ron',
                'roundTypeTsumo'    => $round['outcome'] == 'tsumo',
                'roundTypeDraw'     => $round['outcome'] == 'draw',
                'roundTypeAbort'    => $round['outcome'] == 'abort',
                'roundTypeChombo'   => $round['outcome'] == 'chombo',
                'roundTypeMultiRon' => $round['outcome'] == 'multiron',
                'roundTypeNagashi'  => $round['outcome'] == 'nagashi',

                'winnerName'        => isset($round['winner_id']) ? $playersData[$round['winner_id']]['title'] : null,
                'loserName'         => isset($round['loser_id']) ? $playersData[$round['loser_id']]['title'] : null,
                'paoPlayerName'     => !empty($round['pao_player_id']) ? $playersData[$round['pao_player_id']]['title'] : null,
                'yakuList'          => $this->_formatYaku($round),
                'doras'             => isset($round['dora']) ? $round['dora'] : null,
                'han'               => isset($round['han']) ? $round['han'] : null,
                'fu'                => isset($round['fu']) ? $round['fu'] : null,
                'yakuman'           => isset($round['han']) && $round['han'] < 0,
                'tempaiPlayers'     => $this->_formatCsvPlayersList($round, 'tempai', $playersData),
                'riichiPlayers'     => $this->_formatCsvPlayersList($riichiSource, 'riichi_bets', $playersData),
                'nagashiPlayers'    => $this->_formatCsvPlayersList($round, 'nagashi', $playersData),

                'multiRonWins'      => $this->_formatMultiron($round, $playersData),
                'doubleRon'         => $round['outcome'] == 'multiron' && count($round['wins']) == 2,
                'tripleRon'         => $round['outcome'] == 'multiron' && count($round['wins']) == 3,
            ]);
        }

        return $rounds;
    }

    /**
     * @param array $round
     * @return string|null
     */
    protected function _formatYaku(&$round): ?string
    {
        $yakuList = null;
        if (!empty($round['yaku'])) {
            $yakuList = implode(
                ', ',
                array_map(
                    function ($yaku) {
                        return \Common\YakuMap::getTranslations()[(int)$yaku];
                    },
                    explode(',', $round['yaku'])
                )
            );
        }

        return $yakuList;
    }

    /**
     * @param array $round
     * @param string $key
     * @param array $playersData
     * @return string|null
     */
    protected function _formatCsvPlayersList(&$round, string $key, &$playersData): ?string
    {
        $list = null;
        if (!empty($round[$key])) {
            $list = array_map(
                function ($el) use (&$playersData) {
                    return $playersData[$el]['title'];
                },
                array_unique(explode(',', $round[$key]))
            );
            $list = implode(', ', $list);
        }

        return $list;
    }

    /**
     * @param array $round
     * @param array $playersData
     * @return array|null
     */
    protected function _formatMultiron(&$round, &$playersData): ?array
    {
        $wins = null;
        if ($round['outcome'] == 'multiron' && !empty($round['wins'])) {
            $wins = array_map(function ($win) use (&$playersData, &$round) {
                return $this->_enrichWithInitials([
                    'winnerName'    => $playersData[$win['winner_id']]['title'],
                    'loserName'     => $playersData[$round['loser_id']]['title'],
                    'paoPlayerName' => empty($win['pao_player_id']) ? '' : $playersData[$win['pao_player_id']]['title'],
                    'han'           => $win['han'],
                    'fu'            => $win['fu'],
                    'yakuman'       => $win['han'] < 0,
                    'yakuList'      => $this->_formatYaku($win),
                    'doras'         => isset($win['dora']) ? $win['dora'] : null
                ]);
            }, $round['wins']);
        }

        return $wins;
    }
}
