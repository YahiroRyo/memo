/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import Link from 'next/link';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';

type NonUnderlinedButtonProps = {
  style?: SerializedStyles;
  href: string;
} & ComponentProps<'button'>;

export const NonUnderlinedButton = ({ children, style, href }: NonUnderlinedButtonProps) => {
  return (
    <Link
      href={href}
      css={css`
        height: 100%;

        ${style}
      `}
    >
      <button
        css={css`
          border: 0;
          color: ${theme.dark};
          font-weight: bold;
          transition: 0.3s;
          background-color: ${theme.lightWhite};
          display: inline-block;
          font-size: 0.9rem;
          height: 100%;
          padding: 0 1.5rem;

          &:hover {
            color: ${theme.orange};
            cursor: pointer;
            position: relative;

            &:after {
              bottom: 0.1rem;
              content: '';
              position: absolute;
              left: 0;
              height: 2px;
              width: 100%;
              background-color: ${theme.orange};
            }
          }

          ${style}
        `}
      >
        {children}
      </button>
    </Link>
  );
};
