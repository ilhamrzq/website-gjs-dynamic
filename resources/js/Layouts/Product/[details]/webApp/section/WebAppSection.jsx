import { usePage } from '@inertiajs/react';
import Icon from '../../../../../components/Icon';
import ListUniqueSellingPoint from '../../../../../components/ListUniqueSellingPoint';
import Maps from '../../../../../components/Maps';
import '../webApp.css';
import BackNavigation from '../../../../../components/BackNavigation';

export default function WebAppSection({ lang_code }) {
  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';
  
  return (
    <div className="content-newspage">
      <BackNavigation backTo={lang_code === 'id' ? 'Produk' : 'Product Detail'} hrefTo={backPath} />

      <section className="section-1">
        {lang_code === 'id' ? (
          <div className="w-full md:w-8/12 mx-auto flex flex-col items-center pb-14">
            <img src="/images/products/product-gjs-client.png" alt="gjs-client" className="w-full md:rounded-2xl" />
            <div className="my-10">
              <h1 className="color-neutral-black-100 fs-28 font-bold text-center">GJS Client Portal</h1>
              <p className="text-subtitle text-center">
                Portal Klien GJS adalah alat pelaporan andal yang memberikan pembaruan waktu nyata pada semua aspek dari data Patroli Keamanan GJS. Dengan Portal Klien GJS, Anda dapat dengan mudah melihat laporan tentang patroli, kehadiran,
                peringatan, dan permintaan SOS. Portal klien kami memudahkan pengelolaan keamanan bangunan Anda dari perangkat apa pun dengan akses internet.
              </p>
            </div>
          </div>
        ) : (
          <div className="w-full md:w-8/12 mx-auto flex flex-col items-center pb-14">
            <img src="/images/products/product-gjs-client.png" className="w-full md:rounded-2xl" />
            <div className="my-10">
              <h1 className="color-neutral-black-100 fs-28 font-bold text-center">GJS Client Portal</h1>
              <p className="text-subtitle text-center">
                The GJS Client Portal is a reliable reporting tool that provides real-time updates on all aspects of GJS Security Patrol data. With the GJS Client Portal, you can easily view reports on patrols, attendance, alerts, and SOS
                requests. Our client portal facilitates the management of your building's security from any device with internet access.
              </p>
            </div>
          </div>
        )}
      </section>

      <section className="section-2">
        {lang_code === 'id' ? (
          <div className="py-150 flex flex-col items-center text-center w-11/12 mx-auto">
            <h1 className="color-neutral-black-100 fs-28 md:fs-40 font-bold">
              Memantau Aktivitas Keamanan Secara Lancar <br />
              dengan Aplikasi Mobile GJS
            </h1>
            <p className="text-subtitle">Aplikasi GJS Mobile Terintegrasi dengan Website GJS Client.</p>
            <a href="https://gjs.mncland.com/" target="_blank" className="bg-primary-gradient-button rounded-md shadow2xl my-10 color-neutral-white-100 text-center font-medium text-base px-6 py-3">
              Lihat GJS Client
            </a>
            <img src="/images/products/product-integrated.png" alt="product-integrated" className="rounded-2xl" />
          </div>
        ) : (
          <div className="py-150 flex flex-col items-center text-center w-11/12 mx-auto">
            <h1 className="color-neutral-black-100 fs-24 md:fs-40 font-bold">
              Monitor Security Activity <br />
              Seamlessly with GJS Products
            </h1>
            <p className="text-subtitle">GJS Mobile Application is Integrated with GJS Client Website.</p>
            <a href="https://gjs.mncland.com/" target="_blank" className="bg-primary-gradient-button rounded-md shadow2xl my-10 color-neutral-white-100 text-center font-medium text-base px-6 py-3">
              View GJS Client
            </a>
            <img src="/images/products/product-integrated.png" className="rounded-2xl" />
          </div>
        )}
      </section>

      <section className="section-3">
        {lang_code === 'id' ? (
          <div className="flex flex-col items-center">
            <h1 className="color-neutral-black-100 fs-28 md:fs-40 font-bold text-center">
              Dapatkan Semua Yang <br />
              Anda Butuhkan untuk Keamanan
            </h1>
            <div className="list-icon grid grid-cols-2 md:grid-flow-col my-10 gap-8 mx-auto flex-wrap justify-center">
              <Icon materialIcon="security" textIcon="Patroli" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="touch_app" textIcon="Kehadiran" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="date_range" textIcon="Jadwal" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="notifications_active" textIcon="Alert & SOS" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="description" textIcon="Laporan" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="group" textIcon="Delegasi" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
            </div>
          </div>
        ) : (
          <div className="flex flex-col items-center">
            <h1 className="color-neutral-black-100 fs-28 md:fs-40 font-bold text-center w-full md:w-1/2">Get Everything What Company Need to Fill The Security Activities</h1>
            <div className="list-icon grid grid-cols-2 md:grid-flow-col my-10 gap-8 mx-auto flex-wrap justify-center">
              <Icon materialIcon="security" textIcon="Patrol" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="touch_app" textIcon="Absence" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="date_range" textIcon="Schedule" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="notifications_active" textIcon="Alert & SOS" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="description" textIcon="Report" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="group" textIcon="Delegate" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
            </div>
          </div>
        )}
      </section>

      <section className="section-4 w-11/12 mx-auto">
        {lang_code === 'id' ? (
          <ListUniqueSellingPoint
            imgSellingPoint1="/images/products/product-gjs-client-feature-1.png"
            titleSellingPoint1="Pantau Aktivitas Patroli Keamanan Anda"
            descSellingPoint1="Portal Klien GJS memungkinkan Anda memantau aktivitas patroli dalam satu dasbor yang menampilkan informasi lengkap."
            imgSellingPoint2="/images/products/product-gjs-client-feature-2.png"
            titleSellingPoint2="Dapatkan Pemberitahuan Saat Terjadi Insiden"
            descSellingPoint2="Website GJS Client memiliki fitur notifikasi realtime, sehingga kejadian darurat di lapangan dapat ditangani dengan cepat.."
            imgSellingPoint3="/images/products/product-gjs-client-feature-3.png"
            titleSellingPoint3="Hasilkan Laporan dengan Mudah Secara Otomatis"
            descSellingPoint3="Sesuaikan tanggal laporan yang Anda inginkan dan hasilkan laporan PDF dengan informasi lengkap dan desain yang cantik."
          />
        ) : (
          <ListUniqueSellingPoint
            imgSellingPoint1="/images/products/product-gjs-client-feature-1.png"
            titleSellingPoint1="Monitor Your Security Patrol Activities"
            descSellingPoint1="GJS Client Website allows you to monitor patrol activities in a single dashboard that displays complete information."
            imgSellingPoint2="/images/products/product-gjs-client-feature-2.png"
            titleSellingPoint2="Get Notified When an Incident Occurs"
            descSellingPoint2="GJS Client Website has a real-time notification feature, so that emergency events in the field can be handled quickly."
            imgSellingPoint3="/images/products/product-gjs-client-feature-3.png"
            titleSellingPoint3="Generate Reports Easily Automatically"
            descSellingPoint3="Adjust the date of the report you want and generate a PDF report with complete information and a beautiful design."
          />
        )}
      </section>

      <section className="section-5 my-[150px] w-11/12 mx-auto">
        <Maps contentMaps={lang_code === 'id' ? 'Dapatkan Aplikasi untuk mengamankan area anda' : 'Get the GJS App to Secure Your Area'} contactButton={lang_code === 'id' ? 'Kontak Kami' : 'Contact Us'} />
      </section>
    </div>
  );
}
