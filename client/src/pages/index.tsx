/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import { HeaderContainer } from '../components/userSettingClient/organisms/ContainerComponents/HeaderContainer';
import { LoginFormContainer } from '../components/userSettingClient/organisms/ContainerComponents/LoginFormContainer';

const Login = () => {
  return (
    <div
      css={css`
        height: 100vh;
      `}
    >
      <HeaderContainer />
      <LoginFormContainer />
    </div>
  );
};

export default Login;
