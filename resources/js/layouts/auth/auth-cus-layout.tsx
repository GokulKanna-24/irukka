import AppLogoIcon from '@/components/app-logo-cus-icon';
import { Link } from '@inertiajs/react';
import { type PropsWithChildren } from 'react';
import AppearanceTabs from '@/components/appearance-tabs';

interface AuthLayoutProps {
  name?: string;
  title?: string;
  description?: string;
}

export default function AuthSimpleLayout({ children, title, description }: PropsWithChildren<AuthLayoutProps>) {
  return (
    <div className="bg-background text-foreground relative min-h-screen overflow-hidden">
      <div className="absolute w-[28rem] h-[28rem] bg-green-200 dark:bg-[#2E4F4F] rounded-full -top-24 -left-24 z-0"></div>
      <div className="absolute w-40 h-40 bg-green-200 dark:bg-[#2E4F4F] rounded-full bottom-4 right-4 z-0"></div>
      <div className="relative z-10 flex flex-col md:flex-row items-center justify-center min-h-screen px-6 md:px-12 gap-12">
        <div className="hidden md:block md:w-1/3 h-[90vh] rounded-2xl overflow-hidden shadow-lg">
          <img
            src="/assets/img/irukka_named.png"
            alt="Card Image"
            className="w-full h-full object-cover"
          />
        </div>
        <div className="w-full max-w-md min-h-[90vh] bg-[#edfff4] dark:bg-[#121e1e] text-foreground rounded-xl shadow-lg p-8 ">
          <Link href={route('home')} className="flex flex-col items-center gap-2 font-medium">
            <div className="mb-1 flex h-9 w-9 items-center justify-center rounded-md">
              <AppLogoIcon className="size-9 fill-current text-[var(--foreground)] dark:text-white" />
            </div>
            <span className="sr-only">{title}</span>
          </Link>
          <div className="space-y-2 text-center mb-1">
            <h1 className="text-xl font-medium">{title}</h1>
            <p className="text-muted-foreground text-center text-sm">{description}</p>
          </div>
          {children}
          <div className="space-y-2 text-center mt-4">
            <AppearanceTabs />
          </div>
        </div>
      </div>
    </div>
  );
}
