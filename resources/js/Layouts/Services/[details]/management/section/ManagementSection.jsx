import { Link } from 'react-router-dom';
import '../management.css';

export default function ManagementSection({ lang_code }) {
  const backLink = lang_code === 'id' ? { to: '/id', label: 'Layanan' } : { to: '/en', label: 'Service Detail' };

  return (
    <div className="content-newspage">
      <div className="building-management__service relative hidden md:block">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backLink.to} className="flex flex-row gap-4 items-center w-full">
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
          <div className="buildingmanagement-icon">
            <div className="buildingmanagement-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                apartment
              </span>
            </div>
          </div>
          <h1 className="fs-28 font-bold text-center">{lang_code === 'id' ? 'Manajemen Properti' : 'Building Management'}</h1>
        </div>
      </div>

      <div className="building-management__service_mobile relative block md:hidden">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backLink.to} className="flex flex-row gap-4 items-center w-full">
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
          <img className="w-full object-cover" src="/images/services/mobile/service_mobile_building_management.png" alt="builing-management" />
        </div>
        <div className="absolute left-0 right-0 bottom-[-150px] justify-center flex flex-col items-center bg-layanan py-[56px]">
          <div className="buildingmanagement-icon">
            <div className="buildingmanagement-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                apartment
              </span>
            </div>
          </div>
          <h1 className="fs-24 font-bold text-center">{lang_code === 'id' ? 'Manajemen Properti' : 'Building Management'}</h1>
        </div>
      </div>

      <section>
        {lang_code === 'id' ? (
          <div className="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p className="text-subtitle">
              Bangunan atau gedung beserta fasilitas dan infrastruktur pendukung lainnya merupakan aset yang harus dipertahankan dan dijaga agar menghasilkan manfaat, serta dapat digunakan dalam jangka waktu panjang. Untuk mencapai tujuan
              tersebut, maka perlu dilakukan pengelolaan gedung yang baik dan professional. <br />
              <br />
              Layanan Manajemen Properti yang kami sediakan mencakup: <br />
              a. Pekerjaan landscape/pertamanan <br />
              b. Perawatan bangunan, gedung, dan Kawasan <br />
              c. Jasa kebersihan <br />
              d. Pemeliharaan barang & peralatan mekanikal, mesin, elektrikal, dan elektronik <br />
              e. Penyediaan suku cadang mekanikal, mesin, elektrikal atau listrik
              <br />
              f. Pekerjaan pest control <br />
              g. Layanan terintegrasi lainnya <br />
              <br />
              Sistem kami dirancang khusus untuk mengelola data setiap pemilik, penyewa dan tamu, termasuk semua alat, dan perlengkapan yang digunakan. Untuk gedung yang akan disewakan, sistem ini akan mengatur tahapan untuk mengumpulkan
              data dari penyewa, jadwal pembayaran sewa dan periode pengumpulan, sehingga memudahkan manajemen untuk memantau secara efisien dalam waktu yang telah ditentukan, baik bulanan, triwulanan atau tahunan. <br />
              <br />
              Monitoring dalam sistem ini akan berbentuk laporan sesuai dengan time-table yang telah ditetapkan. Laporan tersebut juga akan mencantumkan sinergi antara proses operasional dan proses keuangan, sehingga keseluruhan sistem
              dapat dianalisis dengan mudah. <br />
              <br />
              <strong>
                Prinsip-Prinsip dalam Manajemen Gedung <br />
                <br />
                1. Urusan Umum (GA)
              </strong>
              <br />
              Fungsi dan peran GA dalam suatu organisasi adalah membahas secara detail ruang lingkup pekerjaan dan tanggung jawabnya. Pengelolaan fasilitas kantor yang efisien termasuk ruang kantor, furnitur dan peralatan kantor. Selain itu
              GA juga harus memberikan rasa memiliki kepada karyawan terhadap fasilitas kerja. <br />
              <br />
              <strong> 2. Manajemen Gedung </strong>
              <br />
              Menyiapkan fondasi untuk tata kelola fisik bangunan dengan baik, termasuk pemilihan vendor (supplier) dan mengawasi / mengawasi aspek pekerjaan yang sedang dikerjakan. Selain itu, perlu dibangun sistem komunikasi yang baik
              antar pelanggan (tenant), sehingga dapat memberikan rasa aman dan aman (tenant's relation) Sekilas tentang aspek kepemilikan dan persewaan kantor dari segi hukum tentang persetujuan dan perpajakan. <br />
              <br />
              <strong> 3. Sistem Otomasi Gedung </strong>
              <br />
              Fire Protection System meliputi Fire Alarm System, Fire Sprinkler System, Fire Hydrant System, FM-200 & CO2 Clean Agent Supression System, Portable Fire, dan Extinguisher. Selain itu, Sistem Keamanan berbasis Security Alarm
              System, Access Control System (Finger Print Control), dan Closed Circuit Television System. Sistem Otomasi Gedung termasuk Sistem Manajemen Energi, Sistem Pemantauan, Sistem Manajemen Pemeliharaan, Sistem Manajemen Kebakaran,
              dan Sistem Manajemen Keamanan. <br />
              Sistem Keamanan dibangun di atas Sistem Alarm Keamanan, Sistem Kontrol Akses (Finger Print Control), dan Sistem Televisi Sirkuit Tertutup. Sistem Otomasi Gedung meliputi Sistem Manajemen Energi, Sistem Monitoring, Sistem
              Manajemen Perawatan, Sistem Manajemen Kebakaran, dan Sistem Manajemen Keamanan <br />
              <br />
              <strong> 4. Definisikan </strong>
              <br />
              Kompetensi Pandangan umum tentang kompetensi adalah bagaimana menetapkan tanggung jawab staf pengelola gedung versus staf Urusan Umum.
            </p>
          </div>
        ) : (
          <div class="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p class="text-subtitle">
              Building or premises along with supporting facilities and infrastructure are assets that need to be maintained and preserved to generate benefits and remain usable for the long term. To achieve this goal, proper and
              professional property management is essential.
            </p>

            <br />

            <p class="text-subtitle">The Property Management services we provide include:</p>

            <ol class="list-inside text-subtitle">
              <li>a. Landscaping/gardening works</li>
              <li>b. Building, premises, and area maintenance</li>
              <li>c. Cleaning services</li>
              <li>d. Maintenance of mechanical , machinery, electrical, and electronic equipment and tools</li>
              <li>e. Supply of mechanical, machinery, electrical, or electronic spare parts</li>
              <li>f. Pest control services</li>
              <li>g. Other integrated services</li>
            </ol>

            <br />
            <p class="text-subtitle">
              Our system is specially designed to manage data related to each owner, tenant, and guest, including all equipment and tools used. For buildings intended for rent, the system will organize stages to collect data from tenants,
              rental payment schedules, and collection periods, facilitating efficient monitoring within specified time frames, whether monthly, quarterly, or annually.
            </p>

            <br />
            <p class="text-subtitle">
              The monitoring in this system will be presented in reports according to the established time-table. These reports will also include the synergy between operational and financial processes, making it easy to analyze the entire
              system.
            </p>

            <br />
            <p class="text-subtitle">
              <strong>
                {' '}
                Principles in Building Management: <br />{' '}
              </strong>
              <br />
              <strong>
                {' '}
                1. General Affairs (GA) <br />{' '}
              </strong>
              The function and role of GA in an organization involve detailed discussions of its scope of work and responsibilities. Efficient management of office facilities includes office spaces, furniture, and office equipment.
              Additionally, GA should instill a sense of ownership in employees regarding the workplace facilities.
              <br />
              <br />
              <strong>
                2. Building Management <br />{' '}
              </strong>
              Laying the foundation for proper physical building governance, including the selection of vendors/suppliers and overseeing ongoing work aspects. Furthermore, it is essential to establish effective communication systems among
              customers (tenants) to provide a sense of safety and security (tenant's relation). An overview of ownership and office leasing from a legal perspective regarding agreements and taxation is also necessary.
              <br />
              <br />
              <strong>
                3. Building Automation System <br />{' '}
              </strong>
              Fire Protection Systems encompass Fire Alarm Systems, Fire Sprinkler Systems, Fire Hydrant Systems, FM-200 & CO2 Clean Agent Suppression Systems, Portable Fire Extinguishers, and Fire Alarm Systems. Additionally, Security
              Systems are based on Security Alarm Systems, Access Control Systems (Finger Print Control), and Closed Circuit Television Systems. Building Automation Systems include Energy Management Systems, Monitoring Systems, Maintenance
              Management Systems, Fire Management Systems, and Security Management Systems.
              <br />
              <br />
              <strong> 4. Define Competence </strong> <br />
              An overview of competence is how to define the responsibilities of building management staff versus General Affairs staff.
            </p>
          </div>
        )}
      </section>
    </div>
  );
}
