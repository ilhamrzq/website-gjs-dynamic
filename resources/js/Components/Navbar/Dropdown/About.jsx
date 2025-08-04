import { useState } from 'react';
import ButtonNavbarDropdown from './Button';
import data from '../../../data/Navbar/about.json';

export default function AboutNavbarDropdown({ lang_code }) {
  const [isOpenAbout, setIsOpenAbout] = useState(false);

  const datas = lang_code === 'id' ? data.about_id : data.about_en;

  return (
    <div onMouseEnter={() => setIsOpenAbout(true)} onMouseLeave={() => setIsOpenAbout(false)} className="flex items-center rounded-4">
      <div className="px-4 rounded-4 list-navbar">
        <div className="font-medium text-base text-center flex flex-row items-center gap-2 cursor-pointer">
          {lang_code === 'id' ? 'Tentang' : 'About'}
          <svg className="ml-1" width="9" height="9" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10.38 1.29006L6.49998 5.17006L2.61998 1.29006C2.22998 0.900059 1.59998 0.900059 1.20998 1.29006C0.81998 1.68006 0.81998 2.31006 1.20998 2.70006L5.79998 7.29006C6.18998 7.68006 6.81998 7.68006 7.20998 7.29006L11.8 2.70006C12.19 2.31006 12.19 1.68006 11.8 1.29006C11.41 0.910059 10.77 0.900059 10.38 1.29006Z"
              fill="#21243A"
            />
          </svg>
        </div>

        {/* Dropdown Content */}
        {isOpenAbout && (
          <div className="dropdown-content-about absolute py-12 z-20 w-full left-0 right-0 top-[110px] bg-neutral-white-100 mt-2">
            <div className="grid grid-cols-3 grid-flow-col w-10/12 mx-auto my-3 gap-72">
              {/* Left Image */}
              <div className="col-span-1">
                <img src="/images/about/navbar-about.webp" alt="navbar-about" className="h-full rounded-2xl object-cover" />
              </div>

              {/* Right Links */}
              <div className="col-span-2 w-full self-center">
                <div className="flex flex-col">
                  <div className="title font-bold fs-40 color-primary-blue-100">{lang_code === 'id' ? 'Tentang' : 'About'}</div>
                  <div className="list-menu-about my-10">
                    {datas.map((item, index) => (
                      <ButtonNavbarDropdown key={index} name={item.name} hrefTo={item.to} iconMaterial={item.icon} />
                    ))}
                  </div>
                </div>
              </div>
            </div>
            <img src="/images/images/about-us.webp" className="absolute right-0 bottom-0" alt="image-aboutus" />
          </div>
        )}
      </div>
    </div>
  );
}
