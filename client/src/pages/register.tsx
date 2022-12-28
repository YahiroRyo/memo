/** @jsxImportSource @emotion/react */
import { MainContentsFitTheScreenWithHeader } from '../components/userSettingClient/templates/MainContentsFitTheScreenWithHeader';
import { RegisterFormContainer } from '../components/userSettingClient/organisms/ContainerComponents/RegisterFormContainer';

const RegisterUser = () => {
  return (
    <MainContentsFitTheScreenWithHeader>
      <RegisterFormContainer />
    </MainContentsFitTheScreenWithHeader>
  );
};

export default RegisterUser;
