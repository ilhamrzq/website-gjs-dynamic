import { Link, usePage } from '@inertiajs/react';
import '../portofolio.css';

export default function ImageSection({ lang_code }) {
  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';

  return (
    <div className="content-newspage">
      <div className="training-center__service relative hidden md:block">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link href={backPath} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-white-100">{lang_code === 'id' ? 'Tentang' : 'About'}</h3>
          </Link>
        </div>
        <div className="absolute left-0 right-0 bottom-[-100px] justify-center flex flex-col items-center">
          <div className="portofolio-icon">
            <div className="portofolio-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                badge
              </span>
            </div>
          </div>
          <h1 className="fs-24 font-bold text-center">
            {lang_code === 'id' ? 'Portofolio' : 'Portfolio'}
          </h1>
        </div>
      </div>

      <div className="training-center__service_mobile relative block md:hidden">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link href={backPath} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-black-100">{lang_code === 'id' ? 'Layanan' : 'Service'}</h3>
          </Link>
        </div>
        <div className="image-banner-mobile">
          <img className="w-full" src="/images/services/mobile/service_mobile_consultacy.png" alt="training-center" />
        </div>
        <div className="absolute left-0 right-0 bottom-[-160px] justify-center flex flex-col items-center bg-layanan py-[56px]">
          <div className="portofolio-icon">
            <div className="portofolio-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                badge
              </span>
            </div>
          </div>
          <h1 className="fs-24 font-bold text-center">Portofolio</h1>
        </div>
      </div>

      <section>
        <div className="w-11/12 md:w-10/12 mx-auto my-[180px] grid grid-flow-row gap-12">
          <div className="list-portofolio">
            <h1 className="text-[32px] font-bold text-left pl-3">MNC Center</h1>
            <div className="portofolio-mnc-center">
              <div className="image-portofolio grid grid-cols-4 gap-4">
                <img src="/images/portofolio/mnc-center/mnc-tower.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/inews-tower.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/fincen-tower.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/park-tower.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/wisma-indovision.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/wisma-indovision2.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/gedung-highend.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/gedung-sindo.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
                <img src="/images/portofolio/mnc-center/menara-sudirman.webp" className="max-h-[500px] h-full w-full 2xl:object-cover" />
              </div>
            </div>
          </div>
          <div className="list-portofolio">
            <h1 className="text-[32px] font-bold text-left pl-3">MNC Studio</h1>
            <div className="portofolio-mnc-center">
              <div className="image-portofolio">
                <img src="/images/portofolio/mnc-studio/mnc-studio.webp" className="h-full w-full 2xl:object-cover" />
              </div>
            </div>
          </div>
          <div className="list-portofolio">
            <h1 className="text-[32px] font-bold text-left pl-3">MNC Surabaya & Bali</h1>
            <div className="portofolio-mnc-center">
              <div className="image-portofolio grid grid-flow-col gap-4">
                <img src="/images/portofolio/bali-surabaya/mnc-tower-surabaya.webp" className="max-h-[600px] h-full w-full" />
                <img src="/images/portofolio/bali-surabaya/one-east.webp" className="max-h-[600px] h-full w-full" />
                <img src="/images/portofolio/bali-surabaya/wisma-indovision.webp" className="max-h-[600px] h-full w-full" />
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
