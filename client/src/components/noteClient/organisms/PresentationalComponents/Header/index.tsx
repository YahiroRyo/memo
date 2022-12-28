/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { hexToRgb } from '../../../../../modules/Color';
import { theme } from '../../../../../styles/noteClient/theme';
import { TransparentInputText } from '../../../atoms/TransparentInputText';

type HeaderProps = {
  title: string;
  isFetching: boolean;
  error: string;
  onChange: (value: string) => void;
  style?: SerializedStyles;
};

export const Header = ({ title, isFetching, error, onChange, style }: HeaderProps) => {
  const Title =
    isFetching || error ? (
      <TransparentInputText value={'現在選んでいるノートは存在しません。'}></TransparentInputText>
    ) : (
      <TransparentInputText onChange={(e) => onChange(e.target.value)} value={title}></TransparentInputText>
    );

  return (
    <header
      css={css`
        padding: 1rem;
        box-shadow: 0 4px 4px rgba(${hexToRgb(theme.dark)}, 0.25);

        ${style}
      `}
    >
      {Title}
    </header>
  );
};
