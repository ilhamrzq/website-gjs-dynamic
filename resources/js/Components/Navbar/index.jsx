import { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';
import AboutNavbarDropdown from './Dropdown/About';
import ServiceNavbarDropdown from './Dropdown/Service';
import ProductNavbarDropdown from './Dropdown/Product';
import NewsNavbarDropdown from './Dropdown/News';
import datas from '../../data/Navbar/mobile.json';
import ArrowIcon from '../ArrowIcon';

export default function Navbar({ lang_code, direct_link_id, direct_link_en }) {
  const [dropdown_lang, setDropdown_lang] = useState(false);
  const [navbar_mobile, setNavbar_mobile] = useState(false);

  const { url } = usePage();
  const currentUrl = url;

  // Determine current language based on path
  const isEnglishPath = currentUrl.startsWith('/en');
  const currentLang = isEnglishPath ? 'en' : 'id';

  // Get data based on current language
  const aboutDatas = currentLang === 'id' ? datas.about_id : datas.about_en;
  const serviceDatas = currentLang === 'id' ? datas.services_id : datas.services_en;
  const productDatas = currentLang === 'id' ? datas.products_id : datas.products_en;

  // Get flag image and alt text based on current language
  const currentFlag = currentLang === 'en' ? { src: '/images/language/lang-en.png', alt: 'lang-en' } : { src: '/images/language/lang-id.png', alt: 'lang-id' };

  const viewContact = lang_code === 'id' ? { to: '/id/kontak', label: 'Kontak Kami' } : { to: '/en/contact', label: 'Contact Us' };
  
  const show_navbar_mobile = () => {
    setNavbar_mobile(!navbar_mobile);
  };

  const show_modal_lang = () => {
    setDropdown_lang(!dropdown_lang);
  };

  return (
    <>
      {/* Mobile View */}
      <div className="navbar-component block md:hidden">
        <div className="navbar-top bg-primary-blue-100">
          <div className="flex flex-col items-end color-neutral-white-100 px-4 py-3">
            {/* Upper */}
            <a href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app&pli=1" target="_blank" className="flex items-center gap-2">
              {lang_code === 'id' ? 'Pembaruan terbaru Mobile ..' : 'New update for GJS Mobile ..'}

              <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4.00014 0.999919C4.00014 1.37325 4.30014 1.66659 4.66681 1.66659H8.39348L1.13348 8.92659C0.873477 9.18659 0.873477 9.60659 1.13348 9.86658C1.39348 10.1266 1.81348 10.1266 2.07348 9.86658L9.33348 2.60659V6.33325C9.33348 6.69992 9.63348 6.99992 10.0001 6.99992C10.3668 6.99992 10.6668 6.69992 10.6668 6.33325V0.999919C10.6668 0.633252 10.3668 0.333252 10.0001 0.333252H4.66681C4.30014 0.333252 4.00014 0.633252 4.00014 0.999919Z"
                  fill="white"
                />
              </svg>
            </a>

            <div className="my-[10px] flex gap-4 items-center">
              {/* Contact Button */}
              <Link to={viewContact.to} className="bg-neutral-white-100 rounded px-4 py-[2px] font-medium color-primary-blue-100 text-[14px]">
                {viewContact.label}
              </Link>
              <div className="w-[1px] h-[25px] bg-neutral-white-20"></div>
              {/* Language Button */}
              <div className="flex-row items-center flex gap-3">
                <div className="w-[1px] bg-white"></div>
                <div>
                  <button onClick={show_modal_lang} className="flex items-center">
                    <div className="bg-white w-[32px] h-[32px] rounded-full p-1 flex items-center justify-center">
                      <img alt={currentFlag.alt} src={currentFlag.src} />
                    </div>
                    <svg className="ml-1" width="9" height="9" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10.38 1.29006L6.49998 5.17006L2.61998 1.29006C2.22998 0.900059 1.59998 0.900059 1.20998 1.29006C0.81998 1.68006 0.81998 2.31006 1.20998 2.70006L5.79998 7.29006C6.18998 7.68006 6.81998 7.68006 7.20998 7.29006L11.8 2.70006C12.19 2.31006 12.19 1.68006 11.8 1.29006C11.41 0.910059 10.77 0.900059 10.38 1.29006Z"
                        fill="#21243A"
                      />
                    </svg>
                  </button>

                  {/* Dropdown Language */}
                  {dropdown_lang && (
                    <div className="bg-white rounded-md absolute right-0 w-44 mt-2 shadow-2xl z-30">
                      <div className="p-4 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                        <div>
                          <Link to={direct_link_id} className={`flex p-4 gap-4 items-center text-[#233672] ${currentLang === 'id' ? 'bg-primary-blue-20 rounded-md' : ''}`}>
                            <div className={`rounded-3xl ${currentLang === 'id' ? 'bg-primary-blue-20 p-[4px]' : ''}`}>
                              <img src="/images/language/lang-id.png" alt="lang-id" style={{ imageRendering: 'pixelated' }} />
                            </div>
                            Indonesia
                          </Link>

                          <Link to={direct_link_en} className={`flex p-4 gap-4 items-center text-[#233672] ${currentLang === 'en' ? 'bg-primary-blue-20 rounded-md' : ''}`}>
                            <div className={`rounded-3xl ${currentLang === 'en' ? 'bg-primary-blue-20 p-[4px]' : ''}`}>
                              <img src="/images/language/lang-en.png" alt="lang-en" style={{ imageRendering: 'pixelated' }} />
                            </div>
                            English
                          </Link>
                        </div>
                      </div>
                    </div>
                  )}
                  {/* {dropdown_lang && (
                    <div className="bg-white rounded-md absolute right-0 w-44 mt-2 shadow-2xl z-30">
                      <div className="p-4 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                        {currentUrl === '/id/kontak' || currentUrl === '/en/contact' || currentUrl === '/' || currentUrl === '/en/home' ? (
                          <div>
                            <Link to={direct_link_id} className={`flex p-4 gap-4 items-center text-[#233672] ${currentLang === 'id' ? 'bg-primary-blue-20 rounded-md' : ''}`}>
                              <div className={`rounded-3xl ${currentLang === 'id' ? 'bg-primary-blue-20 p-[4px]' : ''}`}>
                                <img src="/images/language/lang-id.png" alt="lang-id" style={{ imageRendering: 'pixelated' }} />
                              </div>
                              Indonesia
                            </Link>
                            <Link to={direct_link_en} className={`flex p-4 gap-4 items-center text-[#233672] ${currentLang === 'en' ? 'bg-primary-blue-20 rounded-md' : ''}`}>
                              <div className={`rounded-3xl ${currentLang === 'en' ? 'bg-primary-blue-20 p-[4px]' : ''}`}>
                                <img src="/images/language/lang-en.png" alt="lang-en" style={{ imageRendering: 'pixelated' }} />
                              </div>
                              English
                            </Link>
                          </div>
                        ) : (
                          <div>
                            <Link to={direct_link_id} className={`flex p-4 gap-4 items-center text-[#233672] ${currentLang === 'id' ? 'bg-primary-blue-20 rounded-md' : ''}`}>
                              <div className={`rounded-3xl ${currentLang === 'id' ? 'bg-primary-blue-20 p-[4px]' : ''}`}>
                                <img src="/images/language/lang-id.png" alt="lang-id" style={{ imageRendering: 'pixelated' }} />
                              </div>
                              Indonesia
                            </Link>
                            <Link to={direct_link_en} className={`flex p-4 gap-4 items-center text-[#233672] ${currentLang === 'en' ? 'bg-primary-blue-20 rounded-md' : ''}`}>
                              <div className={`rounded-3xl ${currentLang === 'en' ? 'bg-primary-blue-20 p-[4px]' : ''}`}>
                                <img src="/images/language/lang-en.png" alt="lang-en" style={{ imageRendering: 'pixelated' }} />
                              </div>
                              English
                            </Link>
                          </div>
                        )}
                      </div>
                    </div>
                  )} */}
                </div>
              </div>
            </div>
          </div>

          {/* Logo GJS */}
          <div className="flex flex-row justify-between bg-neutral-white-100 items-center h-[65px]">
            <div className="logo-gjs__mobile p-4">
              <Link to={currentLang === 'en' ? '/en' : '/'}>
                <img src="/images/logo/logo_gjs.png" alt="logo-gjs" className="relative top-[-35px] w-[115px] h-[115px]" />
              </Link>
            </div>
            <button className="button-navbar__mobile px-4 py-3" onClick={show_navbar_mobile}>
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clipPath="url(#clip0_1073_12956)">
                  <path d="M13.25 24.5H26.75V23H13.25V24.5ZM13.25 20.75H26.75V19.25H13.25V20.75ZM13.25 15.5V17H26.75V15.5H13.25Z" fill="#233672" />
                </g>
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#DDDDDD" />
                <defs>
                  <clipPath id="clip0_1073_12956">
                    <rect width="18" height="18" fill="white" transform="translate(11 11)" />
                  </clipPath>
                </defs>
              </svg>
            </button>

            {/* Dropdown Navbar Mobile */}
            {navbar_mobile && (
              <div className="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div className="relative w-full h-full max-w-2xl md:h-auto">
                  <div className="relative px-6 py-4 bg-neutral-white-100 rounded-[16px]">
                    <div className="flex flex-col gap-4">
                      {/* About */}
                      <div className="flex flex-col gap-2">
                        <h1 className="title-navbar font-bold fs-18 leading-[160%] color-neutral-black-100">Tentang</h1>

                        {aboutDatas.map((data, index) => (
                          <Link key={index} to={data.to} className="flex flex-row justify-between">
                            <h3 className="color-neutral-black-60 text-base leading-[160%] font-normal">{data.label}</h3>
                            <ArrowIcon />
                          </Link>
                        ))}
                      </div>

                      {/* Services */}
                      <div className="flex flex-col gap-2">
                        <h1 className="title-navbar font-bold fs-18 leading-[160%] color-neutral-black-100">Layanan</h1>

                        {serviceDatas.map((data, index) => (
                          <Link key={index} to={data.to} className="flex flex-row justify-between">
                            <h3 className="color-neutral-black-60 text-base leading-[160%] font-normal">{data.label}</h3>
                            <ArrowIcon />
                          </Link>
                        ))}
                      </div>

                      {/* Products */}
                      <div className="flex flex-col gap-2">
                        <h1 className="title-navbar font-bold fs-18 leading-[160%] color-neutral-black-100">Produk</h1>

                        {productDatas.map((data, index) => (
                          <Link key={index} to={data.to} className="flex flex-row justify-between">
                            <h3 className="color-neutral-black-60 text-base leading-[160%] font-normal">{data.label}</h3>
                            <ArrowIcon />
                          </Link>
                        ))}
                      </div>

                      {/* News */}
                      {currentLang === 'id' ? (
                        <Link to="/id/berita" className="flex flex-col gap-2">
                          <h1 className="title-navbar font-bold fs-18 leading-[160%] color-neutral-black-100">Berita</h1>
                        </Link>
                      ) : (
                        <Link to="/en/news" className="flex flex-col gap-2">
                          <h1 className="title-navbar font-bold fs-18 leading-[160%] color-neutral-black-100">News</h1>
                        </Link>
                      )}

                      {/* Button Close */}
                      <div className="mx-auto">
                        <button
                          onClick={show_navbar_mobile}
                          type="button"
                          className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                          <svg aria-hidden="true" className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                              fillRule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clipRule="evenodd"
                            ></path>
                          </svg>
                          <span className="sr-only">Close modal</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>

      {/* Desktop View */}
      <div className="navbar-component hidden md:block">
        <div className="header-wrapper w-full">
          <div className="top-navbar bg-primary-blue-100 text-white py-[10px] px-6 w-full">
            <div className="flex flex-row justify-between items-center">
              <div className="left-top-navbar">
                <a href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app&pli=1" target="_blank" className="fs-14 color-neutral-white-100 font-medium">
                  {lang_code === 'id' ? 'Pembaruan terbaru Mobile Aplikasi GJS' : 'New update for GJS Mobile Application'}

                  <span className="material-symbols-outlined ml-1" style={{ fontSize: '16px' }}>
                    north_east
                  </span>
                </a>
              </div>
              <div className="right-top-navbar flex gap-3">
                {/* Contact Button */}
                <Link to={viewContact.to} className="bg-white text-primary px-4 py-1 rounded-sm text-medium fs-14 color-primary-blue-100 text-center flex items-center">
                  {viewContact.label}
                </Link>
                <div className="w-[1px] bg-white"></div>
                <div>
                  <button onClick={show_modal_lang} className="flex items-center">
                    <div className="bg-white w-[32px] h-[32px] rounded-full p-1 flex items-center justify-center">
                      <img alt={currentFlag.alt} src={currentFlag.src} />
                    </div>
                    <span className="material-symbols-outlined color-neutral-white-100 text-base">expand_more</span>
                  </button>

                  <div style={{ display: dropdown_lang ? 'block' : 'none' }} className="bg-white rounded-md absolute right-0 w-44 mt-2 shadow-2xl z-30">
                    <div className="p-4 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                      {currentUrl === '/id/kontak' || currentUrl === '/en/contact' ? (
                        <div>
                          <Link to={direct_link_id} className={`flex p-4 gap-4 items-center rounded-md text-[#233672] ${currentLang === 'id' ? 'bg-primary-blue-20' : 'bg-primary-20'}`}>
                            <div className={`rounded-3xl p-[4px] ${currentLang === 'id' ? 'bg-primary-blue-20' : ''}`}>
                              <img src="/images/language/lang-id.png" alt="lang-id" style={{ imageRendering: 'pixelated' }} />
                            </div>
                            Indonesia
                          </Link>
                          <Link to={direct_link_en} className={`flex p-4 gap-4 items-center rounded-md text-[#233672] ${currentLang === 'en' ? 'bg-primary-blue-20' : 'bg-primary-20'}`}>
                            <div className={`rounded-3xl p-[4px] ${currentLang === 'en' ? 'bg-primary-blue-20' : ''}`}>
                              <img src="/images/language/lang-en.png" alt="lang-en" style={{ imageRendering: 'pixelated' }} />
                            </div>
                            English
                          </Link>
                        </div>
                      ) : (
                        <div>
                          <Link to={direct_link_id} className={`flex p-4 gap-4 items-center rounded-md text-[#233672] ${currentLang === 'id' ? 'bg-primary-blue-20' : 'bg-primary-20'}`}>
                            <div className={`rounded-3xl p-[4px] ${currentLang === 'id' ? 'bg-primary-blue-20' : ''}`}>
                              <img src="/images/language/lang-id.png" alt="lang-id" style={{ imageRendering: 'pixelated' }} />
                            </div>
                            Indonesia
                          </Link>
                          <Link to={direct_link_en} className={`flex p-4 gap-4 items-center rounded-md text-[#233672] ${currentLang === 'en' ? 'bg-primary-blue-20' : 'bg-primary-20'}`}>
                            <div className={`rounded-3xl p-[4px] ${currentLang === 'en' ? 'bg-primary-blue-20' : ''}`}>
                              <img src="/images/language/lang-en.png" alt="lang-en" style={{ imageRendering: 'pixelated' }} />
                            </div>
                            English
                          </Link>
                        </div>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div className="bottom-navbar">
            <nav>
              <div className="flex flex-wrap items-center justify-between">
                <div className="hidden w-full md:block md:w-full">
                  <div className="flex flex-row justify-center h-[72px] space-x-12">
                    <AboutNavbarDropdown lang_code={lang_code} />
                    <ServiceNavbarDropdown lang_code={lang_code} />
                    <div className="hover:scale-105 ease-in-out hover:duration-300">
                      <Link to={currentLang === 'en' ? '/en' : '/'}>
                        <img src="/images/logo/logo_gjs.png" alt="logo-gjs" className="relative top-[-30px]" />
                      </Link>
                    </div>
                    <ProductNavbarDropdown lang_code={lang_code} />
                    <NewsNavbarDropdown lang_code={lang_code} />
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </>
  );
}
