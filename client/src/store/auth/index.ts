import { atom } from 'recoil';
import { recoilPersist } from 'recoil-persist';

const { persistAtom } = recoilPersist({
  storage: typeof window === 'undefined' ? undefined : sessionStorage,
});

type UserState = {
  token?: string;
};

export const userState = atom<UserState>({
  key: 'user',
  default: {
    token: null,
  },
  effects_UNSTABLE: [persistAtom],
});
