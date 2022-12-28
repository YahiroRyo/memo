/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';

type TransparentInputTextProps = {
  style?: SerializedStyles;
} & ComponentProps<'input'>;

export const TransparentInputText = ({ style, onChange, value }: TransparentInputTextProps) => {
  return (
    <input
      type='text'
      css={css`
        background-color: transparent;
        border: 0;
        color: ${theme.dark};
        padding: 0.5rem 1rem;
        width: 100%;

        ${style}
      `}
      onChange={onChange}
      value={value}
    />
  );
};
