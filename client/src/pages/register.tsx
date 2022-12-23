/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import { HeaderContainer } from '../components/userSettingClient/organisms/ContainerComponents/HeaderContainer';
import { RegisterFormContainer } from '../components/userSettingClient/organisms/ContainerComponents/RegisterFormContainer';

const RegisterUser = () => {
  return (
    <div
      css={css`
        height: 100vh;
      `}
    >
      <HeaderContainer />
      <RegisterFormContainer
        style={css`
          height: 100%;
        `}
      />
    </div>
  );
};

export default RegisterUser;
