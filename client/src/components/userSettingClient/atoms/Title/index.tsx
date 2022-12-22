/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';

type TitleProps = {
  style?: SerializedStyles;
} & ComponentProps<'h1'>;

export const Title = ({ style, children }: TitleProps) => {
  return (
    <h1
      css={css`
        color: ${theme.dark};
        font-weight: bold;
        font-size: 1.5rem;
        text-align: center;

        ${style};
      `}
    >
      {children}
    </h1>
  );
};
