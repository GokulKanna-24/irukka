import { Head, useForm } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { LoaderCircle } from 'lucide-react';
import FloatingInput from '@/components/app-cus-float-input';
import FloatingSelect from '@/components/app-cus-float-select';

import AppLayout from '@/layouts/app-layout';
import { FormEventHandler } from 'react';

type CreateUserForm = {
  name: string;
  email: string;
  password: string;
  role: string;
};

interface userType {
  id?: number;
  name: string;
  email: string;
  role: string;
}

export default function userForm({roles, user}: {roles :any[], user?: userType}) {

  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Users',
      href: '/users',
    },
    {
      title: ( user ? 'Update' : 'Create') + ' User',
      href: '/users/' + ( user ? ('edit/'+ user.id) : 'create'),
    },
  ];
  const buttonText = user ? 'Update User' : 'Create account';

  const { data, setData, post, processing, errors, reset } = useForm<Required<CreateUserForm>>({
    name: user ? user.name : '',
    email: user ? user.email : '',
    password: user ? 'Happy@2025' : '',
    role: user ? user.role : '',
  });

  const submit: FormEventHandler = (e) => {
    e.preventDefault();
    const routeName = 'users.' + ( user ? 'edit' : 'create')
    post(route(routeName, user ? user.id : undefined), {
      onFinish: () => reset('password'),
    });
  };
  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Create User" />
      <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        <div className="w-full max-w-md bg-[#edfff4] dark:bg-[#121e1e] text-foreground rounded-xl shadow-lg p-8 ">
          <form className="flex flex-col gap-6" onSubmit={submit}>
            <div className="grid gap-3">
              <div className="grid gap-2">
                <FloatingInput 
                    label="Name"
                    id="name"
                    required
                    tabIndex={1}
                    autoComplete="name"
                    autoFocus
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    error={errors.name}
                    disabled={processing}
                />
              </div>

              <div className="grid gap-2">
                <FloatingInput 
                    label="Email address"
                    id="email"
                    type="email"
                    required
                    tabIndex={2}
                    autoComplete="email"
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                    error={errors.email}
                    disabled={processing}
                />
              </div>

              { !user && (
              <div className="grid gap-2">
                <FloatingInput 
                    label="Password"
                    id="password"
                    type="password"
                    required
                    tabIndex={3}
                    autoComplete="password"
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                    error={errors.password}
                    disabled={processing}
                />
              </div>
              )}

              <div className="grid gap-2">
                <FloatingSelect
                  label="Role"
                  id="role"
                  value={data.role}
                  onChange={(e) => setData('role', e.target.value)}
                  options={roles}
                  error={errors.role}
                  disabled={processing}
                />
              </div>

              <Button type="submit" className="mt-2 w-full" tabIndex={5} disabled={processing}>
                  {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                  { buttonText }
              </Button>
            </div>
          </form>
        </div>
      </div>
    </AppLayout>
  );
}
