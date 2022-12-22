/** @jsxImportSource @emotion/react */
import { DarkOrangeButton } from '../../../atoms/DarkOrangeButton';
import { Inner } from '../../..//atoms/Inner';
import { Title } from '../../..//atoms/Title';
import { InputTextGroup } from '../../../molecules/InputTextGroup';
import { ValidationError } from '../../../molecules/ValidationError';
import { css, SerializedStyles } from '@emotion/react';
import { FieldErrorsImpl, UseFormHandleSubmit, UseFormRegister } from 'react-hook-form';
import { LoginFormParams } from '../../../../../types/userSettingClient/LoginFormParams';

type LoginFormProps = {
  style?: SerializedStyles;
  errors?: Partial<FieldErrorsImpl<LoginFormParams>>;
  isValid: boolean;
  onSubmit: (data: LoginFormParams) => void;
  register: UseFormRegister<LoginFormParams>;
  handleSubmit: UseFormHandleSubmit<LoginFormParams>;
};

export const LoginForm = ({ style, onSubmit, register, handleSubmit, errors, isValid }: LoginFormProps) => {
  const emailValidatedMessage = errors?.email?.message ? (
    <ValidationError
      style={css`
        margin-top: 0.5rem;
      `}
    >
      {errors.email.message}
    </ValidationError>
  ) : (
    <></>
  );
  const passwordValidatedMessage = errors?.password?.message ? (
    <ValidationError
      style={css`
        margin-top: 0.5rem;
      `}
    >
      {errors.password.message}
    </ValidationError>
  ) : (
    <></>
  );

  return (
    <form onSubmit={handleSubmit(onSubmit)} css={style}>
      <div
        css={css`
          width: 100%;
        `}
      >
        <Title>ログイン</Title>
        <InputTextGroup
          placeholder='example@gmail.com'
          label='メールアドレス'
          validRegister={{
            name: 'email',
            register: register,
            valid: {
              required: 'メールアドレスを入力してください。',
              maxLength: { value: 255, message: '有効なメールアドレスを入力してください。' },
              pattern: {
                value: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]{1,})+(\.[a-zA-Z0-9-])*$/,
                message: '有効なメールアドレスを入力してください。',
              },
            },
          }}
          style={css`
            margin-top: 2rem;
          `}
        />
        {emailValidatedMessage}

        <InputTextGroup
          label='パスワード'
          validRegister={{
            name: 'password',
            register: register,
            valid: {
              required: 'パスワードを入力してください。',
              minLength: { value: 6, message: '6文字以上で入力してください。' },
            },
          }}
          type='password'
          style={css`
            margin-top: 1.375rem;
          `}
        />
        {passwordValidatedMessage}

        <DarkOrangeButton
          style={css`
            margin: 1.375rem auto 0 auto;
          `}
          disabled={!isValid}
        >
          ログインする
        </DarkOrangeButton>
      </div>
    </form>
  );
};
