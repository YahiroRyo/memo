/** @jsxImportSource @emotion/react */
import { css, SerializedStyles } from '@emotion/react';
import { theme } from '../../../../styles/noteClient/theme';

type ActiveSelectItemProps = {
  icon: React.ReactNode;
  children?: React.ReactNode;
  style?: SerializedStyles;
  onClick?: () => void;
};

export const ActiveSelectItem = ({ icon, children, style, onClick }: ActiveSelectItemProps) => {
  return (
    <li
      onClick={onClick}
      css={css`
        display: flex;
        align-items: center;
        column-gap: 0.25rem;
        background-color: ${theme.lightGray};

        &:hover {
          cursor: pointer;
        }

        ${style}
      `}
    >
      {icon}
      <p
        css={css`
          color: ${theme.dark};
          font-size: 1rem;
          font-weight: bold;
        `}
      >
        {children}
      </p>
    </li>
  );
};
