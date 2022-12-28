import { useRouter } from 'next/router';
import { useRecoilState } from 'recoil';
import { userState } from '../../../../../store/auth';
import { Header } from '../../PresentationalComponents/Header';
import useSWR, { mutate } from 'swr';
import { Note, NoteBrief } from '../../../../../types/noteClient/Note';
import axios from 'axios';
import { SerializedStyles } from '@emotion/react';

const fetchNote = async (token: string, noteId?: string): Promise<Note> => {
  if (!noteId) {
    throw new Error('note id is undefined');
  }

  const response = await axios.get<Note>(`${process.env.NEXT_PUBLIC_API_URL}/api/notes/${noteId}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  return response.data;
};

const saveNoteTitle = async (token: string, noteBrief: NoteBrief) => {
  const response = await axios.put<Note[]>(
    `${process.env.NEXT_PUBLIC_API_URL}/api/notes/${noteBrief.noteId}/title`,
    {
      title: noteBrief.title,
    },
    {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    },
  );

  return response.data;
};

type HeaderContainerProps = {
  style?: SerializedStyles;
};

export const HeaderContainer = ({ style }: HeaderContainerProps) => {
  const router = useRouter();
  const [user] = useRecoilState(userState);
  const { data, error, isLoading, mutate } = useSWR<Note>(`/api/notes/${router.query.noteId}`, () =>
    fetchNote(user.token, router.query.noteId as string),
  );

  const changeNoteTitle = async (value: string) => {
    mutate({ ...data, title: value }, false);
    saveNoteTitle(user.token, { noteId: data.noteId, title: value });
  };

  return <Header onChange={changeNoteTitle} isFetching={isLoading} error={error} title={data?.title} style={style} />;
};
