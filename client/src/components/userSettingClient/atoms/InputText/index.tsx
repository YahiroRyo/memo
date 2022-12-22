/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';
import { ValidRegister } from '../../../../types/userSettingClient/ValidRegister';

type InputTextProps = {
  style?: SerializedStyles;
  validRegister?: ValidRegister;
} & ComponentProps<'input'>;

export const InputText = ({ placeholder, style, validRegister, type }: InputTextProps) => {
  return (
    <input
      {...validRegister?.register(validRegister.name, validRegister.valid)}
      type={type}
      css={css`
        border-radius: 8px;
        border: 1px solid ${theme.lightGray};
        background-color: ${theme.lightWhite};
        color: ${theme.gray};
        padding: 1rem;
        transition: 0.3s;
        font-size: 1rem;
        letter-spacing: 1px;
        box-sizing: border-box;

        &:focus {
          outline: 0;
          border: 1px solid ${theme.darkOrange};
          box-shadow: 0 0 0 0.25rem rgb(176 140 96 / 32%);
          color: ${theme.dark};
        }

        ${style}
      `}
      placeholder={placeholder}
    />
  );
};
