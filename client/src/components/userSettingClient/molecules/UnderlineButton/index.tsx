import { SerializedStyles } from '@emotion/react';
import { NonUnderlinedButton } from '../../atoms/NonUnderlinedButton';
import { UnderlinedButton } from '../../atoms/UnderlinedButton';

type UnderlineButtonProps = {
  isEnable: boolean;
  children: React.ReactNode;
  href: string;
  style?: SerializedStyles;
};

export const UnderlineButton = ({ isEnable, children, href, style }: UnderlineButtonProps) => {
  return isEnable ? (
    <UnderlinedButton href={href} style={style}>
      {children}
    </UnderlinedButton>
  ) : (
    <NonUnderlinedButton href={href} style={style}>
      {children}
    </NonUnderlinedButton>
  );
};
