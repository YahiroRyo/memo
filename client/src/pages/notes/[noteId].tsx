/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import { HeaderContainer } from '../../components/noteClient/organisms/ContainerComponents/HeaderContainer';
import { MarkdownEditorContainer } from '../../components/noteClient/organisms/ContainerComponents/MarkdownEditorContainer';
import { MainContentsWithSideMenu } from '../../components/noteClient/templates/MainContentsWithSideMenu';

const Notes = () => {
  return (
    <MainContentsWithSideMenu>
      <HeaderContainer
        style={css`
          margin-bottom: 1rem;
        `}
      />
      <MarkdownEditorContainer />
    </MainContentsWithSideMenu>
  );
};

export default Notes;
