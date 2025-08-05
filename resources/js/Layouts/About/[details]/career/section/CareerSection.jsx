import { useState, useMemo } from 'react';
import { Link, usePage } from '@inertiajs/react';
import career from '../../../../../data/career.json';
import BackNavigation from '../../../../../components/BackNavigation';
import '../career.css';

export default function CareerSection({ lang_code }) {
  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';

  const data_career = career.career;
  const count_career = career.career.length;
  const [search, setSearch] = useState('');

  const searchNews = useMemo(() => {
    if (search === '') {
      return data_career;
    } else {
      return data_career.filter((item) => {
        return item.job_position.toLowerCase().includes(search.toLowerCase());
      });
    }
  }, [search, data_career]);

  const handleSearchChange = (e) => {
    setSearch(e.target.value);
  };

  return (
    <>
      {/* Desktop View */}
      <div className="hidden md:block">
        <BackNavigation backTo={lang_code === 'id' ? 'Tentang' : 'About'} hrefTo={backPath} />

        {/* Content Career */}
        <div className="content-career">
          <div className="content w-10/12 mx-auto flex flex-col gap-6">
            {/* Description */}
            <div className="description flex flex-col gap-4">
              <div className="text-center flex flex-row justify-center">
                <img src="/images/logo/career.png" className="absolute" />
              </div>
              {lang_code === 'id' ? (
                <>
                  <h1 className="color-neutra-black-100 font-bold mt-12 fs-28 md:text-[52px] text-center">Karir</h1>
                  <h6 className="text-base leading-160 font-normal color-neutral-black-60">
                    Global Jasa Sejahtera adalah perusahaan Properti Manajemen terkemuka di Indonesia, yang berkomitmen memberikan pelayanan terbaik bagi industri dan para klien. Kami membuka kesempatan berkarir untuk Anda yang ingin
                    bergabung dan menjadi bagian dari perusahaan kami. <br />
                    <br />
                    Kami mencari individu yang berkualitas, memiliki semangat, keterampilan, dan pengalaman yang dibutuhkan untuk mengisi beberapa posisi yang tersedia. Bergabung bersama kami dan miliki kesempatan untuk mengembangkan karir
                    di bidang pengelolaan properti. Kami menawarkan lingkungan kerja yang positif dan mendukung, serta peluang untuk belajar dan berkembang. <br />
                    <br />
                    Jika Anda merasa memiliki kualifikasi yang dibutuhkan dan tertarik untuk bergabung dengan kami, silakan lihat lowongan pekerjaan yang tersedia dan kirimkan lamaran Anda melalui formulir yang tersedia di situs web kami.
                    Kami berharap dapat mempertimbangkan Anda untuk bergabung dengan Global Jasa Sejahtera dan menjadi bagian dari perusahaan kami yang dinamis dan berkembang pesat.
                  </h6>
                </>
              ) : (
                <>
                  <h1 class="color-neutra-black-100 font-bold mt-12 fs-28 md:text-[52px] text-center">Career</h1>
                  <h6 class="text-base leading-160 font-normal color-neutral-black-60">
                    Global Jasa Sejahtera is a leading Property Management company in Indonesia, which is committed to providing the best service for the industry and its clients. We open career opportunities for those of you who want to
                    join and be part of our company. <br />
                    <br />
                    We are looking for qualified individuals who have the passion, skills and experience needed to fill several available positions. Join us and have the opportunity to develop a career in property management. We offer a
                    positive and supportive work environment, as well as opportunities to learn and develop. <br />
                    <br />
                    If you feel you have the required qualifications and are interested in joining us, please see the available job vacancies and submit your application via the form available on our website. We look forward to considering
                    you to join Global Jasa Sejahtera and to be part of our dynamic and rapidly growing company.
                  </h6>
                </>
              )}
            </div>
            {/* Description */}
            {/* Title */}
            <div className="title flex flex-row justify-between items-center">
              <div>
                <h3 className="color-primary-blue-100 text-[20px] leading-[160%] font-semibold">{lang_code === 'id' ? `Ada ${count_career} Lowongan Tersedia` : `There are ${count_career} available vacancies.`}</h3>
              </div>
              <div>
                <div className="search-form w-full mx-auto flex">
                  <input type="text" value={search} onChange={handleSearchChange} placeholder="Cari Pekerjaan" className="w-full py-4 px-6 bg-neutral-white-100 rounded-l-md rounded-r-none hover:border-none outline-none" />
                </div>
              </div>
            </div>
            {/* Title */}

            {/* Table Career */}
            <div className="table-career">
              <div className="relative overflow-x-auto">
                <table
                  className="w-full text-sm text-left"
                  style={{
                    background: '#ffffff',
                    boxShadow: '0px 20px 40px rgba(33, 36, 58, 0.04)',
                  }}
                >
                  <thead className="bg-primary-blue-100 text-base leading-[160%] color-neutral-white-100 font-bold">
                    <tr>
                      <th scope="col" className="px-10 py-4">
                        Job Position
                      </th>
                      <th scope="col" className="px-10 py-4">
                        Location
                      </th>
                      <th scope="col" className="px-10 py-4">
                        Status
                      </th>
                      <th scope="col" className="px-10 py-4">
                        Expired Date
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    {searchNews.map((item) => (
                      <tr key={item.id}>
                        <th scope="row" className="px-10 py-4 font-semibold text-base leading-[160%] color-primary-blue-100 text-left">
                          <Link href={`/id/tentang/karir/${item.id}`}>{item.job_position}</Link>
                        </th>

                        <td className="px-10 py-4 font-normal text-base leading-[160%] color-neutral-black-100 text-left">{item.location}</td>
                        <td className="px-10 py-4 font-normal text-base leading-[160%] color-neutral-black-100 text-left">{item.status}</td>
                        <td className="px-10 py-4 font-normal text-base leading-[160%] color-neutral-black-100 text-left">{item.expired_date}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
            {/* Table Career */}

            {/* Footer Career */}
            <div className="text-base font-semibold leading-[160%] color-primary-blue-100">
              <a href="https://jobsmnc.co.id/" target="_blank" rel="noopener noreferrer" className="flex flex-row items-center gap-6">
                {lang_code === 'id' ? 'LIHAT JUGA: Peluang Karir di jobsmnc.co.id' : 'SEE ALSO: Career Opportunities at jobsmnc.co.id'}
                <span>
                  <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4.50091 1.00008C4.50091 1.46675 4.87591 1.83341 5.33425 1.83341H9.99258L0.917578 10.9084C0.592578 11.2334 0.592578 11.7584 0.917578 12.0834C1.24258 12.4084 1.76758 12.4084 2.09258 12.0834L11.1676 3.00841V7.66675C11.1676 8.12508 11.5426 8.50008 12.0009 8.50008C12.4592 8.50008 12.8342 8.12508 12.8342 7.66675V1.00008C12.8342 0.541748 12.4592 0.166748 12.0009 0.166748H5.33425C4.87591 0.166748 4.50091 0.541748 4.50091 1.00008Z"
                      fill="#233672"
                    />
                  </svg>
                </span>
              </a>
            </div>
            {/* Footer Career */}
          </div>
        </div>
        {/* End Content Career` */}
      </div>
      {/* End Desktop View */}

      {/* Mobile View */}
      {/* Navigation */}
      <div className="block md:hidden">
        <div className="career">
          <div className="header-career py-[72px]">
            {/* Navigation */}
            <Link href={backPath} className="flex flex-row gap-4 items-center">
              <div className="flex flex-row gap-4 w-10/12 mx-auto items-center">
                <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
                  </svg>
                </div>
                <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-black-100">{lang_code === 'id' ? 'Karir' : 'Career'}</h3>
              </div>
            </Link>
            {/* End Navigation */}

            {/* Banner and Search */}
            <div className="mt-72">
              <img src="/images/services/career-cover.png" className="w-full h-[240px] object-cover" />
            </div>

            <div className="search-form w-10/12 mx-auto flex relative bottom-[30px]">
              <input type="text" value={search} onChange={handleSearchChange} placeholder="Cari Pekerjaan" className="w-full py-4 px-6 bg-neutral-white-100 rounded-l-md rounded-r-none hover:border-none outline-none" />
              <button className="btn-search rounded-r-md">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M12.5006 10.9999H11.7106L11.4306 10.7299C12.6306 9.32989 13.2506 7.41989 12.9106 5.38989C12.4406 2.60989 10.1206 0.389893 7.32063 0.0498932C3.09063 -0.470107 -0.469374 3.08989 0.0506256 7.31989C0.390626 10.1199 2.61063 12.4399 5.39063 12.9099C7.42063 13.2499 9.33063 12.6299 10.7306 11.4299L11.0006 11.7099V12.4999L15.2506 16.7499C15.6606 17.1599 16.3306 17.1599 16.7406 16.7499C17.1506 16.3399 17.1506 15.6699 16.7406 15.2599L12.5006 10.9999ZM6.50063 10.9999C4.01063 10.9999 2.00063 8.98989 2.00063 6.49989C2.00063 4.00989 4.01063 1.99989 6.50063 1.99989C8.99063 1.99989 11.0006 4.00989 11.0006 6.49989C11.0006 8.98989 8.99063 10.9999 6.50063 10.9999Z"
                    fill="white"
                  />
                </svg>
              </button>
            </div>
            {/* Banner and Search */}

            {/* Content */}
            <div className="w-11/12 mx-auto">
              {/* Title  */}
              <h4 className="mb-6 fs-20 leading-160 font-semibold color-primary-blue-100">{lang_code === 'id' ? `${count_career} Lowongan Tersedia` : `${count_career} Vacancies Available`}</h4>
              {/* Title */}
              {/* List Job */}
              {searchNews.map((item) => (
                <div
                  key={item.id}
                  className="list-job-mobile flex flex-col space-y-2 border-b-2 py-[18px] px-4"
                  style={{
                    background: '#ffffff',
                    boxShadow: '0px 20px 40px rgba(33, 36, 58, 0.04)',
                  }}
                >
                  <Link href={`/id/tentang/karir/${item.id}`} className="text-2xl leading-[150%] font-semibold color-primary-blue-100">
                    {item.job_position}
                  </Link>
                  <h6 className="font-normal text-base leading-[160%] color-neutral-black-100">{item.location}</h6>
                  <h6 className="font-normal text-base leading-[160%] color-neutral-black-100">{item.status}</h6>
                </div>
              ))}

              <a href="https://jobsmnc.co.id/" target="_blank" rel="noopener noreferrer" className="flex flex-row items-center gap-6">
                {lang_code === 'id' ? 'LIHAT JUGA: Peluang Karir di jobsmnc.co.id' : 'SEE ALSO: Career Opportunities at jobsmnc.co.id'}
                <span>
                  <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4.50091 1.00008C4.50091 1.46675 4.87591 1.83341 5.33425 1.83341H9.99258L0.917578 10.9084C0.592578 11.2334 0.592578 11.7584 0.917578 12.0834C1.24258 12.4084 1.76758 12.4084 2.09258 12.0834L11.1676 3.00841V7.66675C11.1676 8.12508 11.5426 8.50008 12.0009 8.50008C12.4592 8.50008 12.8342 8.12508 12.8342 7.66675V1.00008C12.8342 0.541748 12.4592 0.166748 12.0009 0.166748H5.33425C4.87591 0.166748 4.50091 0.541748 4.50091 1.00008Z"
                      fill="#233672"
                    />
                  </svg>
                </span>
              </a>
              {/* List Job */}
            </div>

            {/* Content */}
          </div>
        </div>
      </div>
    </>
  );
}
