import { Link } from '@inertiajs/react';

export default function BackNavigation({ backTo, hrefTo }) {
  return (
    <section>
      <Link href={hrefTo}>
        <div className="flex flex-row justify-between header-contact my-14 w-11/12 mx-auto">
          <div className="back-navigation flex flex-row items-center gap-4">
            <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '24px' }}>
              arrow_back
            </span>
            <p className="font-bold text-center text-[28px] text-black">{backTo}</p>
          </div>
        </div>
      </Link>
    </section>
  );
}
