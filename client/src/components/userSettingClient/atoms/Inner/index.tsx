/** @jsxImportSource @emotion/react */

import { css, SerializedStyles } from '@emotion/react';

type InnerProps = {
  children: React.ReactNode;
  style?: SerializedStyles;
};

export const Inner = ({ children, style }: InnerProps) => {
  return (
    <div
      css={css`
        width: 320px;
        margin: 0 auto;

        ${style}
      `}
    >
      {children}
    </div>
  );
};
