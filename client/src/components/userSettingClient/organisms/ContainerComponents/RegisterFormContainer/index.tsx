/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import axios from 'axios';
import { useRouter } from 'next/router';
import { useEffect } from 'react';
import { useForm } from 'react-hook-form';
import { useRecoilState } from 'recoil';
import { userState } from '../../../../../store/Auth';
import { LoggedInResponse } from '../../../../../types/userSettingClient/LoggedInResponse';
import { RegisterFormParams } from '../../../../../types/userSettingClient/RegisterFormParams';
import { Inner } from '../../../atoms/Inner';
import { RegisterForm } from '../../PresentationalComponents/RegisterForm';

type RegisterFormContainerProps = {
  style?: SerializedStyles;
};

export const RegisterFormContainer = ({ style }: RegisterFormContainerProps) => {
  const [user, setUser] = useRecoilState(userState);
  const router = useRouter();

  const {
    register,
    handleSubmit,
    setError,
    formState: { errors, isValid },
  } = useForm<RegisterFormParams>({
    mode: 'onChange',
  });

  useEffect(() => {
    if (user.token) {
      router.push('/notes');
      return;
    }
  });

  const registerUser = async (registerFormParams: RegisterFormParams) => {
    await axios.get(`${process.env.NEXT_PUBLIC_API_URL}/sanctum/csrf-cookie`).then(async (response) => {
      try {
        const response = await axios.post<LoggedInResponse>(
          `${process.env.NEXT_PUBLIC_API_URL}/users/register`,
          registerFormParams,
        );

        setUser({
          token: response.data.token,
        });
      } catch (e) {
        if (axios.isAxiosError(e) && e.response.status === 400) {
          for (const inputName in e.response.data) {
            setError(inputName as keyof RegisterFormParams, { message: e.response.data[inputName] });
          }
          return;
        }

        setError('email', { message: 'アカウントの登録に失敗しました。' });
      }
    });
  };

  return (
    <Inner style={style}>
      <RegisterForm
        onSubmit={registerUser}
        register={register}
        handleSubmit={handleSubmit}
        errors={errors}
        isValid={isValid}
      />
    </Inner>
  );
};
