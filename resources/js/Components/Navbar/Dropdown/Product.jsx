import { useState } from 'react';
import { Link } from '@inertiajs/react';
import data from '../../../data/Navbar/products.json';

export default function ProductNavbarDropdown({ lang_code }) {
  const [isOpenProduct, setIsOpenProduct] = useState(false);

  return (
    <div onMouseEnter={() => setIsOpenProduct(true)} onMouseLeave={() => setIsOpenProduct(false)} className="flex items-center">
      <div className="px-4 rounded-4 list-navbar">
        <a href="#" className="font-medium text-base text-center flex flex-row items-center gap-2">
          {lang_code === 'id' ? 'Produk' : 'Products'}
          <svg className="ml-1" width="9" height="9" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10.38 1.29006L6.49998 5.17006L2.61998 1.29006C2.22998 0.900059 1.59998 0.900059 1.20998 1.29006C0.81998 1.68006 0.81998 2.31006 1.20998 2.70006L5.79998 7.29006C6.18998 7.68006 6.81998 7.68006 7.20998 7.29006L11.8 2.70006C12.19 2.31006 12.19 1.68006 11.8 1.29006C11.41 0.910059 10.77 0.900059 10.38 1.29006Z"
              fill="#21243A"
            />
          </svg>
        </a>

        {/* Dropdown Content */}
        {isOpenProduct && (
          <div className="dropdown-content-about py-12 absolute z-20 w-full left-0 right-0 top-[110px] bg-neutral-white-100 mt-2">
            <div className="grid grid-cols-12 grid-flow-col w-11/12 mx-auto my-3 gap-72">
              {/* Left Column */}
              <div className="col-span-4">
                <h1 className="font-bold fs-40 text-neutral-black-100">{lang_code === 'id' ? 'Produk' : 'Products'}</h1>
                <p className="text-[20px] leading-[160%] text-neutral-black-60 font-normal">
                  {lang_code === 'id' ? 'Aplikasi Mobile GJS terintegrasi dengan website klien GJS.' : 'Monitor Security Patrol Anywhere & Anytime with our products. GJS Security Patrol is Integrated with GJS Client Portal.'}
                </p>
              </div>

              {/* Right Column */}
              <div className="col-span-8 w-full self-center">
                <div className="flex flex-col gap-6">
                  {data.map((product) => (
                    <Link key={product.id} to={lang_code === 'id' ? product.link_id : product.link_en} className="bg-primary-blue-20 rounded-xl px-8">
                      <div className="grid grid-flow-col grid-cols-12 h-full content-center">
                        <div className="col-span-6 h-full py-20 px-10">
                          <h1 className="text-[28px] leading-[150%] font-bold color-neutral-black-100">{product.title}</h1>
                          <p className="text-base leading-[160%] font-normal color-neutral-black-60">{product.description[lang_code]}</p>
                        </div>
                        <div className="col-span-6 flex items-end">
                          <img src={product.image} alt={product.imageAlt} className="w-full h-[200px] 2xl:h-[300px]" />
                        </div>
                      </div>
                    </Link>
                  ))}
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
