import { usePage } from '@inertiajs/react';
import BackNavigation from '../../../components/BackNavigation';

export default function AboutSection({ lang_code }) {
  const { url } = usePage();
  
  const backPath = url.startsWith('/en') ? '/en' : '/id';

  return (
    <div className="content-about">
      <BackNavigation backTo={lang_code === 'id' ? 'Tentang' : 'About'} hrefTo={backPath} />
      <section>
        <div className="text-center flex flex-row justify-center">
          <img src="/images/logo/company-overview.png" className="absolute" />
        </div>
        <h1 className="color-neutra-black-100 font-bold mt-16 fs-28 md:text-[52px] text-center">{lang_code === 'id' ? 'Ikhtisar Perusahaan' : 'Company Overview'}</h1>
        <div className="video mb-40 mt-[28px]">
          <div className="w-full md:w-11/12 mx-auto justify-center flex flex-col items-center">
            <video controls width="100%" title="Company Profile video" playsinline="playsinline" className="rounded-0 w-full h-[250px] md:h-[550px] md:rounded-2xl md:w-8/12 md:mx-auto">
              <source src="/video/video_companyprofile-GJS.mp4" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
            <a href="/video/video_companyprofile-GJS.mp4" download className="text-button my-10">
              {lang_code === 'id' ? 'Unduh Profil Perusahaan' : 'Download Company Profile'}
            </a>

            <div className="w-11/12 mx-auto">
              <div className="flex flex-row justify-between my-4">
                <div>
                  <h1 className="text-[24px] leading-[150%] color-primary-blue-100 font-bold">PT GLOBAL JASA SEJAHTERA</h1>
                </div>
              </div>

              <p className="desc text-subtitle text-justify">
                {lang_code === 'id'
                  ? 'Global Jasa Sejahtera (GJS) berdiri sejak tahun 2009 dan anak usaha dari MNC Tourism Indonesia, yang juga menjadi bagian dari MNC Group, salah satu group bisnis nasional terbesar di Indonesia dan menjadi yang terdepan dalam empat bidang usaha strategis, yakni Media & Entertainment, Jasa Keuangan, Entertainment Hospitality, dan Energi.'
                  : 'Global Jasa Sejahtera. In the year 2009, the MNC group expanded its business to include employment services; to provide building management services through the establishment of its subsidiary, PT Global Jasa Sejahtera. Services by GJS is to complement our main business objectives in Property Management. Services offered by GJS covers and includes Property Management, Security Services, office assistants (office-boy, receptionists, messengers and etc.).'}
                <br />
                <br />
                {lang_code === 'id'
                  ? 'GJS telah menerapkan serangkaian standar operasional proseduruntuk meningkatkan nilai properti. Saat ini, GJS mengelolabanyak properti di berbagai kota dengan total cakupan seluas +/-530.000 meter persegi real estate, 500 staf teknis danperhotelan, serta didukung oleh 2.000 personel satuanpengamanan.'
                  : 'We have implemented a series of standard operating procedures to increase the value of the properties under our responsibility, while also aiming to keep costs and expenses as low as possible. The company currently manages many properties reaching an area of +/-530.000 square meters of real estate, 500 technical and hospitality staff and backed by 2,000 strong security personnel.'}
                <br />
                <br />
                {lang_code === 'id'
                  ? 'Selama beberapa tahun terakhir GJS telah meningkatkan fokus pada segmen keamanan dengan standar tinggi dan terus berkembang pesat dengan beragam inovasi, serta berkomitmen untuk tetap mengutamakan loyalitas, soliditas, dan dedikasi bagi kepuasan pelanggan. GJS optimis untuk bersaing di sektor manajemen properti dengan selalu memberikan layanan yang terbaik.'
                  : 'During the past few years we have increased our focus on the high risk security segment and have grown much in building security management. In solid commitment, loyalty and dedication for customer satisfaction, GJS is optimistic to direct its business towards a bright future as a progressive and trusted entity.'}
              </p>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
