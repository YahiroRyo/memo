/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/noteClient/theme';

type DarkTextProps = {
  style?: SerializedStyles;
} & ComponentProps<'p'>;

export const GrayText = ({ style, children }: DarkTextProps) => {
  return (
    <p
      css={css`
        color: ${theme.gray};
        font-size: 1rem;
        ${style}
      `}
    >
      {children}
    </p>
  );
};
