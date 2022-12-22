import { UseFormRegister } from 'react-hook-form';

export type ValidRegister = {
  register: UseFormRegister<any>;
  name: string;
  valid: { [key: string]: any };
};
