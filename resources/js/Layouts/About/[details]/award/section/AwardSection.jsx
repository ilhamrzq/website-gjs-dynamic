import { useState } from 'react';
import { Navigation, Pagination } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import data_awards from '../../../../../data/awards.json';
import BackNavigation from '../../../../../components/BackNavigation';
import { usePage } from '@inertiajs/react';

export default function AwardSection({ lang_code }) {
  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';

  const [selectedAward, setSelectedAward] = useState(null);
  const [modal_penghargaan, setModalPenghargaan] = useState(false);
  const [activeTab, setActiveTab] = useState(0);

  const dataPenghargaan = data_awards.awards;
  const dataIso = data_awards.iso;

  const tabs =
    lang_code === 'id'
      ? [
          {
            title: 'Penghargaan',
          },
          {
            title: 'ISO ',
          },
        ]
      : [
          {
            title: 'Awards',
          },
          {
            title: 'ISO ',
          },
        ];

  const modules = [Navigation, Pagination];

  const handleSetActiveTab = (index) => {
    setActiveTab(index);
  };

  const show_modal = (award) => {
    setSelectedAward(award);
    setModalPenghargaan(!modal_penghargaan);
  };

  const close_modal = () => {
    setModalPenghargaan(false);
  };

  return (
    <div className="content-about">
      {/* Navigation */}
      <BackNavigation backTo={lang_code === 'id' ? 'Tentang' : 'About'} hrefTo={backPath} />

      {/* End Navigation */}

      {/* Content Awards  */}
      <section>
        <div>
          <div className="text-center flex flex-row justify-center">
            <img loading="lazy" src="/images/logo/award-certification.png" className="absolute" />
          </div>
          <h1 className="color-neutra-black-100 font-bold mt-16 fs-28 md:text-[52px] text-center">{lang_code === 'id' ? 'Sertifikat' : 'Certificates'}</h1>
          {/* Tabs Filter  */}
          <div className="flex flow-row p-2 mx-auto my-10 justify-center items-center max-w-min rounded-10" style={{ background: 'rgba(35, 54, 114, 0.2)' }}>
            {tabs.map((tab, index) => (
              <div key={index} className="cursor-pointer" onClick={() => handleSetActiveTab(index)}>
                {activeTab === index ? (
                  <div className="award-filter-active">
                    <h1>{tab.title}</h1>
                  </div>
                ) : (
                  <div className="award-filter">
                    <h1>{tab.title}</h1>
                  </div>
                )}
              </div>
            ))}
          </div>
          {/* End Tabs Filter */}

          {/* List Awards */}
          {/* Desktop view */}
          <div className="hidden md:block">
            {activeTab === 0 && (
              <div className="list-awards flex flex-row gap-8 mt-10 w-11/12 mx-auto">
                <Swiper slidesPerView={5} spaceBetween={30} loop={true} navigation={true} modules={modules} className="mySwiper">
                  {dataPenghargaan.map((itemPenghargaan) => (
                    <SwiperSlide key={itemPenghargaan.id}>
                      <div className="item-awards cursor-pointer p-4" onClick={() => show_modal(itemPenghargaan)}>
                        <img loading="lazy" src={itemPenghargaan.image} />
                        <p className="text-center mt-2">{lang_code === 'id' ? itemPenghargaan.name_id : itemPenghargaan.name}</p>
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
              </div>
            )}
            {activeTab === 1 && (
              <div className="list-awards flex flex-row gap-8 mt-10 w-11/12 mx-auto">
                <Swiper slidesPerView={5} spaceBetween={30} loop={true} navigation={true} modules={modules} className="mySwiper">
                  {dataIso.map((itemIso) => (
                    <SwiperSlide key={itemIso.id}>
                      <div className="item-awards p-4 cursor-pointer" onClick={() => show_modal(itemIso)}>
                        <img loading="lazy" src={itemIso.image} />
                        <p className="text-center mt-2">{lang_code === 'id' ? itemIso.name_id : itemIso.name}</p>
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
              </div>
            )}
          </div>

          {/* Show Modal Desktop */}
          {selectedAward !== null && (
            <div className={`fixed top-0 left-0 right-0 z-50 w-[900px] mx-auto p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal mt-[5%] ${modal_penghargaan ? 'block' : 'hidden'}`} aria-hidden="true">
              <div className="relative w-full h-full md:h-auto">
                {/* Modal content */}
                <div className="relative bg-white rounded-lg shadow">
                  <div className="flex items-start justify-between p-4 border-b rounded-t">
                    {/* Modal header */}
                    <h3 className="text-base font-bold leading-[160%] color-neutral-black-100">{lang_code === 'id' ? selectedAward.name_id : selectedAward.name}</h3>
                    <button
                      onClick={close_modal}
                      type="button"
                      className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                      <svg aria-hidden="true" className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fillRule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clipRule="evenodd"
                        ></path>
                      </svg>
                      <span className="sr-only">Close modal</span>
                    </button>
                  </div>
                  {/* Modal body */}
                  <div className="p-6 space-y-6">
                    {/* Show the selected award */}
                    <img loading="lazy" src={selectedAward.image} />
                  </div>
                  {/* Modal footer */}
                </div>
              </div>
            </div>
          )}
          {/* End Show Modal Desktop */}
          {/* End Desktop View */}

          {/* Mobile view */}
          <div className="block md:hidden w-10/12 mx-auto">
            {activeTab === 0 && (
              <div className="list-awards flex flex-row gap-8 mt-10">
                <Swiper slidesPerView={1} spaceBetween={30} loop={true} navigation={true} modules={modules} className="mySwiper">
                  {dataPenghargaan.map((itemPenghargaan) => (
                    <SwiperSlide key={itemPenghargaan.id}>
                      <div className="item-awards p-4">
                        <img loading="lazy" src={itemPenghargaan.image} />
                        <p className="text-center mt-2">{lang_code === 'id' ? itemPenghargaan.name_id : itemPenghargaan.name}</p>
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
              </div>
            )}
            {activeTab === 1 && (
              <div className="list-awards flex flex-row gap-8 mt-10">
                <Swiper slidesPerView={1} spaceBetween={30} loop={true} navigation={true} modules={modules} className="mySwiper">
                  {dataIso.map((itemIso) => (
                    <SwiperSlide key={itemIso.id}>
                      <div className="item-awards p-4">
                        <img loading="lazy" src={itemIso.image} />
                        <p className="text-center mt-2">{lang_code === 'id' ? itemIso.name_id : itemIso.name}</p>
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
              </div>
            )}
          </div>
          {/* End Mobile View */}
          {/* End Mobile View */}
        </div>
      </section>
      {/* End Awards   */}
    </div>
  );
}
