/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { InputText } from '../../atoms/InputText';
import { Label } from '../../atoms/Label';
import { ValidRegister } from '../../../../types/userSettingClient/ValidRegister';

type InputTextGroupProps = {
  label: string;
  style?: SerializedStyles;
  validRegister?: ValidRegister;
} & ComponentProps<'input'>;

export const InputTextGroup = ({ label, style, placeholder, type, validRegister }: InputTextGroupProps) => {
  return (
    <div css={style}>
      <Label>{label}</Label>
      <br />
      <InputText
        style={css`
          margin-top: 0.5rem;
          width: 100%;
        `}
        placeholder={placeholder}
        type={type}
        validRegister={validRegister}
      />
    </div>
  );
};
