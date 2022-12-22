import axios from 'axios';
import type { AppProps } from 'next/app';
import '../styles/userSettingClient/global.scss';

// This default export is required in a new `pages/_app.js` file.
export default function MyApp({ Component, pageProps }: AppProps) {
  axios.defaults.withCredentials = true;

  return <Component {...pageProps} />;
}
