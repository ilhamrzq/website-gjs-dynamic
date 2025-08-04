import { Link } from 'react-router-dom';
import '../consultancy.css';

export default function ConsultancySection({ lang_code }) {
  const backLink = lang_code === 'id' ? { to: '/id', label: 'Layanan' } : { to: '/en', label: 'Service Detail' };

  return (
    <div className="content-newspage">
      <div className="consultancy-security__service relative hidden md:block">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backLink.to} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-white-100">
              {backLink.label}
            </h3>
          </Link>
        </div>
        <div className="absolute left-0 right-0 bottom-[-100px] justify-center flex flex-col items-center">
          <div className="consultancy-icon">
            <div className="consultancy-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                security
              </span>
            </div>
          </div>
          <h1 className="fs-28 font-bold text-center">{lang_code === 'id' ? 'Jasa Pengamanan & Konsultasi Keamanan' : 'Security & Consultancy'}</h1>
        </div>
      </div>

      <div className="consultancy-security__service_mobile relative block md:hidden">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backLink.to} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-black-100">
              {backLink.label}
            </h3>
          </Link>
        </div>
        <div className="image-banner-mobile">
          <img className="w-full" src="/images/services/mobile/service_mobile_training.png" alt="builing-management" />
        </div>
        <div className="absolute left-0 right-0 bottom-[-160px] justify-center flex flex-col items-center bg-layanan py-[36px]">
          <div className="consultancy-icon">
            <div className="consultancy-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                security
              </span>
            </div>
          </div>
          <h1 className="fs-24 font-bold text-center">{lang_code === 'id' ? 'Jasa Pengamanan & Konsultasi Keamanan' : 'Security & Consultancy'}</h1>
        </div>
      </div>

      <section>
        {lang_code === 'id' ? (
          <div className="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p className="text-subtitle">
              Keamanan merupakan salah satu faktor terpenting dalam kegiatan bisnis. Dengan adanya sistem keamanan dan satuan pengamanan yang baik dapat tercipta lingkungan yang kondusif dan aman sehingga perusahaan dapat fokus pada
              kegiatan bisnis utamanya. <br />
              <br />
              Kami menyediakan jasa pengamanan yang didukung oleh personil satuan pengamanan yang profesional dan telah lulus dari berbagai pelatihan sesuai dengan standar operasional prosedur. Untuk memberikan pelayanan secara end-to-end,
              kami juga menyediakan jasa konsultan keamanan untuk kebutuhan bisnis Anda. <br />
              <br />
              Kami juga menyediakan jasa konsultasi keamanan kepada perusahaan atau perseorangan dengan menerapkan teknologi dan peralatan keamanan serta meliputi cara atau prosedur pengamanan suatu objek yang disesuaikan dengan kondisi
              area serta perjanjian dengan pengguna jasa atau klien. <br />
              <br />
              Lingkup pekerjaan untuk konsultasi keamanan meliputi identifikasi proses bisnis dan penilaian kerentanan, identifikasi karakteristik aset, penilaian ancaman, analisis ancaman, penilaian risiko, rencana safeguard, dan analisis
              pengendalian. <br />
              <br />
              Layanan yang kami sediakan dilengkapi dengan sertifikat Badan Usaha Jasa Pengamanan di bidang: <br />
              a. Penyedia tenaga pengamanan <br />
              b. Pelatihan keamanan <br />
              c. Penerapan peralatan keamanan <br />
              d. Konsultasi keamanan <br />
              <br />
              Menjadi berpengalaman, terpercaya dan sistem manajemen yang baik dalam bisnis layanan Keamanan adalah investasi nilai yang sangat dihargai oleh perusahaan kami. Untuk itu, kami berkomitmen untuk selalu fokus dan menyelaraskan
              aktivitas kami dengan harapan dapat melindungi, meningkatkan, dan menjaga reputasi semua klien kami.
              <br />
              <br />
              Poin kuat kami: <br />
              1. Kami menerapkan studi dan pelatihan yang konsisten dan kompeten untuk menjadikan tenaga kerja kami profesional. <br />
              2. Kami merencanakan dan mengembangkan sistem manajemen keamanan sesuai dengan karakteristik lingkungan kerja. <br />
              3. Membangun hubungan dan hubungan yang baik dengan semua pemangku kepentingan. <br />
              4. Sistem pengawasan dan pelaporan yang terorganisir. <br />
              <br />
              <br />
              Motto Kami: Profesional, Proporsional, Responsif, Kemitraan, dan Kepercayaan. <br />
            </p>
          </div>
        ) : (
          <div className="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p className="text-subtitle">
              The provision of Security consultancy services for clients is a form of service, where the application of technology for security taking into account the application and the procedures that matches the building and the
              conditions in the surrounding area and within the client’s building.
              <br />
              <br />
              As for the scope of work, it includes identification of the business process or work administration and analyze the environment surrounding the building, the characteristics of the asset, its value, the threats and risks, the
              dangers and the analysis to contain all these aspects. Formed to serve and protect companies, the whole company and its assets to create a conducive and safe environment so that the company can focus on its principle business.
              <br />
              <br />
              Being experienced, trusted and a good management system in the Security service business is an investment of value much appreciated by our company. Towards this end, we are committed to always be focused and align our
              activities with the hope of protecting, upgrading and keep the reputation of all our clients.
              <br />
              <br />
              Our strong points: <br />
              1. We apply consistent and competent study and training to make our workforce professionals. <br />
              2. We plan and develop a management system of security according to the characteristics of the working environment.
              <br />
              3. Build a good rapport and relationship with all stakeholders.
              <br />
              4. An organized system of supervision and reporting.
              <br />
              <br />
              Our Motto: Professional, Proportional, Responsive, Partnership and Trust
              <br />
              <br />
              Besides functioning as a Security Service Consultant, we also serve in the following fields: <br />
              1. Security Device Providers We supply our clients with the latest and quality technology Security devices that will best match the needs of our client. <br />
              2. Security Training Center. <br />
              3. Security Guard Services Providing a Security Unit to match the client’s requirement. Security Guards (Satpam) to provide security services to keep the peace and order in their said work area including safety and surety.
              <br />
            </p>
          </div>
        )}
      </section>
    </div>
  );
}
