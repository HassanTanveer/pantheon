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

import * as React from 'react';
import { IComponentProps } from '#/components/IComponentProps';
import { EnterCredentialsScreen } from '#/components/screens/login/EnterCredentialsScreen';
import { Preloader } from '#/components/general/preloader/Preloader';
import { LoginErrorScreen } from '#/components/screens/login/LoginErrorScreen';

export const LoginScreen: React.FC<IComponentProps> = (props) => {
  const { state } = props;

  if (state.loading.login) {
    return <Preloader />;
  }

  if (state.loginError) {
    return <LoginErrorScreen {...props} />;
  }

  return <EnterCredentialsScreen {...props} />;
};
