import { useState } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import data_awards from '../../../data/awards.json';
import data_tabs from '../../../data/awards_tab.json';

export default function AwardSection({ lang_code }) {
  const [activeTab, setActiveTab] = useState(0);

  const tabs = lang_code === 'id' ? data_tabs.awards_tab_id : data_tabs.awards_tab_en;

  return (
    <div className="award-component">
      <div className="wrapper-awards mt-20 w-10/12 mx-auto">
        <div className="awards">
          {/* Title Awards */}
          <div className="title relative flex flex-col items-center text-center">
            <img src="/images/images/security-icon.png" className="absolute -top-10" alt="Security Icon" />
            <h1 className="text-primary font-bold leading-[150%] text-[28px] md:text-[40px] text-center w-full md:w-1/2">{lang_code === 'id' ? 'Berkomitmen Untuk Selalu Menjadi Yang Terbaik' : 'Top Quality Services and Dedication'}</h1>
          </div>

          {/* Tabs Filter */}
          <div className="flex flex-row p-2 mx-auto my-10 justify-center items-center max-w-min rounded-10" style={{ background: 'rgba(35, 54, 114, 0.2)' }}>
            {tabs.map((tab, index) => (
              <div key={index} onClick={() => setActiveTab(index)} className={`cursor-pointer px-4 py-2 flex items-center justify-center ${activeTab === index ? 'award-filter-active' : 'award-filter'}`}>
                <h1>{tab.title}</h1>
              </div>
            ))}
          </div>

          {/* Desktop View */}
          <div className="hidden md:block">
            {activeTab === 0 && (
              <div className="list-awards flex flex-row gap-8 mt-10">
                <Swiper slidesPerView={5} spaceBetween={30} navigation loop modules={[Navigation, Pagination]} className="mySwiper">
                  {data_awards.awards.map((item, index) => (
                    <SwiperSlide key={index}>
                      <div className="item-awards p-4">
                        <img src={item.image} alt={item.name} loading="lazy" className="w-full h-full object-cover hover:scale-125 duration-700" />
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
              </div>
            )}

            {activeTab === 1 && (
              <div className="list-awards flex flex-row gap-8 mt-10">
                <Swiper slidesPerView={5} spaceBetween={30} navigation loop modules={[Navigation, Pagination]} className="mySwiper">
                  {data_awards.iso.map((item, index) => (
                    <SwiperSlide key={index}>
                      <div className="item-awards p-4">
                        <img src={item.image} alt={item.name} loading="lazy" className="w-full h-full object-cover hover:scale-125 duration-700" />
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
              </div>
            )}
          </div>

          {/* Mobile View */}
          <div className="block md:hidden">
            {activeTab === 0 && (
              <div className="list-awards flex flex-row gap-8 mt-10">
                <Swiper slidesPerView={1} spaceBetween={20} navigation loop modules={[Navigation, Pagination]} className="mySwiper">
                  {data_awards.awards.map((item, index) => (
                    <SwiperSlide key={index}>
                      <div className="item-awards p-4">
                        <img src={item.image} alt={item.name} />
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
              </div>
            )}

            {activeTab === 1 && (
              <Swiper slidesPerView={1} spaceBetween={20} navigation loop modules={[Navigation, Pagination]} className="mySwiper">
                {data_awards.iso.map((item, index) => (
                  <SwiperSlide key={index}>
                    <div className="item-awards p-4">
                      <img src={item.image} alt={item.name} />
                    </div>
                  </SwiperSlide>
                ))}
              </Swiper>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
