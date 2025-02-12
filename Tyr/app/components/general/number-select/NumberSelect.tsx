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
import { SelectNumberModal } from './SelectNumberModal';
import './number-select.css';
import classNames from 'classnames';
import { i18n } from '#/components/i18n';
import { I18nService } from '#/services/i18n';

type IProps = {
  value: number;
  possibleValues: number[];
  onChange: (value: number) => void;
};

type IState = {
  isModalShown: boolean;
};

export class NumberSelect extends React.Component<IProps, IState> {
  static contextType = i18n;

  constructor(props: IProps) {
    super(props);

    this.state = { isModalShown: false };
  }

  private onValueClick() {
    const { possibleValues } = this.props;
    if (possibleValues.length !== 0) {
      this.setState({
        isModalShown: true,
      });
    }
  }

  private onValueSelect(value: number) {
    const { onChange } = this.props;
    this.hideModal();
    onChange(value);
  }

  private hideModal() {
    this.setState({
      isModalShown: false,
    });
  }

  private get canDecrease(): boolean {
    const { value, possibleValues } = this.props;
    return value > possibleValues[0];
  }

  private get canIncrease(): boolean {
    const { value, possibleValues } = this.props;
    return value < possibleValues[possibleValues.length - 1];
  }

  private decrease() {
    if (this.canDecrease) {
      const { value, possibleValues, onChange } = this.props;
      const index = possibleValues.indexOf(value);
      const newValue = possibleValues[index - 1];
      onChange(newValue);
    }
  }

  private increase() {
    if (this.canIncrease) {
      const { value, possibleValues, onChange } = this.props;
      const index = possibleValues.indexOf(value);
      const newValue = possibleValues[index + 1];
      onChange(newValue);
    }
  }

  render() {
    const loc = this.context as I18nService;
    const { value, possibleValues } = this.props;
    const { isModalShown } = this.state;
    const valueNotInArray = possibleValues.length !== 0 && !possibleValues.includes(value);
    const displayValue = possibleValues.length === 0 || valueNotInArray ? '?' : value;
    if (valueNotInArray) {
      alert(loc._t('something goes wrong, please contact your administrator'));
    }

    return (
      <div className='number-select'>
        <div
          className={classNames('number-select__minus svg-button svg-button--xsmall', {
            'svg-button--disabled': !this.canDecrease,
          })}
          onClick={this.decrease.bind(this)}
        >
          <svg>
            <path d='M 6 12 H 18' stroke='currentColor' strokeWidth={2} fill='none' />
          </svg>
        </div>
        <div className='number-select__value' onClick={this.onValueClick.bind(this)}>
          {displayValue}
        </div>
        <div
          className={classNames('number-select__plus svg-button svg-button--xsmall', {
            'svg-button--disabled': !this.canIncrease,
          })}
          onClick={this.increase.bind(this)}
        >
          <svg>
            <path d='M 6 12 H 18' stroke='currentColor' strokeWidth={2} fill='none' />
            <path d='M 12 6 V 18' stroke='currentColor' strokeWidth={2} fill='none' />
          </svg>
        </div>
        {isModalShown && (
          <SelectNumberModal
            onChange={this.onValueSelect.bind(this)}
            possibleValues={possibleValues}
            onHide={this.hideModal.bind(this)}
          />
        )}
      </div>
    );
  }
}
