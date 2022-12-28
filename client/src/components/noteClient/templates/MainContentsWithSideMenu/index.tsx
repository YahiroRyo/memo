/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import { SideMenuContainer } from '../../organisms/ContainerComponents/SideMenuContainer';

type MainContentsWithSideMenuProps = {
  children: React.ReactNode;
};

export const MainContentsWithSideMenu = ({ children }: MainContentsWithSideMenuProps) => {
  return (
    <div
      css={css`
        display: flex;
      `}
    >
      <SideMenuContainer />
      <div
        css={css`
          padding: 0 1rem;
          width: 100%;
          height: 100%;
        `}
      >
        {children}
      </div>
    </div>
  );
};
