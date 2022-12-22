/** @jsxImportSource @emotion/react */
import { useRouter } from 'next/router';
import Header from '../../PresentationalComponents/Header';

export const HeaderContainer = () => {
  const router = useRouter();

  return <Header currentRoute={router.pathname} />;
};
