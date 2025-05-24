import React from 'react';

interface PaginationProps {
  currentPage: number;
  totalPages: number;
  onPageChange: (page: number) => void;
}

const Pagination: React.FC<PaginationProps> = ({ currentPage, totalPages, onPageChange }) => {
  return (
    <div className="flex justify-between items-center mt-4 text-sm text-foreground dark:text-white">
      <span>
        Page {currentPage} of {totalPages}
      </span>
      <div className="space-x-2">
        <button
          onClick={() => onPageChange(currentPage - 1)}
          className="px-3 py-1 rounded bg-gray-200 dark:bg-[#2E4F4F] hover:bg-gray-300 dark:hover:bg-[#3b6666]"
          disabled={currentPage === 1}
        >
          Prev
        </button>
        <button
          onClick={() => onPageChange(currentPage + 1)}
          className="px-3 py-1 rounded bg-gray-200 dark:bg-[#2E4F4F] hover:bg-gray-300 dark:hover:bg-[#3b6666]"
          disabled={currentPage === totalPages}
        >
          Next
        </button>
      </div>
    </div>
  );
};

export default Pagination;