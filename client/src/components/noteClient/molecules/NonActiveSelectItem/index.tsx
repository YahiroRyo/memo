/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { theme } from '../../../../styles/noteClient/theme';

type NonActiveSelectItemProps = {
  icon: React.ReactNode;
  children?: React.ReactNode;
  style?: SerializedStyles;
  onClick?: () => void;
};

export const NonActiveSelectItem = ({ icon, children, style, onClick }: NonActiveSelectItemProps) => {
  return (
    <li
      onClick={onClick}
      css={css`
        display: flex;
        align-items: center;
        column-gap: 0.25rem;
        transition: 0.1s;

        &:hover {
          background-color: ${theme.lightGray};
          cursor: pointer;
        }

        ${style}
      `}
    >
      {icon}
      <p
        css={css`
          color: ${theme.gray};
          font-size: 1rem;
        `}
      >
        {children}
      </p>
    </li>
  );
};
