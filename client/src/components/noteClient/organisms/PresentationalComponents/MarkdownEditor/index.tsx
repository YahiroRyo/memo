/** @jsxImportSource @emotion/react */
import { css } from '@emotion/react';
import 'easymde/dist/easymde.min.css';
import dynamic from 'next/dynamic';
import { useEffect, useMemo } from 'react';

const SimpleMdeReact = dynamic(() => import('react-simplemde-editor'), { ssr: false });

type MarkdownEditorProps = {
  value?: string;
  isFetching: boolean;
  error: string;
  onChange: (value: string) => void;
  onSave: () => void;
  onFocusOut: () => void;
};

export const MarkdownEditor = ({ value, isFetching, error, onChange, onSave, onFocusOut }: MarkdownEditorProps) => {
  const autofocusNoSpellcheckerOptions = useMemo(() => {
    return {
      autofocus: true,
      spellChecker: false,
      maxHeight: '75vh',
    };
  }, []);

  useEffect(() => {
    const keyDownCallBack = (e) => {
      if ((window.navigator.platform.match('Mac') ? e.metaKey : e.ctrlKey) && e.keyCode == 83) {
        e.preventDefault();

        onSave();
      }
    };

    document.addEventListener('keydown', keyDownCallBack, false);
    return () => document.removeEventListener('keydown', keyDownCallBack);
  }, [onSave]);

  if (isFetching || error) {
    return <></>;
  }

  return (
    <SimpleMdeReact
      css={css`
        width: 100%;
      `}
      options={autofocusNoSpellcheckerOptions}
      value={value}
      onChange={(value) => {
        onChange(value);
      }}
      onBlur={onFocusOut}
    />
  );
};
