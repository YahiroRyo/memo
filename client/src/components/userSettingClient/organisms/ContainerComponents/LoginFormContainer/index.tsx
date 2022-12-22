/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import axios from 'axios';
import { useForm } from 'react-hook-form';
import { LoginFormParams } from '../../../../../types/userSettingClient/LoginFormParams';
import { Inner } from '../../../atoms/Inner';
import { LoginForm } from '../../PresentationalComponents/LoginForm';

export const LoginFormContainer = () => {
  const {
    register,
    handleSubmit,
    setError,
    formState: { errors, isValid },
  } = useForm<LoginFormParams>({
    mode: 'onChange',
  });

  const login = async (loginFormParams: LoginFormParams) => {
    await axios.get(`${process.env.NEXT_PUBLIC_API_URL}/sanctum/csrf-cookie`).then(async (response) => {
      try {
        await axios.post(`${process.env.NEXT_PUBLIC_API_URL}/users/login`, loginFormParams);
      } catch (e) {
        if (axios.isAxiosError(e)) {
          if (e.response.status === 400) {
            for (const inputName in e.response.data) {
              setError(inputName as keyof LoginFormParams, { message: e.response.data[inputName] });
            }
            return;
          }
        }

        setError('email', { message: '入力されたユーザー名もしくはパスワードが正しくありません。' });
      }
    });
  };

  return (
    <Inner
      style={css`
        height: 100%;
      `}
    >
      <LoginForm
        style={css`
          display: flex;
          align-items: center;
          justify-content: center;
          height: 100%;
        `}
        onSubmit={login}
        register={register}
        handleSubmit={handleSubmit}
        errors={errors}
        isValid={isValid}
      />
    </Inner>
  );
};
