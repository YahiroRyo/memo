/** @jsxImportSource @emotion/react */
import { LoginFormContainer } from '../components/userSettingClient/organisms/ContainerComponents/LoginFormContainer';
import { MainContentsFitTheScreenWithHeader } from '../components/userSettingClient/templates/MainContentsFitTheScreenWithHeader';

const Login = () => {
  return (
    <MainContentsFitTheScreenWithHeader>
      <LoginFormContainer />
    </MainContentsFitTheScreenWithHeader>
  );
};

export default Login;
