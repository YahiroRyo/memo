/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import Link from 'next/link';
import { theme } from '../../../../styles/userSettingClient/theme';

export const AppLogo = () => {
  return (
    <Link
      href='/'
      css={css`
        font-weight: bold;
        font-size: 1.25rem;
        color: ${theme.dark};
        text-decoration: none;
      `}
    >
      MemoApp
    </Link>
  );
};
