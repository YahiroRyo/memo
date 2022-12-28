/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { theme } from '../../../../../styles/noteClient/theme';
import { NoteBrief } from '../../../../../types/noteClient/Note';
import { ActiveNoteIcon } from '../../../atoms/ActiveNoteIcon';
import { NonActiveNoteIcon } from '../../../atoms/NonActiveNoteIcon';
import { PlusIcon } from '../../../atoms/PlusIcon';
import { ActiveSelectItem } from '../../../molecules/ActiveSelectItem';
import { NonActiveSelectItem } from '../../../molecules/NonActiveSelectItem';

type SideMenuProps = {
  isFetchingNotes: boolean;
  notes: NoteBrief[];
  currentNoteId?: string;
  style?: SerializedStyles;
  clickNoteItemHandler: (note: NoteBrief) => void;
  clickAddNoteItemHandler: () => void;
};

export const SideMenu = ({
  isFetchingNotes,
  notes,
  currentNoteId,
  style,
  clickNoteItemHandler,
  clickAddNoteItemHandler,
}: SideMenuProps) => {
  if (isFetchingNotes) {
    return <></>;
  }

  const noteElements = notes.map((note) => {
    if (note.noteId === currentNoteId) {
      return (
        <ActiveSelectItem
          icon={<ActiveNoteIcon />}
          key={note.noteId}
          onClick={() => clickNoteItemHandler(note)}
          style={css`
            padding: 0.5rem 1rem;
          `}
        >
          {note.title}
        </ActiveSelectItem>
      );
    }

    return (
      <NonActiveSelectItem
        icon={<NonActiveNoteIcon />}
        key={note.noteId}
        onClick={() => clickNoteItemHandler(note)}
        style={css`
          padding: 0.5rem 1rem;
        `}
      >
        {note.title}
      </NonActiveSelectItem>
    );
  });

  return (
    <ul
      css={css`
        width: 25%;
        height: 100vh;
        background-color: ${theme.lightGray2};
        overflow-y: auto;

        ${style}
      `}
    >
      {noteElements}

      <NonActiveSelectItem
        onClick={clickAddNoteItemHandler}
        icon={<PlusIcon />}
        style={css`
          padding: 0.5rem;
        `}
      >
        ノート追加
      </NonActiveSelectItem>
    </ul>
  );
};
