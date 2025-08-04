import { useState } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export default function ProductSection({ lang_code }) {
  const [tab, setTab] = useState('patrol');

  const leftItems =
    lang_code === 'id'
      ? [
          { title: 'Patroli', icon: 'security', key: 'patrol' },
          { title: 'Absensi', icon: 'touch_app', key: 'absence' },
          { title: 'Jadwal', icon: 'date_range', key: 'schedule' },
        ]
      : [
          { title: 'Patrol', icon: 'security', key: 'patrol' },
          { title: 'Attendance', icon: 'touch_app', key: 'absence' },
          { title: 'Schedule', icon: 'date_range', key: 'schedule' },
        ];

  const rightItems =
    lang_code === 'id'
      ? [
          { title: 'Peringatan', icon: 'notifications_active', key: 'alert' },
          { title: 'SOS', icon: 'info', key: 'sos' },
          { title: 'Others', icon: 'group', key: 'delegate' },
        ]
      : [
          { title: 'Alert', icon: 'notifications_active', key: 'alert' },
          { title: 'SOS', icon: 'info', key: 'sos' },
          { title: 'Others', icon: 'group', key: 'delegate' },
        ];

  return (
    <div className="product-component">
      <div className="wrapper-products my-40 h-full px-3 fy-72">
        <div className="products w-full">
          {/* Title */}
          <div className="title-products text-center flex flex-col gap-2">
            <h1 className="text-white font-semibold text-[28px] leading-[150%] md:text-[40px] md:leading-[140%]">
              {lang_code === 'id' ? (
                <>
                  Monitor Patroli Keamanan <br />
                  Di Mana Saja & Kapan Saja
                </>
              ) : (
                'Monitor Security Patrol Anywhere & Anytime'
              )}
            </h1>
            <p className="color-neutral-white-60 text-base leading-[160%] w-8/12 mx-auto">
              {lang_code === 'id' ? 'GJS Mobile Application yang terintegrasi dengan GJS Client Website' : 'GJS Security Patrol is Integrated with GJS Client Portal.'}
            </p>
          </div>

          {/* QR & Playstore */}
          <div className="badge-products">
            {/* Desktop */}
            <div className="flex-col md:flex-row gap-4 justify-center my-8 mx-auto hidden md:flex">
              <a target="_blank" href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app">
                <img src="/images/home/qrcode.png" style={{ imageRendering: 'pixelated' }} alt="qrcode" />
              </a>
              <a href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app" target="_blank">
                <img src="/images/images/google_play.png" alt="google_play" />
              </a>
              <a href="https://api.whatsapp.com/send?phone=081513911456" target="_blank" className="button-transparant text-center">
                Demo GJS Client
              </a>
            </div>

            {/* Mobile */}
            <div className="flex flex-col md:flex-row gap-4 justify-center my-8 mx-auto md:hidden">
              <div className="text-center">
                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.mncland.gjspatrol.app">
                  <img src="/images/images/google_play.png" className="w-[150px] object-contain inline" alt="google_play" />
                </a>
              </div>
              <a href="https://api.whatsapp.com/send?phone=081513911456" target="_blank" className="button-transparant w-[150px] mx-auto text-center text-[12px]">
                Demo GJS Client
              </a>
            </div>
          </div>

          {/* Features + Slideshow */}
          <div className="info-products hidden md:block h-full w-11/12 mx-auto">
            <div className="grid grid-cols-4">
              {/* Left Buttons */}
              <div className="col-auto flex flex-col justify-between">
                {leftItems.map((item) => (
                  <div key={item.key} className="features flex flex-row gap-4 cursor-pointer" onMouseOver={() => setTab(item.key)}>
                    <div className="features-icon">
                      <div className="features-icon__rounded">
                        <span className="material-symbols-outlined text-[24px]">{item.icon}</span>
                      </div>
                    </div>
                    <div className="features-title flex items-center">
                      <h1 className="text-white text-[28px] font-semibold">{item.title}</h1>
                      <span className="material-symbols-outlined text-[24px] ml-4 text-neutral-white-100">chevron_right</span>
                    </div>
                  </div>
                ))}
              </div>

              {/* Slideshow */}
              <div className="col-span-2">
                <div className="wrapper-products__slideshow">
                  {tab === 'patrol' && <img src="/images/home/banner/feature-patrol.webp" className="md:object-cover w-full" alt="feature-patrol" />}
                  {tab === 'absence' && <img src="/images/home/banner/feature-absence.webp" className="md:object-cover w-full" alt="feature-absence" />}
                  {tab === 'schedule' && <img src="/images/home/banner/feature-schedule.webp" className="md:object-cover w-full" alt="feature-schedule" />}
                  {tab === 'alert' && <img src="/images/home/banner/feature-alert.webp" className="md:object-cover w-full" alt="feature-alert" />}
                  {tab === 'sos' && <img src="/images/home/banner/feature-sos.webp" className="md:object-cover w-full" alt="feature-sos" />}
                  {tab === 'delegate' && <img src="/images/home/banner/feature-delegation.webp" className="md:object-cover w-full" alt="feature-delegation" />}
                </div>
              </div>

              {/* Right Buttons */}
              <div className="col-auto flex flex-col justify-between">
                {rightItems.map((item) => (
                  <div key={item.key} className="features flex flex-row gap-4 cursor-pointer justify-end" onMouseOver={() => setTab(item.key)}>
                    <div className="features-title flex items-center">
                      <span className="material-symbols-outlined text-[24px] mr-4 text-neutral-white-100">chevron_left</span>
                      <h1 className="text-white text-[28px] font-semibold">{item.title}</h1>
                    </div>
                    <div className="features-icon">
                      <div className="features-icon__rounded">
                        <span className="material-symbols-outlined text-[24px]">{item.icon}</span>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Mobile Swiper */}
          <div className="block md:hidden h-full w-11/12 mx-auto my-12">
            <Swiper slidesPerView={1} spaceBetween={30} loop navigation pagination={{ clickable: true }} modules={[Navigation, Pagination]} className="mySwiper">
              {['feature-patrol', 'feature-absence', 'feature-schedule', 'feature-alert', 'feature-sos', 'feature-delegation'].map((name, idx) => (
                <SwiperSlide key={idx}>
                  <div className="item-awards p-4 wrapper-products__slideshow__mobile">
                    <img alt={name} src={`/images/home/banner/${name}.webp`} className="md:object-cover w-full" />
                  </div>
                </SwiperSlide>
              ))}
            </Swiper>
          </div>
        </div>
      </div>
    </div>
  );
}
