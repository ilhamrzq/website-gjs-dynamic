import { Link } from '@inertiajs/react';

export default function NewsNavbarDropdown({ lang_code }) {

  const newsPageNav = lang_code === 'id' ? { to: '/id/berita', label: 'Berita' } : { to: '/en/news', label: 'News' };

  return (
    <div className="flex items-center rounded-4">
      <div className="px-4 rounded-4 list-navbar">
        {/* News Navbar */}
        <Link href={newsPageNav.to} className="font-medium text-base text-center flex flex-row items-center gap-2 cursor-pointer">
          {newsPageNav.label}
        </Link>
      </div>
    </div> 
  );
}
