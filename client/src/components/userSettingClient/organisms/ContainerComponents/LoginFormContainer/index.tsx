/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import axios from 'axios';
import { useRouter } from 'next/router';
import { useEffect } from 'react';
import { useForm } from 'react-hook-form';
import { useRecoilState } from 'recoil';
import { userState } from '../../../../../store/auth';
import { LoggedInResponse } from '../../../../../types/userSettingClient/LoggedInResponse';
import { LoginFormParams } from '../../../../../types/userSettingClient/LoginFormParams';
import { Inner } from '../../../atoms/Inner';
import { LoginForm } from '../../PresentationalComponents/LoginForm';

type LoginFormContainerProps = {
  style?: SerializedStyles;
};

export const LoginFormContainer = ({ style }: LoginFormContainerProps) => {
  const [user, setUser] = useRecoilState(userState);
  const router = useRouter();

  const {
    register,
    handleSubmit,
    setError,
    formState: { errors, isValid },
  } = useForm<LoginFormParams>({
    mode: 'onChange',
  });

  useEffect(() => {
    if (user.token) {
      router.push('/notes');
      return;
    }
  });

  const login = async (loginFormParams: LoginFormParams) => {
    await axios.get(`${process.env.NEXT_PUBLIC_API_URL}/sanctum/csrf-cookie`).then(async (response) => {
      try {
        const response = await axios.post<LoggedInResponse>(
          `${process.env.NEXT_PUBLIC_API_URL}/users/login`,
          loginFormParams,
        );

        setUser({
          token: response.data.token,
        });
      } catch (e) {
        if (axios.isAxiosError(e) && e.response.status === 400) {
          for (const inputName in e.response.data) {
            setError(inputName as keyof LoginFormParams, { message: e.response.data[inputName] });
          }
          return;
        }

        setError('email', { message: '入力されたユーザー名もしくはパスワードが正しくありません。' });
      }
    });
  };

  return (
    <Inner style={style}>
      <LoginForm onSubmit={login} register={register} handleSubmit={handleSubmit} errors={errors} isValid={isValid} />
    </Inner>
  );
};
