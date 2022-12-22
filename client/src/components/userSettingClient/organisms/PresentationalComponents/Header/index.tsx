/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { hexToRgb } from '../../../../../modules/Color';
import { theme } from '../../../../../styles/userSettingClient/theme';
import { AppLogo } from '../../../atoms/AppLogo';
import { UnderlineButton } from '../../../molecules/UnderlineButton';

type HeaderProps = {
  style?: SerializedStyles;
  currentRoute: string;
};

const Header = ({ style, currentRoute }: HeaderProps) => {
  return (
    <header
      css={css`
        align-items: center;
        box-shadow: 0 8px 1rem rgba(${hexToRgb(theme.darkOrange)}, 0.25);
        box-sizing: border-box;
        background-color: ${theme.lightWhite};
        display: flex;
        height: 54px;
        justify-content: space-between;
        padding: 0 2rem;
        position: fixed;
        top: 0;
        width: 100%;

        ${style}
      `}
    >
      <AppLogo />
      <div
        css={css`
          display: flex;
          align-items: center;
          justify-content: center;
          column-gap: 2rem;
          height: 100%;
        `}
      >
        <UnderlineButton href='/' isEnable={currentRoute === '/'}>
          ログイン
        </UnderlineButton>
        <UnderlineButton href='/register' isEnable={currentRoute === '/register'}>
          新規作成
        </UnderlineButton>
      </div>
    </header>
  );
};

export default Header;
