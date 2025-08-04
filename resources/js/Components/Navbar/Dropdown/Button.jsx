import { Link } from '@inertiajs/react';
import Icon from '../../Icon';

export default function ButtonNavbarDropdown({ name, hrefTo, iconMaterial }) {
  return (
    <Link to={hrefTo} className="menu duration-300 hover:ease-in-out scroll-smooth hover:scale-105 flex flex-row justify-between items-center border-b-[#DDDDDD] border-b-[1px] py-4">
      <div className="flex gap-8 items-center">
        <Icon materialIcon={iconMaterial} classMaterial="material-symbols-outlined color-primary-blue-100 text-2xl" />
        <h1 className="text-2xl font-semibold color-neutral-black-100">{name}</h1>
      </div>
    </Link>
  );
}
