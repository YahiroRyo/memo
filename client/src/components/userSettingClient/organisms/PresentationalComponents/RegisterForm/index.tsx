/** @jsxImportSource @emotion/react */
import { DarkOrangeButton } from '../../../atoms/DarkOrangeButton';
import { Title } from '../../../atoms/Title';
import { InputTextGroup } from '../../../molecules/InputTextGroup';
import { ValidationError } from '../../../molecules/ValidationError';
import { css, SerializedStyles } from '@emotion/react';
import { FieldErrorsImpl, UseFormHandleSubmit, UseFormRegister } from 'react-hook-form';
import { RegisterFormParams } from '../../../../../types/userSettingClient/RegisterFormParams';

type RegisterFormProps = {
  style?: SerializedStyles;
  errors?: Partial<FieldErrorsImpl<RegisterFormParams>>;
  isValid: boolean;
  onSubmit: (data: RegisterFormParams) => void;
  register: UseFormRegister<RegisterFormParams>;
  handleSubmit: UseFormHandleSubmit<RegisterFormParams>;
};

export const RegisterForm = ({ style, onSubmit, register, handleSubmit, errors, isValid }: RegisterFormProps) => {
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
        <Title>アカウントを登録</Title>
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
          アカウントを登録する
        </DarkOrangeButton>
      </div>
    </form>
  );
};
