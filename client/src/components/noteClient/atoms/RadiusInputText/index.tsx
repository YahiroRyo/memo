/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';

type RadiusInputTextProps = {
  style?: SerializedStyles;
} & ComponentProps<'input'>;

export const RadiusInputText = ({ style, onChange, value }: RadiusInputTextProps) => {
  return (
    <input
      type='text'
      css={css`
        background-color: ${theme.lightWhite};
        border-radius: 1rem;
        padding: 0.5rem 1rem;

        ${style}
      `}
      onChange={onChange}
      value={value}
    />
  );
};
