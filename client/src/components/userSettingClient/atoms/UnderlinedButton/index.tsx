/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import Link from 'next/link';
import { ComponentProps } from 'react';
import { theme } from '../../../../styles/userSettingClient/theme';

type UnderlinedButtonProps = {
  style?: SerializedStyles;
  href: string;
} & ComponentProps<'button'>;

export const UnderlinedButton = ({ children, style, href }: UnderlinedButtonProps) => {
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
          color: ${theme.red};
          font-weight: bold;
          transition: 0.3s;
          background-color: ${theme.lightWhite};
          display: inline-block;
          font-size: 0.9rem;
          position: relative;
          height: 100%;

          &:after {
            bottom: 0.1rem;
            content: '';
            position: absolute;
            left: 0;
            height: 2px;
            width: 100%;
            background-color: ${theme.red};
          }

          &:hover {
            color: ${theme.orange};
            cursor: pointer;

            &:after {
              background-color: ${theme.orange};
            }
          }
        `}
      >
        {children}
      </button>
    </Link>
  );
};
