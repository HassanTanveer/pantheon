/* Tyr - Japanese mahjong assistant application
 * Copyright (C) 2016 Oleg Klimenko aka ctizen
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

export enum ArrowState {
  UNAVAILABLE,
  AVAILABLE,
  DISABLED,
}

export enum SelectHandActiveTab {
  YAKU = 'Yaku',
  TOTAL = 'Total',
}

export type YakuItem = {
  name: string;
  onClick: () => void;
  disabled?: boolean;
  pressed?: boolean;
};

export type YakuGroup = YakuItem[];
