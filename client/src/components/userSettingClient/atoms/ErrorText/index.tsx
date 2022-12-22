/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';

type ErrorTextProps = {
  style?: SerializedStyles;
} & ComponentProps<'h1'>;

export const ErrorText = ({ style, children }: ErrorTextProps) => {
  return (
    <p
      css={css`
        color: ${theme.error};
        font-weight: bold;
        font-size: 0.9rem;
        ${style};
      `}
    >
      {children}
    </p>
  );
};
