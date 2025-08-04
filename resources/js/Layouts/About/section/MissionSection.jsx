import { useState } from 'react';

export default function MissionSection({ lang_code }) {
  const [activeTab, setActiveTab] = useState(1);

  const corporate_value =
    lang_code === 'id'
      ? [
          { id: 1, value: 'Profesional', icon: 'engineering' },
          { id: 2, value: 'Proporsional', icon: 'how_to_reg' },
          { id: 3, value: 'Responsif', icon: 'sports_kabaddi' },
          { id: 4, value: 'Kemitraan', icon: 'people' },
          { id: 5, value: 'Kepercayaan', icon: 'emoji_people' },
        ]
      : [
          {
            id: 1,
            value: 'Professional',
            icon: 'engineering',
          },
          {
            id: 2,
            value: 'Proportional',
            icon: 'how_to_reg',
          },
          {
            id: 3,
            value: 'Responsive',
            icon: 'sports_kabaddi',
          },
          {
            id: 4,
            value: 'Partnership',
            icon: 'people',
          },
          {
            id: 5,
            value: 'Trust',
            icon: 'emoji_people',
          },
        ];

  const [tabsVisionMission, setTabsVisionMission] = useState(
    lang_code === 'id'
      ? [
          {
            id: 1,
            active: true,
            title: 'Visi',
            icon: 'policy',
            content: 'Menyediakan manajemen properti yang dinamis <br /> dan layanan pengembangan dengan keuntungan terbaik <br /> dalam skala ekonomi.',
          },
          {
            id: 2,
            active: false,
            title: 'Misi',
            icon: 'track_changes',
            content: 'Pengelolaan Properti melalui sumber daya manusia yang <br /> handal, kompeten, profesional, dan berwawasan ke depan akan <br /> meningkatkan kualitas properti yang diinvestasikan di masa depan.',
          },
        ]
      : [
          {
            id: 1,
            active: true,
            title: 'Vision',
            icon: 'policy',
            content: 'To provide dynamic property management and development services with the best return in the economy of scales.',
          },
          {
            id: 2,
            active: false,
            title: 'Mission',
            icon: 'track_changes',
            content: 'Property Management through reliable, competent, professional and forward looking human resources, will enhance the quality of invested properties in the future.',
          },
        ]
  );

  const changeTabVisionMissionMobile = (id) => {
    setTabsVisionMission((prev) =>
      prev.map((item) => ({
        ...item,
        active: item.id === id,
      }))
    );
  };

  return (
    <>
      <section className="bg_vision_mision">
        <div className="top-item">
          {/* Mobile Title */}
          <div className="title mb-4 block md:hidden">
            <h1 className="text-center text-[28px] color-neutral-white-100 font-bold leading-[1.5]">{lang_code === 'id' ? 'Perusahaan' : 'Company Overview'}</h1>
          </div>

          {/* Desktop Vision Mission */}
          <div className="grid-flow-col gap-0 md:gap-4 px-[76px] md:px-0 hidden md:grid">
            {tabsVisionMission.map((item) => (
              <div key={item.id}>
                <div className="flex flex-col items-center justify-center p-4 md:p-0">
                  <div className="wrapper-icon w-[60px] md:w-[120px] h-[60px] md:h-[120px] p-2 md:p-4">
                    <div className="icon w-[44px] md:w-[88px] h-[44px] md:h-[88px] flex items-center align-middle justify-center">
                      <span className="material-symbols-outlined text-white text-3xl md:text-5xl">{item.icon}</span>
                    </div>
                  </div>
                  <div className="desc mt-2 md:mt-8 text-center">
                    <h1 className="text-[18px] md:text-[28px] text-white font-semibold">{item.title}</h1>
                    <p className="text-[18px] font-normal text-white-opacity mt-2 p-8 hidden md:block" dangerouslySetInnerHTML={{ __html: item.content }}></p>
                  </div>
                </div>
              </div>
            ))}
          </div>

          {/* Mobile Vision Mission */}
          <div className="grid-flow-col gap-0 md:gap-4 px-[76px] md:px-0 grid md:hidden">
            {tabsVisionMission.map((item) => (
              <div key={item.id} onClick={() => setActiveTab(item.id)}>
                <a
                  aria-label="value_visi_misi"
                  href="#value_visi_misi"
                  className={`flex flex-col items-center justify-center p-4 md:p-0 cursor-pointer ${item.active ? 'vision-active' : ''}`}
                  onClick={() => changeTabVisionMissionMobile(item.id)}
                >
                  <div className="wrapper-icon w-[60px] md:w-[120px] h-[60px] md:h-[120px] p-2 md:p-4">
                    <div className="icon w-[44px] md:w-[88px] h-[44px] md:h-[88px] flex items-center align-middle justify-center">
                      <span className="material-symbols-outlined text-white text-3xl md:text-5xl">{item.icon}</span>
                    </div>
                  </div>
                  <div className="desc mt-2 md:mt-8 text-center">
                    <h1 className="text-[18px] md:text-[28px] text-white font-semibold">{item.title}</h1>
                    <p className="text-[18px] font-normal text-white-opacity mt-2 p-8 hidden md:block" dangerouslySetInnerHTML={{ __html: item.content }}></p>
                  </div>
                </a>
              </div>
            ))}
          </div>
        </div>

        {/* Bottom Item */}
        <div className="bottom-item mt-[60px] mb-[60px]" id="value_visi_misi">
          <h1 className="text-center text-[28px] md:text-[40px] font-bold text-white">Nilai-Nilai Perusahaan</h1>

          {/* Desktop */}
          <div className="md:grid grid-flow-col items-center justify-center my-8 gap-[10px] md:gap-[72px] hidden">
            {corporate_value.map((item) => (
              <div key={item.id} className="flex flex-col gap-4 items-center justify-center">
                <div className="wrapper-icon w-[60px] md:w-[120px] h-[60px] md:h-[120px] p-2 md:p-4">
                  <div className="icon w-[44px] md:w-[88px] h-[44px] md:h-[88px] flex items-center align-middle justify-center">
                    <span className="material-symbols-outlined text-white text-2xl md:text-5xl">{item.icon}</span>
                  </div>
                </div>
                <h1 className="text-center font-semibold text-[14px] md:text-[18px] text-white">{item.value}</h1>
              </div>
            ))}
          </div>

          {/* Mobile */}
          <div className="block md:hidden">
            <div className="grid grid-cols-3 items-center justify-center my-8">
              {corporate_value.slice(0, 3).map((item) => (
                <div key={item.id} className="flex flex-col gap-4 items-center justify-center">
                  <div className="wrapper-icon w-[60px] md:w-[120px] h-[60px] md:h-[120px] p-2 md:p-4">
                    <div className="icon w-[44px] md:w-[88px] h-[44px] md:h-[88px] flex items-center align-middle justify-center">
                      <span className="material-symbols-outlined text-white text-2xl md:text-5xl">{item.icon}</span>
                    </div>
                  </div>
                  <h1 className="text-center font-semibold text-[14px] md:text-[18px] text-white">{item.value}</h1>
                </div>
              ))}
            </div>
            <div className="grid grid-cols-2 items-center justify-evenly pl-[50px] pr-[50px] my-8">
              {corporate_value.slice(3, 5).map((item) => (
                <div key={item.id} className="flex flex-col gap-4 items-center justify-center">
                  <div className="wrapper-icon w-[60px] md:w-[120px] h-[60px] md:h-[120px] p-2 md:p-4">
                    <div className="icon w-[44px] md:w-[88px] h-[44px] md:h-[88px] flex items-center align-middle justify-center">
                      <span className="material-symbols-outlined text-white text-2xl md:text-5xl">{item.icon}</span>
                    </div>
                  </div>
                  <h1 className="text-center font-semibold text-[14px] md:text-[18px] text-white">{item.value}</h1>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Overview */}
      <div className="m-6 block md:hidden">
        <div className="w-full h-[64px] rounded-[30px] flex flex-col items-center justify-center" style={{ background: 'rgba(35, 54, 114, 0.6)' }}>
          <div className="overview bg-neutral-white-100 py-2 px-6 rounded-lg">
            <h1 className="text-[20px] md:text-[28px] font-bold text-white text-center color-primary-blue-100">Overview</h1>
          </div>
        </div>

        {activeTab === 1 && (
          <h1 className="text-[18px] leading-[28px] font-medium text-center my-4">
            {lang_code === 'id'
              ? 'Menyediakan manajemen properti yang dinamis dan layanan pengembangan dengan keuntungan terbaik dalam skala ekonomi'
              : 'To provide dynamic property management and development services with the best return in the economy of scales.'}
            .
          </h1>
        )}
        {activeTab === 2 && (
          <h1 className="text-[18px] leading-[28px] font-medium text-center my-4">
            {lang_code === 'id'
              ? 'Pengelolaan Properti melalui sumber daya manusia yang handal, kompeten, profesional, dan berwawasan ke depan akan meningkatkan kualitas properti yang diinvestasikan di masa depan.'
              : 'Property Management through reliable, competent, professional and forward looking human resources, will enhance the quality of invested properties in the future.'}
          </h1>
        )}
      </div>
    </>
  );
}
