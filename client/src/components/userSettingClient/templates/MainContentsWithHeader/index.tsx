/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import { HeaderContainer } from '../../organisms/ContainerComponents/HeaderContainer';

type MainContentsWithHeaderProps = {
  children: React.ReactNode;
};

export const MainContentsWithHeader = ({ children }: MainContentsWithHeaderProps) => {
  return (
    <div>
      <HeaderContainer />
      <>{children}</>
    </div>
  );
};
