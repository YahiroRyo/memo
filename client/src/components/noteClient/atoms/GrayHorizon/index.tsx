/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { theme } from '../../../../styles/noteClient/theme';

type GrayHorizonProps = {
  style?: SerializedStyles;
};

export const GrayHorizon = ({ style }: GrayHorizonProps) => {
  return (
    <div
      css={css`
        background-color: ${theme.gray};
        width: 100%;
        height: 1px;

        ${style}
      `}
    ></div>
  );
};
