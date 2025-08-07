import { Link } from '@inertiajs/react';
import '../assets/css/footer.css';
import { validateAndSanitizePhoneNumber } from '../Utils/whatsapp';

export default function Footer({ lang_code }) {
  const whatsappHref = () => {
    const phoneNumber = '081513911456';
    try {
      const sanitizedPhoneNumber = validateAndSanitizePhoneNumber(phoneNumber);
      const whatsappURL = `https://api.whatsapp.com/send?phone=${sanitizedPhoneNumber}`;
      window.open(whatsappURL, '_blank');
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <>
      <div className="footer-component">
        <div className="wrapper-footer mt-40">
          <div className="footer w-full">
            <div className="flex flex-col md:flex-row w-full md:w-11/12 gap-10 md:gap-0">
              <div className="footer-image md:w-3/12 px-4 md:px-[72px] justify-center flex flex-row">
                <Link href={lang_code === 'id' ? '/id' : '/en'}>
                  <img src="/images/logo/logo-footer.png" alt="footer-logo" className="rounded-t-2xl w-full object-cover" />
                </Link>
              </div>
              <div className="flex flex-col gap-10 md:gap-0 md:flex-row justify-between w-full md:w-9/12 md:mx-0">
                <div className="footer-contact">
                  <div className="list-contact__head mb-4">
                    <h1 className="text-white fs-22 font-semibold text-center md:text-left">{lang_code === 'id' ? 'Kontak' : 'Contacts'}</h1>
                  </div>

                  {lang_code === 'id' ? (
                    <div className="list-contact__body flex flex-col gap-4 items-start">
                      <div className="flex gap-4">
                        <span className="material-symbols-outlined text-sm color-neutral-white-60"> location_on </span>
                        <p className="text-left color-neutral-white-60 hidden md:block">
                          Gedung i-Hub Lantai 3A, <br />
                          Jalan KH. Wahid Hasyim No. 38, <br />
                          Jakarta Pusat 10340, <br />
                          Indonesia
                        </p>
                        <p className="text-left color-neutral-white-60 block md:hidden">Gedung i-Hub Lantai 3A, Jalan KH. Wahid Hasyim No. 38, Jakarta Pusat 10340, Indonesia</p>
                      </div>

                      <p className="flex items-center gap-4">
                        <span className="material-symbols-outlined text-sm"> fax </span>
                        +62 21 3983 6667 (08.30 - 17.30)
                      </p>
                      <p className="flex items-center gap-4">
                        <span className="material-symbols-outlined text-sm"> phone </span>
                        +62 21 391 1456 (08.30 - 17.30)
                      </p>
                      <p className="flex items-center gap-4">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clipPath="url(#clip0_193_17497)">
                            <path
                              d="M19.0498 4.91C17.1798 3.03 14.6898 2 12.0398 2C6.5798 2 2.1298 6.45 2.1298 11.91C2.1298 13.66 2.5898 15.36 3.4498 16.86L2.0498 22L7.2998 20.62C8.7498 21.41 10.3798 21.83 12.0398 21.83C17.4998 21.83 21.9498 17.38 21.9498 11.92C21.9498 9.27 20.9198 6.78 19.0498 4.91ZM12.0398 20.15C10.5598 20.15 9.1098 19.75 7.8398 19L7.5398 18.82L4.4198 19.64L5.2498 16.6L5.0498 16.29C4.2298 14.98 3.7898 13.46 3.7898 11.91C3.7898 7.37 7.4898 3.67 12.0298 3.67C14.2298 3.67 16.2998 4.53 17.8498 6.09C19.4098 7.65 20.2598 9.72 20.2598 11.92C20.2798 16.46 16.5798 20.15 12.0398 20.15ZM16.5598 13.99C16.3098 13.87 15.0898 13.27 14.8698 13.18C14.6398 13.1 14.4798 13.06 14.3098 13.3C14.1398 13.55 13.6698 14.11 13.5298 14.27C13.3898 14.44 13.2398 14.46 12.9898 14.33C12.7398 14.21 11.9398 13.94 10.9998 13.1C10.2598 12.44 9.7698 11.63 9.6198 11.38C9.4798 11.13 9.5998 11 9.7298 10.87C9.8398 10.76 9.9798 10.58 10.0998 10.44C10.2198 10.3 10.2698 10.19 10.3498 10.03C10.4298 9.86 10.3898 9.72 10.3298 9.6C10.2698 9.48 9.7698 8.26 9.5698 7.76C9.3698 7.28 9.1598 7.34 9.0098 7.33C8.8598 7.33 8.6998 7.33 8.5298 7.33C8.3598 7.33 8.0998 7.39 7.8698 7.64C7.6498 7.89 7.0098 8.49 7.0098 9.71C7.0098 10.93 7.8998 12.11 8.0198 12.27C8.1398 12.44 9.7698 14.94 12.2498 16.01C12.8398 16.27 13.2998 16.42 13.6598 16.53C14.2498 16.72 14.7898 16.69 15.2198 16.63C15.6998 16.56 16.6898 16.03 16.8898 15.45C17.0998 14.87 17.0998 14.38 17.0298 14.27C16.9598 14.16 16.8098 14.11 16.5598 13.99Z"
                              fill="white"
                              fillOpacity="0.6"
                            />
                          </g>
                          <defs>
                            <clipPath id="clip0_193_17497">
                              <rect width="24" height="24" fill="white" />
                            </clipPath>
                          </defs>
                        </svg>
                        +62 8151 391 1456 (Chat only)
                      </p>
                      <p className="flex items-center gap-4">
                        <span className="material-symbols-outlined text-sm"> mail </span>
                        marketing.gjs@mncgroup.com
                      </p>
                    </div>
                  ) : (
                    <div className="list-contact__body flex flex-col gap-4 items-start">
                      <div className="flex gap-4">
                        <span className="material-symbols-outlined text-sm color-neutral-white-60">location_on</span>
                        <p className="text-left color-neutral-white-60 hidden md:block">
                          Gedung i-Hub Lantai 3A, <br />
                          Jalan KH. Wahid Hasyim No. 38, <br />
                          Jakarta Pusat 10340, <br />
                          Indonesia
                        </p>
                        <p className="text-left color-neutral-white-60 block md:hidden">Gedung i-Hub Lantai 3A, Jalan KH. Wahid Hasyim No. 38, Jakarta Pusat 10340, Indonesia</p>
                      </div>
                      <p className="flex items-center gap-4">
                        <span className="material-symbols-outlined text-sm"> fax </span>
                        +62 21 3983 6667 (08.30 - 17.30)
                      </p>
                      <p className="flex items-center gap-4">
                        <span className="material-symbols-outlined text-sm"> phone </span>
                        +62 21 391 1456 (08.30 - 17.30)
                      </p>
                      <p className="flex items-center gap-4">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clipPath="url(#clip0_193_17497)">
                            <path
                              d="M19.0498 4.91C17.1798 3.03 14.6898 2 12.0398 2C6.5798 2 2.1298 6.45 2.1298 11.91C2.1298 13.66 2.5898 15.36 3.4498 16.86L2.0498 22L7.2998 20.62C8.7498 21.41 10.3798 21.83 12.0398 21.83C17.4998 21.83 21.9498 17.38 21.9498 11.92C21.9498 9.27 20.9198 6.78 19.0498 4.91ZM12.0398 20.15C10.5598 20.15 9.1098 19.75 7.8398 19L7.5398 18.82L4.4198 19.64L5.2498 16.6L5.0498 16.29C4.2298 14.98 3.7898 13.46 3.7898 11.91C3.7898 7.37 7.4898 3.67 12.0298 3.67C14.2298 3.67 16.2998 4.53 17.8498 6.09C19.4098 7.65 20.2598 9.72 20.2598 11.92C20.2798 16.46 16.5798 20.15 12.0398 20.15ZM16.5598 13.99C16.3098 13.87 15.0898 13.27 14.8698 13.18C14.6398 13.1 14.4798 13.06 14.3098 13.3C14.1398 13.55 13.6698 14.11 13.5298 14.27C13.3898 14.44 13.2398 14.46 12.9898 14.33C12.7398 14.21 11.9398 13.94 10.9998 13.1C10.2598 12.44 9.7698 11.63 9.6198 11.38C9.4798 11.13 9.5998 11 9.7298 10.87C9.8398 10.76 9.9798 10.58 10.0998 10.44C10.2198 10.3 10.2698 10.19 10.3498 10.03C10.4298 9.86 10.3898 9.72 10.3298 9.6C10.2698 9.48 9.7698 8.26 9.5698 7.76C9.3698 7.28 9.1598 7.34 9.0098 7.33C8.8598 7.33 8.6998 7.33 8.5298 7.33C8.3598 7.33 8.0998 7.39 7.8698 7.64C7.6498 7.89 7.0098 8.49 7.0098 9.71C7.0098 10.93 7.8998 12.11 8.0198 12.27C8.1398 12.44 9.7698 14.94 12.2498 16.01C12.8398 16.27 13.2998 16.42 13.6598 16.53C14.2498 16.72 14.7898 16.69 15.2198 16.63C15.6998 16.56 16.6898 16.03 16.8898 15.45C17.0998 14.87 17.0998 14.38 17.0298 14.27C16.9598 14.16 16.8098 14.11 16.5598 13.99Z"
                              fill="white"
                              fillOpacity="0.6"
                            />
                          </g>
                          <defs>
                            <clipPath id="clip0_193_17497">
                              <rect width="24" height="24" fill="white" />
                            </clipPath>
                          </defs>
                        </svg>
                        +62 8151 391 1456 (Chat only)
                      </p>
                      <p className="flex items-center gap-4">
                        <span className="material-symbols-outlined text-sm"> mail </span>
                        marketing.gjs@mncgroup.com
                      </p>
                    </div>
                  )}
                </div>
                <div className="footer-social-media">
                  <div className="list-socialmedia__head mb-4">
                    <h1 className="text-white fs-22 font-semibold text-center md:text-left">Social Media</h1>
                  </div>
                  <div className="list-socialmedia__body flex flex-col gap-4 items-start">
                    <div className="flex gap-4">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clipPath="url(#clip0_858_382)">
                          <g clipPath="url(#clip1_858_382)">
                            <path
                              d="M21.6471 8.4877C21.6034 7.49593 21.443 6.8141 21.2133 6.22328C20.9763 5.59614 20.6117 5.03467 20.1339 4.56791C19.6672 4.09389 19.102 3.72556 18.4821 3.49225C17.8879 3.26251 17.2096 3.10213 16.2179 3.0584C15.2187 3.01097 14.9015 3 12.3673 3C9.83313 3 9.51593 3.01097 8.52046 3.05469C7.52869 3.09842 6.84686 3.25894 6.25619 3.48855C5.62891 3.72556 5.06744 4.09019 4.60069 4.56791C4.12667 5.03467 3.75848 5.59985 3.52503 6.21972C3.29528 6.8141 3.1349 7.49223 3.09117 8.48399C3.04374 9.48317 3.03278 9.80037 3.03278 12.3346C3.03278 14.8687 3.04374 15.1859 3.08747 16.1814C3.1312 17.1732 3.29172 17.855 3.52147 18.4458C3.75848 19.073 4.12667 19.6344 4.60069 20.1012C5.06744 20.5752 5.63262 20.9435 6.25249 21.1769C6.84686 21.4066 7.52499 21.567 8.5169 21.6107C9.51223 21.6546 9.82957 21.6654 12.3637 21.6654C14.8979 21.6654 15.2151 21.6546 16.2106 21.6107C17.2024 21.567 17.8842 21.4066 18.4749 21.1769C19.7293 20.6919 20.721 19.7001 21.206 18.4458C21.4356 17.8514 21.5962 17.1732 21.6399 16.1814C21.6836 15.1859 21.6946 14.8687 21.6946 12.3346C21.6946 9.80037 21.6909 9.48317 21.6471 8.4877ZM19.9663 16.1085C19.9261 17.0201 19.773 17.5123 19.6454 17.8405C19.3317 18.6536 18.6864 19.299 17.8732 19.6126C17.5451 19.7403 17.0492 19.8934 16.1412 19.9334C15.1567 19.9773 14.8615 19.9881 12.371 19.9881C9.88056 19.9881 9.58159 19.9773 8.60065 19.9334C7.68907 19.8934 7.19682 19.7403 6.86866 19.6126C6.464 19.4631 6.09567 19.2261 5.7967 18.9161C5.48677 18.6135 5.24976 18.2488 5.1002 17.8442C4.97258 17.516 4.81946 17.0201 4.77944 16.1122C4.73557 15.1277 4.72475 14.8323 4.72475 12.3418C4.72475 9.85136 4.73557 9.55239 4.77944 8.57159C4.81946 7.66001 4.97258 7.16776 5.1002 6.83959C5.24976 6.4348 5.48677 6.0666 5.8004 5.76749C6.10293 5.45756 6.46756 5.22055 6.87236 5.07113C7.20053 4.94351 7.69648 4.7904 8.60435 4.75023C9.58886 4.7065 9.88426 4.69553 12.3746 4.69553C14.8687 4.69553 15.164 4.7065 16.1449 4.75023C17.0565 4.7904 17.5488 4.94351 17.8769 5.07113C18.2816 5.22055 18.6499 5.45756 18.9489 5.76749C19.2588 6.07016 19.4958 6.4348 19.6454 6.83959C19.773 7.16776 19.9261 7.66357 19.9663 8.57159C20.01 9.55609 20.021 9.85136 20.021 12.3418C20.021 14.8323 20.01 15.124 19.9663 16.1085Z"
                              fill="white"
                              fillOpacity="0.6"
                            />
                            <path
                              d="M12.3674 7.53986C9.72024 7.53986 7.57248 9.68747 7.57248 12.3348C7.57248 14.982 9.72024 17.1296 12.3674 17.1296C15.0147 17.1296 17.1623 14.982 17.1623 12.3348C17.1623 9.68747 15.0147 7.53986 12.3674 7.53986ZM12.3674 15.4451C10.65 15.4451 9.25705 14.0522 9.25705 12.3348C9.25705 10.6173 10.65 9.22442 12.3674 9.22442C14.0848 9.22442 15.4777 10.6173 15.4777 12.3348C15.4777 14.0522 14.0848 15.4451 12.3674 15.4451V15.4451Z"
                              fill="white"
                              fillOpacity="0.6"
                            />
                            <path
                              d="M18.4713 7.35004C18.4713 7.96821 17.9701 8.46944 17.3518 8.46944C16.7336 8.46944 16.2324 7.96821 16.2324 7.35004C16.2324 6.73174 16.7336 6.23065 17.3518 6.23065C17.9701 6.23065 18.4713 6.73174 18.4713 7.35004V7.35004Z"
                              fill="white"
                              fillOpacity="0.6"
                            />
                          </g>
                        </g>
                        <defs>
                          <clipPath id="clip0_858_382">
                            <rect width="24" height="24" fill="white" />
                          </clipPath>
                          <clipPath id="clip1_858_382">
                            <rect width="18.6655" height="18.6655" fill="white" transform="translate(3 3)" />
                          </clipPath>
                        </defs>
                      </svg>
                      Instagram
                    </div>
                    <p className="flex gap-4">
                      <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clipPath="url(#clip0_858_392)">
                          <path
                            d="M19.3287 19.3333V19.3325H19.3333V12.4865C19.3333 9.13739 18.6123 6.5575 14.697 6.5575C12.8148 6.5575 11.5516 7.59039 11.036 8.56961H10.9815V6.87016H7.2692V19.3325H11.1348V13.1616C11.1348 11.5368 11.4428 9.96573 13.4549 9.96573C15.4374 9.96573 15.467 11.82 15.467 13.2658V19.3333H19.3287Z"
                            fill="white"
                            fillOpacity="0.6"
                          />
                          <path d="M0.97467 6.87103H4.8449V19.3334H0.97467V6.87103Z" fill="white" fillOpacity="0.6" />
                          <path
                            d="M2.90821 0.666687C1.67077 0.666687 0.666656 1.6708 0.666656 2.90824C0.666656 4.14569 1.67077 5.1708 2.90821 5.1708C4.14566 5.1708 5.14977 4.14569 5.14977 2.90824C5.14899 1.6708 4.14488 0.666687 2.90821 0.666687V0.666687Z"
                            fill="white"
                            fillOpacity="0.6"
                          />
                        </g>
                        <defs>
                          <clipPath id="clip0_858_392">
                            <rect width="18.6667" height="18.6667" fill="white" transform="translate(0.666656 0.666687)" />
                          </clipPath>
                        </defs>
                      </svg>
                      Linkedin
                    </p>
                  </div>
                </div>
                <div className="footer-link">
                  <div className="list-link__head mb-4">
                    <h1 className="text-white fs-22 font-semibold text-center md:text-left">Link</h1>
                  </div>
                  {lang_code === 'id' ? (
                    <div className="list-link__body flex flex-col gap-4 items-start">
                      <Link href="/id/tentang/karir">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          Karir di GJS
                        </p>
                      </Link>
                      <Link href="https://www.jobsmnc.co.id/" target="_blank">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          Karir di MNC Group
                        </p>
                      </Link>
                      <Link href="https://www.mncgroup.com/business-unit" target="_blank">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          MNC Group Business
                        </p>
                      </Link>
                      <Link href="/id/sitemap">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          Sitemap
                        </p>
                      </Link>
                      <p className="flex gap-4 text-center w-full justify-center">
                        <Link href={lang_code === 'id' ? '/id' : '/en'} className="hidden md:block">
                          <img src="/images/footer/Logo-GJS.jpg" alt="footer-logo" className="rounded-5" />
                        </Link>
                        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app">
                          <img src="/images/logo/google-play-badge.png" alt="footer-logo" className="rounded-5 text-center" />
                        </a>
                      </p>
                    </div>
                  ) : (
                    <div className="list-link__body flex flex-col gap-4 items-start">
                      <Link href="/en/about/career">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          Career at GJS
                        </p>
                      </Link>
                      <Link href="https://www.jobsmnc.co.id/" target="_blank">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          Career at MNC Group
                        </p>
                      </Link>
                      <Link href="https://www.mncgroup.com/business-unit" target="_blank">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          MNC Group Business
                        </p>
                      </Link>
                      <Link href="/en/sitemap">
                        <p className="flex items-center gap-4">
                          <span className="dot w-2 h-2"> </span>
                          Sitemap
                        </p>
                      </Link>
                      <p className="flex gap-4 text-center w-full justify-center">
                        <Link href={lang_code === 'id' ? '/id' : '/en'} className="hidden md:block">
                          <img src="/images/footer/Logo-GJS.jpg" alt="footer-logo" className="rounded-5" />
                        </Link>
                        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app">
                          <img src="/images/logo/google-play-badge.png" alt="footer-logo" className="rounded-5 text-center" />
                        </a>
                      </p>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>

          <div className="credit">
            <div className="flex flex-col md:flex-row items-center justify-between gap-4 md:gap-0">
              <p className="text-base color-neutral-black-100 leading-160 font-medium">
                a Member of
                <a href="https://www.mncgroup.com/" target="_blank">
                  <img src="/images/about/MNCGroup.png" alt="footer-logo" className="h-10 inline-block ml-1" />
                </a>
              </p>
              <p className="text-base color-neutral-black-100 leading-160 font-medium text-center">
                Copyright © {new Date().getFullYear()} GJS. All Rights Reserved.
              </p>
              <a href="https://www.mncland.com/" target="_blank">
                <img src="/images/logo/mnc-tourism-indonesia.webp" width="108" height="40" alt="footer-logo" />
              </a>
            </div>
          </div>
        </div>
      </div>

      <button onClick={whatsappHref} className="float" target="_blank" aria-label="whatsapp">
        <svg xmlns="http://www.w3.org/2000/svg" className="m-4" viewBox="0 0 48 48" width="30px" height="30px" fillRule="evenodd" clipRule="evenodd">
          <path
            fill="#fff"
            d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"
          />
          <path
            fill="#fff"
            d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"
          />
          <path
            fill="#cfd8dc"
            d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"
          />
          <path
            fill="#40c351"
            d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"
          />
          <path
            fill="#fff"
            fillRule="evenodd"
            d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z"
            clipRule="evenodd"
          />
        </svg>
      </button>
    </>
  );
}
