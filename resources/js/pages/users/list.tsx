import { Head, Link, useForm } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';

import AppLayout from '@/layouts/app-layout';
import { User } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

export default function Users({list}: {list :any[]}) {
  const {processing, delete: destroy} = useForm();

  const handleDelete = (id: number, name: string) => {
    if(confirm("Do you want to remove this User? " + name)) {
      destroy(`users/delete/${id}`);
    }

  }
  return (
      <AppLayout breadcrumbs={breadcrumbs}>
        <Head title="Users" />
        <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
          <div>
            <Link href={route('users.create')}>
              <Button>Create User</Button>
            </Link>
          </div>
          <div className="overflow-x-auto rounded-xl shadow border border-gray-200 dark:border-[#2E4F4F]">
            <table className="min-w-full divide-y divide-gray-200 dark:divide-[#2E4F4F] bg-white dark:bg-[#121e1e] text-foreground">
              <thead className="bg-green-50 dark:bg-[#2E4F4F]">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                    ID
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                    Name
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                    Email
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                    Role
                  </th>
                  <th className="px-6 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-100 dark:divide-[#2E4F4F]">
                {list.map((user) => (
                  <tr key={user.id} className="hover:bg-gray-50 dark:hover:bg-[#1c2c2c]">
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{user.id}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{user.name}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{user.email}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm capitalize text-gray-700 dark:text-gray-300">{user.role}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-right">
                      <Link href={route('users.edit', user.id)}>
                        <button className="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium mr-3">
                          Edit
                        </button>
                      </Link>
                      <button disabled={processing} onClick={() => handleDelete(user.id, user.name)} className="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">
                        Delete
                      </button>
                    </td>
                  </tr>
                ))}
                {list.length === 0 && (
                  <tr>
                    <td colSpan={5} className="text-center py-4 text-sm text-gray-500 dark:text-gray-400">
                      No users found.
                    </td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
      </AppLayout>
  );
}
