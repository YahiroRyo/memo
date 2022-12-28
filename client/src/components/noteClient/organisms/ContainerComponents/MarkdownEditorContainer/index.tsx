import axios from 'axios';
import { useRecoilState } from 'recoil';
import { userState } from '../../../../../store/auth';
import { Note } from '../../../../../types/noteClient/Note';
import { MarkdownEditor } from '../../PresentationalComponents/MarkdownEditor';
import useSWR from 'swr';
import { useRouter } from 'next/router';

const fetchNote = async (token: string, noteId?: string, preNote?: Note): Promise<Note> => {
  if (!noteId) {
    throw new Error('note id is undefined');
  }

  try {
    const response = await axios.get<Note>(`${process.env.NEXT_PUBLIC_API_URL}/api/notes/${noteId}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    return response.data;
  } catch (e) {
    if (!preNote) throw e;
  }

  return preNote;
};

const saveNote = async (token: string, note: Note) => {
  try {
    const response = await axios.put<Note[]>(
      `${process.env.NEXT_PUBLIC_API_URL}/api/notes/${note.noteId}`,
      {
        title: note.title,
        body: note.body,
      },
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      },
    );

    return response.data;
  } catch (e) {}
};

export const MarkdownEditorContainer = () => {
  const router = useRouter();
  const [user] = useRecoilState(userState);
  const { data, error, isLoading, mutate } = useSWR<Note>(
    `/api/notes/${router.query.noteId}`,
    () => fetchNote(user.token, router.query.noteId as string, data),
    {
      dedupingInterval: 36000000,
      revalidateOnFocus: false,
      revalidateOnMount: false,
      revalidateOnReconnect: false,
    },
  );

  const changeBodyHandler = (value) => {
    mutate({ ...data, body: value }, false);
  };

  const onFocusOut = async () => {
    await saveNote(user.token, data);
  };

  const saveBodyHandler = async () => {
    await saveNote(user.token, data);
  };

  return (
    <MarkdownEditor
      isFetching={isLoading}
      error={error}
      onSave={saveBodyHandler}
      onChange={changeBodyHandler}
      onFocusOut={onFocusOut}
      value={data?.body}
    />
  );
};
