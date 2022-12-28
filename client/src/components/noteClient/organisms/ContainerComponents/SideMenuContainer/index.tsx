/** @jsxImportSource @emotion/react */
import axios from 'axios';
import { useRecoilState } from 'recoil';
import { userState } from '../../../../../store/auth';
import { NoteBrief, Note } from '../../../../../types/noteClient/Note';
import { SideMenu } from '../../PresentationalComponents/SideMenu';
import useSWR from 'swr';
import { useRouter } from 'next/router';

const fetchNotesBrief = async (token: string): Promise<NoteBrief[]> => {
  const response = await axios.get<NoteBrief[]>(`${process.env.NEXT_PUBLIC_API_URL}/api/notes`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  return response.data;
};

const addNote = async (token: string, title: string): Promise<string> => {
  const response = await axios.post<string>(
    `${process.env.NEXT_PUBLIC_API_URL}/api/notes`,
    {
      title: title,
      body: '',
    },
    {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    },
  );

  return response.data;
};

export const SideMenuContainer = () => {
  const router = useRouter();
  const [user] = useRecoilState(userState);
  const { data, error, isLoading, mutate } = useSWR('/api/notes', () => fetchNotesBrief(user.token));

  const clickNoteItemHandler = async (noteBrief: NoteBrief): Promise<void> => {
    mutate();
    router.push(`/notes/${noteBrief.noteId}`);
  };

  const clickAddNoteItemHandler = async (): Promise<void> => {
    const title = '無題';
    const noteId = await addNote(user.token, title);
    mutate([...data, { noteId: noteId, title: title }]);
  };

  return (
    <SideMenu
      isFetchingNotes={isLoading}
      notes={data}
      currentNoteId={router.query.noteId as string}
      clickNoteItemHandler={clickNoteItemHandler}
      clickAddNoteItemHandler={clickAddNoteItemHandler}
    />
  );
};
