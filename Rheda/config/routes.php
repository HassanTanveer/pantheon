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

return [ // Omit trailing slashes in keys when possible
    ''                => 'Mainpage', // empty path for mainpage
    '/last'           => 'LastGames',
    '/last/page/(?<page>[0-9]+)' => 'LastGames',
    '/add-online'     => 'AddOnlineGame',
    '/user'           => 'PersonalStats',
    '/user/(?<user>[0-9]+)' => 'PersonalStats',
    '/game'           => 'Game',
    '/game/(?<hash>[0-9a-f]+)' => 'Game',
    '/stat/team'      => 'TeamTable',
    '/stat'           => 'RatingTable',
    '/stat/.+'        => 'RatingTable',
    '/timer'          => 'Timer',
    '/timer/.+'       => 'Timer',

    '/achievements'    => 'Achievements',
    '/achievements/(?<achievement>[0-9a-zA-Z]+)' => 'Achievements',

    // Eventless paths (exclamation mark is a special symbol here)
    '!'                      => 'MultieventMainpage',
    '!/page/(?<page>[0-9]+)' => 'MultieventMainpage',
    '!/favicon.ico'          => 'MultieventMainpage',
];
