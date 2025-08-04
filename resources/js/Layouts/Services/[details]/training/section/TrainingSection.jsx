import { Link } from 'react-router-dom';
import '../training.css';

export default function TrainingSection({ lang_code }) {
  const backLink = lang_code === 'id' ? { to: '/id', label: 'Layanan' } : { to: '/en', label: 'Service Detail' };

  return (
    <div className="content-newspage">
      <div className="training-center__service relative hidden md:block">
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
          <div className="training-icon">
            <div className="training-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                badge
              </span>
            </div>
          </div>
          <h1 className="fs-28 font-bold text-center">{lang_code === 'id' ? 'Pusat Pelatihan' : 'Training Center'}</h1>
        </div>
      </div>

      <div className="training-center__service__mobile relative block md:hidden">
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
          <img className="w-full" src="/images/services/mobile/service_mobile_consultacy.png" alt="training-center" />
        </div>
        <div className="absolute left-0 right-0 bottom-[-160px] justify-center flex flex-col items-center bg-layanan py-[56px]">
          <div className="training-icon">
            <div className="training-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                badge
              </span>
            </div>
          </div>
          <h1 className="fs-24 font-bold text-center">{lang_code === 'id' ? 'Pusat Pelatihan' : 'Training Center'}</h1>
        </div>
      </div>

      <section>
        {lang_code === 'id' ? (
          <div className="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p className="text-subtitle">
              Global Jasa Sejahtera menyediakan solusi untuk meningkatkan kompetensi dan kualitas Sumber Daya Manusia dengan berbagai pendidikan dan pelatihan. Materi pendidikan dan pelatihan yang disediakan beragam sesuai dengan bidang
              yang ditekuni oleh setiap inidividu.
              <br />
              <br />
              Jenis Pelatihan: <br />
              1. Pengelolaan dana yang berkaitan dengan keuangan, rumah, keanggotaan, korespondensi, pencatatan, pengkodean, serta hubungan sosial. <br />
              2. Perpustakaan, tata ruang, kumpulan kegiatan kerja dan sinerginya serta program kerja dan penatausahaan barang milik pemerintah <br />
              <br />
              Pelatihan Lanjutan: <br />
              1. Fungsi / Deteksi Intel, Bisnis Internasional, Infiltrasi Fungsi Intel / Deteksi, Intel Bisnis, dan Penyusupan <br />
              2. Pencegahan <br />
              3. Aktivitas Terbatas <br />
              4. Investigasi <br />
              5. Tujuan intel dan Program Pelatihan lainnya. <br />
              <br />
              Pelatihan Khusus: <br />
              1. Pemadaman Kebakaran <br />
              2. Penyelamatan, SAR, K9, Menghadapi Bencana Alam <br />
              3. Senjata Api dan Pengantar tentang Senjata Api <br />
              4. Antisipasi Teror dan Bahan Peledak <br />
              5. Pelatihan Pra-Penugasan <br />
              6. Pelatihan Kontingensi <br />
              7. Pelatihan Bersama <br />
              8. K3U, NAFZA, dan area kerja lainnya <br />
              9. Tujuan Studi <br />
              10. Pelatihan Mengemudi dan ADC atau Pengawal VIP, WalPri, dan Satuan Pe ngamanan <br />
              11. Shift Leader <br />
              12. Kualitas Layanan Pelatihan
            </p>
          </div>
        ) : (
          <div className="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p className="text-subtitle mb-4">
              Global Jasa Sejahtera provides solutions to enhance the competence and quality of Human Resources through various educational and training programs. The education and training materials offered are diverse and tailored to each
              individual's field of expertise.
            </p>

            <p className="text-subtitle mb-4">Types of Training:</p>

            <ol className="list-decimal text-subtitle list-inside mb-4">
              <li>Fund management related to finance, household, membership, correspondence, recording, coding, and social relationships.</li>
              <li>Library, spatial planning, work activities collection, their synergy, as well as government property management programs</li>
            </ol>

            <p className="text-subtitle mb-4">Advanced Training:</p>

            <ol className="list-decimal text-subtitle list-inside mb-4">
              <li>Intelligence Function/Detection, International Business, Intelligence/ Detection Function Infiltration, Business Intelligence, and Infiltration.</li>
              <li>Prevention</li>
              <li>Limited Activities</li>
              <li>Investigation</li>
              <li>Intelligence Objectives and other Training Programs.</li>
            </ol>

            <p className="text-subtitle mb-4">Specialized Training:</p>
            <ol className="list-decimal text-subtitle list-inside mb-4">
              <li>Fire Extinguishing</li>
              <li>Rescue, Search and Rescue (SAR), K9, Disaster Response</li>
              <li>Firearms and Introduction to Firearms</li>
              <li>Counterterrorism and Explosive Materials</li>
              <li>Pre-assignment Training</li>
              <li>Contingency Training</li>
              <li>Joint Training</li>
              <li>Occupational Health and Safety, Hazardous Goods Management, and other work areas</li>
              <li>Study Tours</li>
              <li>Driving Training and Advanced Driving Course or VIP Escort, Executive Protection, and Security Unit</li>
              <li>Shift Leader</li>
              <li>Quality of Service Training</li>
            </ol>
          </div>
        )}
      </section>
    </div>
  );
}
