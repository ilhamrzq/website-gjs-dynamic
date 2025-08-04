import data from '../../../data/about.json';
import { Navigation, Pagination } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Link } from '@inertiajs/react';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export default function AboutSection({ lang_code }) {
  const dataTop = lang_code === 'id' ? data.about_top_slideshow_id : data.about_top_slideshow_en;
  const dataBot = lang_code === 'id' ? data.about_bot_slideshow_id : data.about_bot_slideshow_en;
  const modules = [Navigation, Pagination];

  const readMoreAbout = lang_code === 'id' ? { to: '/id/tentang', label: 'Lebih Lanjut' } : { to: '/en/about', label: 'View More' };

  return (
    <section>
      <div className="about-component hidden md:block my-[72px]">
        <div className="wrapper-about flex flex-col items-center text-center gap-2 justify-center relative h-[400px]">
          <img loading="lazy" src="/images/images/about-us.webp" alt="image-about-us" className="absolute top-[-15px]" />
          <h1 className="color-neutral-black-100 font-bold leading-[120%] text-[40px] text-center">{lang_code === 'id' ? 'Tentang Kami' : 'About Us'}</h1>
          <p className="font-normal w-8/12 mx-auto text-[16px] leading-[1.6] text-center color-neutral-black-60">
            {lang_code === 'id'
              ? 'PT Global Jasa Sejahtera (GJS) merupakan anak perusahaan dari MNC Tourism Indonesia dan MNC Group yang menyediakan berbagai layanan pengelolaan properti meliputi Manajemen Properti, Jasa Pengamanan & Konsultan Keamanan, Pusat Pelatihan, Supervisi & Desain, dan Manajemen Parkir. Kami memastikan Anda mendapatkan pelayanan terbaik untuk peningkatan investasi yang berkelanjutan dan mengantisipasi tantangan bisnis di masa mendatang.'
              : 'Global Jasa Sejahtera. In the year 2009, the MNC group expanded its business to include employment services to provide building management services through the establishment of its subsidiary, PT Global Jasa Sejahtera. Services by GJS is to complement our main business objectives in Property Management. Services offered by GJS covers and includes Property Management, Security Services, office assistants office-boy, receptionists, messengers and etc.'}
          </p>
          {/* CTA Read More */}
          <Link to={readMoreAbout.to} className="button-primary text-white text-base mt-9 inline-flex items-center gap-2">
            {readMoreAbout.label}
            <span className="material-symbols-outlined text-base">arrow_forward</span>
          </Link>
        </div>

        <div className="slideshow-bottom">
          {/* Top Slideshow */}
          <Swiper slidesPerView={2.2} spaceBetween={30} modules={modules} loop={true} className="mySwiper my-6">
            {dataTop.map((item) => (
              <SwiperSlide key={item.id}>
                <div className="h-[272px] 2xl:h-[500px] relative">
                  <img src={item.image} alt={item.name} loading="lazy" className="w-full h-full rounded-xl object-cover" />
                  <div className="absolute bottom-0 left-0 m-6 px-3 py-[2px] flex items-center gap-[13px] rounded-4 bg-neutral-black-60 backdrop-3px color-neutral-white-100">
                    <span className="material-symbols-outlined">{item.icon}</span>
                    <p>{item.name}</p>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>

          {/* Bottom Slideshow */}
          <Swiper dir="rtl" slidesPerView={2.2} spaceBetween={30} loop={true} modules={modules} className="mySwiper my-6">
            {dataBot.map((item) => (
              <SwiperSlide key={item.id}>
                <div className="h-[272px] 2xl:h-[500px] relative">
                  <img src={item.image} alt={item.name} loading="lazy" className="w-full h-full rounded-xl object-cover" />
                  <div className="absolute bottom-0 left-0 m-6 px-3 py-[2px] flex items-center gap-[13px] rounded-4 bg-neutral-black-60 backdrop-3px color-neutral-white-100">
                    <span className="material-symbols-outlined">{item.icon}</span>
                    <p>{item.name}</p>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>
      </div>

      {/* Mobile View */}
      <div className="about-component block md:hidden my-[72px]">
        <div className="wrapper-about flex flex-col items-center text-center justify-center relative h-[400px] px-4 mt-[120px]">
          <img src="/images/images/about-us.webp" alt="image-about-us" loading="lazy" className="absolute top-[-100px]" />
          <h1 className="color-neutral-black-100 font-bold text-[28px] mb-2 leading-[120%] text-center">{lang_code === 'id' ? 'Tentang Kami' : 'About Us'}</h1>
          <p className="font-normal text-[16px] leading-[1.6] text-center color-neutral-black-60 mt-2">
            {lang_code === 'id'
              ? 'PT Global Jasa Sejahtera (GJS) merupakan anak perusahaan dari MNC Tourism Indonesia dan MNC Group yang menyediakan berbagai layanan pengelolaan properti meliputi Manajemen Properti, Jasa Pengamanan & Konsultan Keamanan, Pusat Pelatihan, Supervisi & Desain, dan Manajemen Parkir.'
              : 'Global Jasa Sejahtera. In the year 2009, the MNC group expanded its business to include employment services; to provide building management services through the establishment of its subsidiary, PT Global Jasa Sejahtera.'}
          </p>
          {/* Read More Button */}
          <Link to={readMoreAbout.to} className="button-primary text-white text-base mt-9 inline-flex items-center gap-2">
            {readMoreAbout.label}
            <span className="material-symbols-outlined text-base">arrow_forward</span>
          </Link>
        </div>
        <div className="slideshow-bottom my-10">
          <Swiper slidesPerView={1.3} spaceBetween={10} modules={modules} loop={true} className="mySwiper my-6">
            {dataTop.map((item) => (
              <SwiperSlide key={item.id}>
                <div className="h-[272px] relative">
                  <img src={item.image} alt={item.name} loading="lazy" className="w-full h-full rounded-xl object-cover" />
                  <div className="absolute bottom-0 left-0 m-6 px-3 py-[2px] flex gap-[13px] rounded-4 bg-neutral-black-60 backdrop-3px color-neutral-white-100">
                    <span className="material-symbols-outlined">{item.icon}</span>
                    <p>{item.name}</p>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
          <Swiper dir="rtl" slidesPerView={1.3} spaceBetween={10} loop={true} modules={modules} className="mySwiper my-6">
            {dataBot.map((item) => (
              <SwiperSlide key={item.id}>
                <div className="h-[272px] relative">
                  <img src={item.image} alt={item.name} loading="lazy" className="w-full h-full rounded-xl object-cover" />
                  <div className="absolute bottom-0 left-0 m-6 px-3 py-[2px] flex gap-[13px] rounded-4 bg-neutral-black-60 backdrop-3px color-neutral-white-100">
                    <span className="material-symbols-outlined">{item.icon}</span>
                    <p>{item.name}</p>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>
      </div>
    </section>
  );
}
