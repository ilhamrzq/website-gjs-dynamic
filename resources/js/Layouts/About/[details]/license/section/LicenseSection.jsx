import { Link, useLocation } from 'react-router-dom';
import data_licensi from '../../../../../data/surat_izin.json';
import '../license.css';

export default function LicenseSection({ lang_code }) {
  const dataLicense = data_licensi.surat_izin;

  const location = useLocation();

  const backPath = location.pathname.startsWith('/en') ? '/en' : '/id';

  return (
    <div className="content-newspage">
      <div className="training-center__service relative hidden md:block">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backPath} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-white-100">{lang_code === 'id' ? 'Tentang' : 'About'}</h3>
          </Link>
        </div>
        <div className="absolute left-0 right-0 bottom-[-100px] justify-center flex flex-col items-center">
          <div className="license-icon">
            <div className="license-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                workspace_premium
              </span>
            </div>
          </div>
          <h1 className="fs-28 font-bold text-center">{lang_code === 'id' ? 'Surat Izin Operasional' : 'Operating License'}</h1>
        </div>
      </div>

      <div className="training-center__service__mobile relative block md:hidden">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backPath} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-black-100">{lang_code === 'id' ? 'Tentang' : 'About'}</h3>
          </Link>
        </div>
        <div className="image-banner-mobile">
          <img className="w-full" src="/images/services/mobile/service_mobile_consultacy.png" alt="training-center" />
        </div>
        <div className="absolute left-0 right-0 bottom-[-160px] justify-center flex flex-col items-center bg-layanan py-[56px]">
          <div className="license-icon">
            <div className="license-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                workspace_premium
              </span>
            </div>
          </div>
          <h1 className="fs-24 font-bold text-center">{lang_code === 'id' ? 'Surat Izin Operasional' : 'Operating License'}</h1>
        </div>
      </div>
      <section>
        <div className="w-11/12 md:w-11/12 mx-auto my-[180px] grid grid-flow-row gap-12">
          <div className="list-sertifikat">
            <div className="list">
              <table className="table-fixed w-full md:w-10/12 mx-auto">
                <thead>
                  <tr>
                    <th className="font-semibold text-left text-[18px] tracking-wide p-4">Date</th>
                    <th className="font-semibold text-center md:text-left text-[18px] tracking-wide p-4">Title Documents</th>
                    <th className="font-semibold text-center text-[18px] tracking-wide p-4">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {dataLicense.map((item) => (
                    <tr key={item.id} style={{ borderBottom: '1px solid #d1d1d1' }}>
                      <td className="p-4 text-left text-blue-600">{item.date}</td>
                      <td className="p-4 text-left">{item.name}</td>
                      <td className="p-4 text-center">
                        <a href={item.url} download className="cursor-pointer" target="_blank" rel="noopener noreferrer">
                          <span className="material-symbols-outlined text-[24px]">Preview Download</span>
                        </a>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
      {/* End Section 2 */}
    </div>
  );
}
