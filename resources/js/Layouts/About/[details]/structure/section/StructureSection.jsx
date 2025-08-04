import '../structure.css';
import { useLocation } from 'react-router-dom';
import BackNavigation from '../../../../../components/BackNavigation';
import { Link } from 'react-router-dom';

export default function StructureSection({ lang_code }) {
  const location = useLocation();

  const backPath = location.pathname.startsWith('/en') ? '/en' : '/id';

  return (
    <div className="content-about">
      <BackNavigation backTo={lang_code === 'id' ? 'Tentang' : 'About'} hrefTo={backPath} />

      <section className="hidden md:block">
        <div className="mx-auto w-10/12">
          <div className="text-center flex flex-row justify-center">
            <img src="/images/logo/corporate-structure.png" className="absolute" />
          </div>
          <h1 className="color-neutral-black-100 font-bold mt-16 fs-28 md:text-[52px] text-center">{lang_code === 'id' ? 'Struktur Perusahaan' : 'Corporate Structure'}</h1>

          <div className="max-w-4xl mx-auto my-8 p-4 bg-white rounded-2xl">
            <h2 className="text-xl font-semibold text-center mb-4">{lang_code === 'id' ? 'Struktur MNC Group' : 'MNC Group Structure'}</h2>
            <div className="rounded-lg border border-gray-200 px-2 py-2 relative w-full">
              <div className="inset-0 flex justify-center items-start z-10">
                <a href="https://www.mncgroup.com/" target="_blank">
                  <img src="/images/about/MNCGroup.png" alt="logo-MNCGroup" className="border-[1px] px-3 py-3 border-blue-900 rounded-10 w-32 hover:opacity-80" />
                </a>
              </div>
              <img src="/images/about/struktur-mnc-group-feb-2025.png" alt="struktur-MNCGroup" className="w-full h-auto" />
            </div>
          </div>
          <div className="max-w-4xl mx-auto my-8 p-4 bg-white rounded-2xl">
            <h2 className="text-xl font-semibold text-center mb-4">Holding Company (Tourism & Hospitality)</h2>
            <div className="rounded-lg border border-gray-200 px-2 py-2 relative w-full">
              <div className="inset-0 flex justify-center items-start z-10">
                <a href="https://www.mncland.com/" target="_blank">
                  <img src="/images/logo/mnc-tourism-indonesia.webp" alt="logo-MNCTourism" className="border-[1px] px-2 py-2 border-green-700 rounded-10 w-36 hover:opacity-80" />
                </a>
              </div>
              <img src="/images/about/struktur-mnc-group-tourism-hospitality-250520.jpg" alt="struktur-MNCGroup-TH" className="w-full h-auto" />
            </div>
          </div>

          <div className="grid grid-cols-3 h-[600px]">
            <div className="col-span-1 place-self-start">
              <div className="card px-4 py-6">
                <div className="mnc-land flex flex-col items-center">
                  <a href="https://www.mncland.com/" target="_blank">
                    <img src="/images/logo/mnc-tourism-indonesia.webp" alt="logo-MNCTourism" className="px-6 hover:opacity-80" />
                  </a>
                  <h1 className="color-neutral-black-100 fs-18 text-center font-semibold mt-2 mb-2">PT MNC Tourism Indonesia Tbk</h1>
                </div>
              </div>
            </div>
            <div className="col-span-1 place-self-center">
              <img src="/images/about/arrow.png" alt="" />
              <div className="card card-active px-16 py-6 ml-8 mb-32">
                <div className="mnc-land flex flex-col items-center">
                  <Link to={lang_code === 'id' ? '/id' : '/en'}>
                    <img src="/images/about/structure-gjs.png" alt="logo-GJS" className="hover:opacity-80" />
                  </Link>
                  <h1 className="color-neutral-black-100 fs-18 text-center font-semibold mt-6">PT Global Jasa Sejahtera</h1>
                </div>
              </div>
            </div>
            <div className="col-span-1 place-self-end">
              <img src="/images/about/arrow.png" alt="" />
              <div className="card px-16 py-4 ml-10 mb-10">
                <div className="mnc-land flex flex-col items-center">
                  <a href="https://bsrindonesia.com/" target="_blank">
                    <img src="/images/about/structure-bsr.png" alt="logo-BSR" className="mt-3 hover:opacity-80" />
                  </a>
                  <h1 className="color-neutral-black-100 fs-18 text-center font-semibold mt-5 mb-3">PT BSR Indonesia</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="block md:hidden">
        <div className="mx-auto w-full">
          <div
            className="flex flex-col items-center justify-center p-10 gap-10"
            style={{
              background: 'linear-gradient(180deg, rgba(35, 54, 114, 0.08) 0%, rgba(35, 54, 114, 0) 100%)',
            }}
          >
            <h1 className="color-neutral-black-100 text-center fs-28 font-bold leading-[150%]">{lang_code === 'id' ? 'Struktur Perusahaan' : 'Corporate Structure'}</h1>

            <div className="max-w-4xl mx-auto p-4 bg-white rounded-2xl">
              <h2 className="text-xl font-semibold text-center mb-4">{lang_code === 'id' ? 'Struktur MNC Group' : 'MNC Group Structure'}</h2>
              <div className="rounded-lg border border-gray-200 px-2 py-2 relative w-full">
                <div className="inset-0 flex justify-center items-start z-10">
                  <a href="https://www.mncgroup.com/" target="_blank">
                    <img src="/images/about/MNCGroup.png" alt="logo-MNCGroup" className="border-[1px] px-3 py-2 border-blue-900 rounded-5 w-24 hover:opacity-80" />
                  </a>
                </div>
                <img src="/images/about/struktur-mnc-group-feb-2025.png" alt="struktur-MNCGroup" className="w-full h-auto" />
              </div>
            </div>
            <div className="max-w-4xl mx-auto p-4 bg-white rounded-2xl">
              <h2 className="text-xl font-semibold text-center mb-4">Holding Company (Tourism & Hospitality)</h2>
              <div className="rounded-lg border border-gray-200 px-2 py-2 relative w-full">
                <div className="inset-0 flex justify-center items-start z-10">
                  <a href="https://www.mncland.com/" target="_blank">
                    <img src="/images/logo/mnc-tourism-indonesia.webp" alt="logo-MNCLand" className="border-[1px] px-2 py-2 border-green-800 rounded-5 w-24 hover:opacity-80" />
                  </a>
                </div>
                <img src="/images/about/struktur-mnc-group-tourism-hospitality-250520.jpg" alt="struktur-MNCGroup-TH" className="w-full h-auto" />
              </div>
            </div>

            <div className="flex flex-col items-center">
              <div className="bg-white border-[1px] p-3 rounded-[8px]">
                <a href="https://www.mncland.com/" target="_blank">
                  <img src="/images/logo/mnc-tourism-indonesia.webp" alt="logo-MNCTourism" className="w-[165px] h-[70px] object-contain hover:opacity-80" />
                </a>
              </div>
              <h1 className="color-neutral-black-100 fs-18 text-center font-semibold mt-8">PT MNC Tourism Indonesia Tbk</h1>
            </div>
            <svg width="13" height="94" viewBox="0 0 13 94" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M1.16667 6C1.16667 8.94552 3.55448 11.3333 6.5 11.3333C9.44552 11.3333 11.8333 8.94552 11.8333 6C11.8333 3.05448 9.44552 0.666667 6.5 0.666667C3.55448 0.666667 1.16667 3.05448 1.16667 6ZM6.5 94L12.2735 84H0.726497L6.5 94ZM5.5 6V85H7.5V6H5.5Z"
                fill="#233672"
              />
            </svg>

            <div className="flex flex-col items-center">
              <div className="bg-white card-active border-[4px] p-3 rounded-[8px]">
                <Link to={lang_code === 'id' ? '/id' : '/en'}>
                  <img src="/images/about/structure-gjs.png" alt="logo-GJS" className="w-[165px] h-[70px] object-contain hover:opacity-80" />
                </Link>
              </div>
              <h1 className="color-neutral-black-100 fs-18 text-center font-semibold mt-8">PT Global Jasa Sejahtera</h1>
            </div>
            <svg width="13" height="94" viewBox="0 0 13 94" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M1.16667 6C1.16667 8.94552 3.55448 11.3333 6.5 11.3333C9.44552 11.3333 11.8333 8.94552 11.8333 6C11.8333 3.05448 9.44552 0.666667 6.5 0.666667C3.55448 0.666667 1.16667 3.05448 1.16667 6ZM6.5 94L12.2735 84H0.726497L6.5 94ZM5.5 6V85H7.5V6H5.5Z"
                fill="#233672"
              />
            </svg>

            <div className="flex flex-col items-center">
              <div className="bg-white border-[1px] p-3 rounded-[8px]">
                <a href="https://bsrindonesia.com/" target="_blank">
                  <img src="/images/about/structure-bsr.png" alt="logo-BSR" className=" w-[165px] h-[70px] object-contain hover:opacity-80" />
                </a>
              </div>
              <h1 className="color-neutral-black-100 fs-18 text-center font-semibold mt-8">PT BSR Indonesia</h1>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
