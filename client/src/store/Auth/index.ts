import { atom } from 'recoil';
import { recoilPersist } from 'recoil-persist';

const { persistAtom } = recoilPersist();

type UserState = {
  token: string | null;
};

export const userState = atom<UserState>({
  key: 'user',
  default: {
    token: null,
  },
  effects_UNSTABLE: [persistAtom],
});
