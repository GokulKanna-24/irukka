import React, { useState } from 'react';
import clsx from 'clsx';
import { ChevronDown } from 'lucide-react';

interface FloatingSelectProps {
  label: string;
  id: string;
  value: string;
  onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
  options: { label: string; value: string }[];
  error?: string;
  disabled?: boolean
}

const FloatingSelect: React.FC<FloatingSelectProps> = ({
  label,
  id,
  value,
  onChange,
  options,
  error,
  disabled
}) => {
  const [focused, setFocused] = useState(false);

  const isActive = focused || value;

  return (
    <div className="relative w-full">
      <select
        disabled={disabled}
        id={id}
        value={value}
        onChange={onChange}
        onFocus={() => setFocused(true)}
        onBlur={() => setFocused(false)}
        className={clsx(
          'peer w-full border rounded px-3 pt-5 pb-1 appearance-none focus:outline-none',
          'bg-white dark:bg-[#121e1e] text-black dark:text-white text-sm',
          isActive
            ? 'border-green-500 ring-2 ring-green-400 dark:ring-green-600'
            : 'border-[#dbdbd7] dark:border-[#3a4d4d]',
          error && 'border-red-500 ring-1 ring-red-300'
        )}
      >
        <option value="" disabled hidden></option>
        {options.map((opt) => (
          <option
            key={opt.value}
            value={opt.value}
            className="text-black dark:text-white bg-white dark:bg-[#121e1e] hover:bg-orange-100 dark:hover:bg-orange-600"
          >
            {opt.label}
          </option>
        ))}
      </select>

      <label
        htmlFor={id}
        className={clsx(
          'absolute left-3 z-10 transition-all duration-200',
          isActive
            ? 'top-1 text-sm text-green-700 dark:text-green-400'
            : 'top-3 text-base text-gray-600 dark:text-gray-400'
        )}
      >
        {label}
      </label>

      {/* Arrow icon */}
      <div className="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">
        <ChevronDown />
      </div>

      {error && <p className="text-red-500 text-sm mt-1">{error}</p>}
    </div>
  );
};

export default FloatingSelect;