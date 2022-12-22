/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';

type LabelProps = {
  style?: SerializedStyles;
} & ComponentProps<'label'>;

export const Label = ({ style, children }: LabelProps) => {
  return (
    <label
      css={css`
        color: ${theme.gray};
        font-weight: bold;
        font-size: 1rem;
      `}
    >
      {children}
    </label>
  );
};
