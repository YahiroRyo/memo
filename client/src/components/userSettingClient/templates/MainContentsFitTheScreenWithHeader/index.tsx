/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import { HeaderContainer } from '../../organisms/ContainerComponents/HeaderContainer';

type MainContentsWithHeaderProps = {
  children: React.ReactNode;
};

export const MainContentsFitTheScreenWithHeader = ({ children }: MainContentsWithHeaderProps) => {
  return (
    <div
      css={css`
        height: 100vh;
      `}
    >
      <HeaderContainer />
      <div
        css={css`
          height: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
        `}
      >
        {children}
      </div>
    </div>
  );
};
