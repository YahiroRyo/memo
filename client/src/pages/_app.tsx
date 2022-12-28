import axios from 'axios';
import { RecoilRoot } from 'recoil';
import type { AppProps } from 'next/app';
import '../styles/global.scss';

// This default export is required in a new `pages/_app.js` file.
const App = ({ Component, pageProps }: AppProps) => {
  axios.defaults.withCredentials = true;

  return (
    <RecoilRoot>
      <Component {...pageProps} />
    </RecoilRoot>
  );
};

export default App;
