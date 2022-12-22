/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { ErrorIcon } from '../../atoms/ErrorIcon';
import { ErrorText } from '../../atoms/ErrorText';

type ValidationErrorProps = {
  style?: SerializedStyles;
  children: React.ReactNode;
};

export const ValidationError = ({ style, children }: ValidationErrorProps) => {
  return (
    <div
      css={css`
        display: grid;
        column-gap: 0.5rem;
        align-items: center;
        grid-template-columns: 1rem 1fr;

        ${style};
      `}
    >
      <ErrorIcon />
      <ErrorText>{children}</ErrorText>
    </div>
  );
};
