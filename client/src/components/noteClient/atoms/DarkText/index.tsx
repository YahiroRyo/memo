/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/noteClient/theme';

type DarkTextProps = {
  style?: SerializedStyles;
} & ComponentProps<'p'>;

export const DarkText = ({ style, children }: DarkTextProps) => {
  return (
    <p
      css={css`
        color: ${theme.dark};
        font-size: 1rem;
        ${style}
      `}
    >
      {children}
    </p>
  );
};
