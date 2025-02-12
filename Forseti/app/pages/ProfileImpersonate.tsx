/*  Forseti: personal area & event control panel
 *  Copyright (C) 2023  o.klimenko aka ctizen
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
import { Redirect } from 'wouter';
import { useStorage } from '#/hooks/storage';

export const ProfileImpersonate: React.FC<{ params: { token: string; id: string } }> = ({
  params: { token, id },
}) => {
  const storage = useStorage();
  storage.setAuthToken(token).setPersonId(parseInt(id, 10));
  return <Redirect to='/profile/manage' />;
};
