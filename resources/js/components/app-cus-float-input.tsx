import React, { useState } from 'react';
import clsx from 'clsx';

interface FloatingInputProps extends React.InputHTMLAttributes<HTMLInputElement> {
  label: string;
  id: string;
  type?: string;
  value: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  error?: string;
}

const FloatingInput: React.FC<FloatingInputProps> = ({ label, id, type = "text", value, onChange, error }) => {
  return (
    <div className="relative w-full">
      <input
        id={id}
        type={type}
        value={value}
        onChange={onChange}
        placeholder=" "
        className={clsx(
          "peer w-full border rounded px-3 pt-4 pb-1 focus:outline-none focus:ring-2",
          "bg-white dark:bg-[#121e1e] border-[#dbdbd7] text-black dark:text-white",
          error ? "border-red-500 focus:ring-red-300" : "focus:ring-green-400 dark:focus:ring-green-600"
        )}
      />
      <label
        htmlFor={id}
        className={clsx(
          "absolute left-3 top-1 text-gray-600 dark:text-gray-400 text-sm transition-all duration-200",
          "peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 dark:peer-placeholder-shown:text-gray-500",
          "peer-focus:top-1 peer-focus:text-sm peer-focus:text-green-700 dark:peer-focus:text-green-400"
        )}
      >
        {label}
      </label>
      {error && <p className="text-red-500 text-sm mt-1">{error}</p>}
    </div>
  );
};

export default FloatingInput;