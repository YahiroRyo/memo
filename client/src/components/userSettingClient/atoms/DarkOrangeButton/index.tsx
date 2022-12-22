/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { hexToRgb } from '../../../../modules/Color';
import { theme } from '../../../../styles/userSettingClient/theme';

type DarkOrangeButtonProps = {
  style?: SerializedStyles;
} & ComponentProps<'button'>;

export const DarkOrangeButton = ({ style, children, disabled }: DarkOrangeButtonProps) => {
  return (
    <button
      css={css`
        background-color: ${theme.darkOrange};
        box-shadow: 0 2px 0.5rem rgba(${hexToRgb(theme.dark)}, 0.25);
        color: ${theme.white};
        font-weight: bold;
        border: 0;
        padding: 1rem 3rem;
        border-radius: 0.5rem;
        letter-spacing: 1px;
        display: block;

        &:disabled {
          box-shadow: 0 0 0;
          background-color: ${theme.darkOrange};
          opacity: 0.32;
        }
        &:hover {
          cursor: pointer;

          &:disabled {
            cursor: default;
          }
        }

        ${style}
      `}
      disabled={disabled}
    >
      {children}
    </button>
  );
};
