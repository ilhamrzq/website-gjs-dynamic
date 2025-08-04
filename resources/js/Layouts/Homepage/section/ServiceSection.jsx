import { useState } from 'react';
import Icon from '../../../components/Icon';
import data from '../../../data/services.json';

export default function ServiceSection({ lang_code }) {
  const tabs = lang_code === 'id' ? data.services_id : data.services_en;
  const [activeTab, setActiveTab] = useState(0);
  const [collapseService, setCollapseService] = useState({});

  // Toggle collapse for mobile accordion
  const toggleCollapse = (id) => {
    setCollapseService((prev) => ({
      ...prev,
      [id]: !prev[id],
    }));
  };

  return (
    <>
      <div className="service-component">
        <div className="wrapper-services my-20">
          <div className="services w-full flex flex-col gap-72">
            <h1 className="color-neutral-black-100 text-[28px] md:text-[40px] leading-20 text-center font-bold">
              {lang_code === 'id' ? (
                <>
                  Percayakan Bisnis Anda <br />
                  dengan Layanan Profesional Kami
                </>
              ) : (
                <>
                  Keep Your Business <br />
                  Running Smoothly with Us
                </>
              )}
            </h1>

            <div className="md:grid-cols-12 md:grid-flow-row w-11/12 mx-auto h-full md:h-[405px] hidden md:grid">
              <div className="col-span-12 md:col-span-5">
                <ul className="list-content flex flex-col">
                  {tabs.map((tab, index) => (
                    <li role="presentation" key={index} onMouseOver={() => setActiveTab(index)} className="cursor-pointer">
                      {activeTab === index ? (
                        <a href={tab.href} target="_blank" rel="noreferrer" className="content-service__active">
                          <div className="list-content-service__active flex items-center gap-4">
                            <div className="features-icon-active__service">
                              <div className="features-icon__rounded__service">
                                <span className="material-symbols-outlined color-neutral-white-100 text-[24px]">{tab.icon}</span>
                              </div>
                            </div>
                            <h1 className="color-neutral-white-100 text-left text-[20px] md:text-[24px] leading-[160%] md:leading-[150%] font-semibold">{tab.title}</h1>
                          </div>
                        </a>
                      ) : (
                        <div className="list-content-service flex items-center gap-4">
                          <Icon materialIcon={tab.icon} classMaterial="material-symbols-outlined color-primary-blue-100 text-[24px]" />
                          <h1 className="color-neutral-black-100 text-left text-[20px] md:text-[24px] leading-[160%] md:leading-[150%] font-semibold">{tab.title}</h1>
                        </div>
                      )}
                    </li>
                  ))}
                </ul>
              </div>

              <div className="col-span-12 md:col-span-7 mt-5 md:mt-0 relative rounded-lg w-full h-full ml-0 md:ml-10">
                <div className="absolute top-0 left-0 w-full h-full rounded-[12px] gradient-services max-h-[395px]"></div>
                <img src={tabs[activeTab].image} alt={tabs[activeTab].title} className="h-[400px] md:h-full w-full rounded-[12px] object-cover max-h-[395px] transition-opacity duration-300" />
                <div className="flex-col space-y-4 md:flex-row md:gap-0 absolute bottom-0 mx-8 my-12 items-center">
                  <div className="title w-full md:w-10/12">
                    <p className="font-normal text-[18px] leading-[160%] color-neutral-white-100">{tabs[activeTab].desc}</p>
                  </div>
                </div>
              </div>
            </div>

            <div className="md:hidden md:grid-flow-row grid mx-4 gap-4">
              {tabs.map((item) => (
                <div key={item.id} className="w-full py-6 px-4 border-b border-gray-300">
                  <div className="grid grid-flow-col items-center justify-between gap-4 text-center">
                    <div className="features-icon-active__service__mobile">
                      <div className="features-icon__rounded__service__mobile">
                        <span className="material-symbols-outlined color-neutral-black-100 text-[24px]">{item.icon}</span>
                      </div>
                    </div>
                    <h1 className="text-[20px] leading-[1.6] font-semibold">{item.title}</h1>
                    <span className="material-symbols-outlined color-neutral-black-100 text-[24px] cursor-pointer hover:scale-110 select-none" onClick={() => toggleCollapse(item.id)}>
                      {collapseService[item.id] ? 'expand_less' : 'expand_more'}
                    </span>
                  </div>
                  {collapseService[item.id] && <div className="text-justify mt-2 transition-opacity duration-500">{item.desc}</div>}
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
