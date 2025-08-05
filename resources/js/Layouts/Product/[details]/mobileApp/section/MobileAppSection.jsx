import { usePage } from '@inertiajs/react';
import BackNavigation from '../../../../../components/BackNavigation';
import Icon from '../../../../../components/Icon';
import ListUniqueSellingPoint from '../../../../../components/ListUniqueSellingPoint';
import Maps from '../../../../../components/Maps';
import '../mobileApp.css';

export default function MobileAppSection({ lang_code }) {
  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';

  return (
    <div className="content-newspage mt-16">
      <BackNavigation backTo={lang_code === 'id' ? 'Produk' : 'Product Detail'} hrefTo={backPath} />

      <section className="section-1">
        <div className="w-full md:w-8/12 mx-auto flex flex-col items-center pb-14">
          <img src="/images/products/product-gjs-mobile.png" className="w-full md:rounded-2xl" />
          {lang_code === 'id' ? (
            <div className="my-10">
              <h1 className="color-neutral-black-100 fs-28 font-bold text-center">Mobile Aplikasi GJS</h1>
              <p className="text-subtitle text-center">Aplikasi GJS Mobile adalah aplikasi patroli yang ditujukan untuk Security yang berpatroli di sekitar.</p>
            </div>
          ) : (
            <div className="my-10">
              <h1 className="color-neutral-black-100 fs-28 font-bold text-center">GJS Mobile Application</h1>
              <p className="text-subtitle text-center">GJS Mobile Application is a patrol application intended for Security who patrols around.</p>
            </div>
          )}
          <div className="flex flex-row gap-3">
            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app">
              <img src="/images/images/google_play.png" className="w-full object-cover" alt="google-play" />
            </a>
            <a href="#">
              <img src="/images/images/app-store-comming-soon.png" className="w-full object-cover" alt="app-store" />
            </a>
          </div>
        </div>
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
              View GJS Client
            </a>
            <img src="/images/products/product-integrated.png" className="rounded-2xl" />
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
          <div class="flex flex-col items-center">
            <h1 class="color-neutral-black-100 fs-28 md:fs-40 font-bold text-center w-full md:w-1/2">Dapatkan Semua Yang Dibutuhkan Perusahaan Anda Untuk Mengisi Jadwal Kegiatan Keamanan</h1>
            <div class="list-icon grid grid-cols-2 md:grid-flow-col my-10 gap-8 mx-auto flex-wrap justify-center">
              <Icon materialIcon="security" textIcon="Patroli" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="touch_app" textIcon="Kehadiran" textActive="true" classMaterial="material-symbols-outlined color-primary-blue-100" />
              <Icon materialIcon="date_range" textIcon="Jadwal" classMaterial="material-symbols-outlined color-primary-blue-100" textActive="true" />
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
              <Icon materialIcon="date_range" textIcon="Schedule" classMaterial="material-symbols-outlined color-primary-blue-100" textActive="true" />
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
            imgSellingPoint1="/images/products/product-gjs-mobile-feature-1.png"
            titleSellingPoint1="Pantau Aktivitas Patroli Keamanan Anda"
            descSellingPoint1="Aplikasi GJS Mobile dapat melihat aktivitas yang dilakukan oleh Security, sehingga Security tidak perlu melapor secara langsung dan Security lainnya juga dapat melihat aktivitas Security yang sedang berpatroli."
            imgSellingPoint2="/images/products/product-gjs-mobile-feature-2.png"
            titleSellingPoint2="Lakukan Absensi dengan Mudah di Ponsel Anda"
            descSellingPoint2="Security dapat melakukan absensi sendiri dengan menggunakan GPS dan pengecekan selfie. Tenang saja, aplikasi ini sudah terbukti dan keamanannya tidak akan bisa di bobol."
            imgSellingPoint3="/images/products/product-gjs-mobile-feature-3.png"
            titleSellingPoint3="Dapatkan Pemberitahuan Saat Terjadi Insiden"
            descSellingPoint3="Aplikasi GJS Mobile memiliki fitur notifikasi realtime, sehingga kejadian darurat di lapangan dapat ditangani dengan cepat."
          />
        ) : (
          <ListUniqueSellingPoint
            imgSellingPoint1="/images/products/product-gjs-mobile-feature-1.png"
            titleSellingPoint1="Monitor Your Security Patrol Activities"
            descSellingPoint1="GJS Mobile Application can see activities carried out by Security, so that Security does not need to report directly and other Security can also see Security activities that are currently on patrol."
            imgSellingPoint2="/images/products/product-gjs-mobile-feature-2.png"
            titleSellingPoint2="Do Attendance Easily on The Phone"
            descSellingPoint2="Security can do its own attendance by using GPS and selfie checks. Take it easy, this application has been proven and security will not be able to cheat."
            imgSellingPoint3="/images/products/product-gjs-mobile-feature-3.png"
            titleSellingPoint3="Get Notified When an Incident Occurs"
            descSellingPoint3="GJS Mobile Application has a real-time notification feature, so that emergency events in the field can be handled quickly."
          />
        )}
      </section>

      <section className="section-5 my-[150px] w-11/12 mx-auto">
        <Maps contentMaps={lang_code === 'id' ? 'Dapatkan Aplikasi GJS untuk Mengamankan Area Anda' : 'Get the GJS App to Secure Your Area'} contactButton={lang_code === 'id' ? 'Hubungi Kami' : 'Contact Us'} />
      </section>
    </div>
  );
}
