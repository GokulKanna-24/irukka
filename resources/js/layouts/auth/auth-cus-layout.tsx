import AppLogoIcon from '@/components/app-logo-icon';
import { Link } from '@inertiajs/react';
import { type PropsWithChildren } from 'react';

interface AuthLayoutProps {
  name?: string;
  title?: string;
  description?: string;
}

export default function AuthSimpleLayout({ children, title, description }: PropsWithChildren<AuthLayoutProps>) {
  return (
    <div className="relative min-h-screen bg-gray-100 overflow-hidden">
      <div className="absolute w-[28rem] h-[28rem] bg-green-200 rounded-full -top-24 -left-24 z-0"></div>
      <div className="absolute w-40 h-40 bg-green-200 rounded-full bottom-4 right-4 z-0"></div>
      <div className="relative z-10 flex items-center justify-between h-screen px-8">
        <div className="w-1/3 rounded-2xl overflow-hidden shadow-lg">
          <img
            src="https://via.placeholder.com/400x600"
            alt="Card Image"
            className="w-full h-full object-cover"
          />
        </div>
        <div className="w-1/2 max-w-md bg-white dark:bg-gray-900 text-foreground rounded-xl shadow-lg p-8 ml-12">
          <Link href={route('home')} className="flex flex-col items-center gap-2 font-medium">
            <div className="mb-1 flex h-9 w-9 items-center justify-center rounded-md">
              <AppLogoIcon className="size-9 fill-current text-[var(--foreground)] dark:text-white" />
            </div>
            <span className="sr-only">{title}</span>
          </Link>
          <div className="space-y-2 text-center">
            <h1 className="text-xl font-medium">{title}</h1>
            <p className="text-muted-foreground text-center text-sm">{description}</p>
          </div>
          {children}
        </div>
      </div>
    </div>
  );
}
