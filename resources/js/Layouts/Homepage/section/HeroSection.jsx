import { useState } from 'react';
import { Link } from '@inertiajs/react';
import data from '../../../data/hero.json';

export default function HeroSection({ lang_code }) {
  const [modalVideo, setModalVideo] = useState(false);
  const datas = lang_code === 'id' ? data.data_hero_id : data.data_hero_en;

  const showModal = () => {
    setModalVideo(!modalVideo);
  };

  return (
    <section>
      {/* Desktop Version */}
      <div className="hidden md:block">
        <div className="hero-component h-full relative">
          <video playsInline muted autoPlay loop className="w-full h-full">
            <source type="video/webm" src="/video/video_banner.mp4" />
          </video>

          <div className="content flex flex-col justify-between items-center absolute top-0 bottom-0 w-full">
            <div></div>
            <div className="border-none w-11/12 mx-auto">
              <h1 className="text-[42px] leading-[120%] font-bold text-center color-neutral-white-100 leading-120 uppercase">Entertainment, Lifestyle Property, & Hospitality</h1>

              <button onClick={showModal} className="flex gap-4 px-6 py-3 rounded-md mx-auto mt-10 flex-row items-center text-base text-center color-primary-blue-100 font-medium leading-[160%] bg-neutral-white-100">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8.5 14.5L14.5 10L8.5 5.5V14.5ZM10.5 0C4.98 0 0.5 4.48 0.5 10C0.5 15.52 4.98 20 10.5 20C16.02 20 20.5 15.52 20.5 10C20.5 4.48 16.02 0 10.5 0ZM10.5 18C6.09 18 2.5 14.41 2.5 10C2.5 5.59 6.09 2 10.5 2C14.91 2 18.5 5.59 18.5 10C18.5 14.41 14.91 18 10.5 18Z"
                    fill="#233672"
                  />
                </svg>
                {lang_code === 'id' ? 'Lihat Video' : 'Watch Video'}
              </button>

              {/* Modal */}
              {modalVideo && (
                <div aria-hidden="true" className="fixed top-0 mt-8 left-0 right-0 z-50 w-[900px] mx-auto p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal">
                  <div className="relative w-full h-full md:h-auto">
                    <div className="relative bg-white rounded-lg shadow">
                      <div className="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 className="text-base font-bold leading-[160%] color-neutral-black-100">GJS Video Profile</h3>
                        <button
                          onClick={showModal}
                          type="button"
                          className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                          <svg aria-hidden="true" className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                              fillRule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clipRule="evenodd"
                            />
                          </svg>
                          <span className="sr-only">Close modal</span>
                        </button>
                      </div>

                      <div className="p-6 space-y-6">
                        <video width="100%" height="482px" src="/video/video_banner.mp4" controls>
                          <source type="video/mp4" />
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                  </div>
                </div>
              )}
            </div>

            <div className="grid grid-flow-col grid-cols-4 w-full info-hero">
              {datas &&
                datas.map((data) => (
                  <Link to={data.href} className="col-span-1 py-6 info" key={data.id}>
                    <div dangerouslySetInnerHTML={{ __html: data.icon }} className="text-white font-bold text-[40px] text-center flex flex-row justify-center mb-4" />
                    <p className="font-bold fs-20 leading-160 color-neutral-white-100 text-center">{data.name}</p>
                  </Link>
                ))}
            </div>
          </div>
        </div>
      </div>

      {/* Mobile Version */}
      <div className="hero-component-mobile block md:hidden w-full">
        <div className="top-hero flex flex-col items-center justify-center h-[695px]">
          <div className="w-11/12 mx-auto">
            <h1 className="fs-24 font-bold text-center color-neutral-white-100 leading-140 uppercase">Entertainment, Lifestyle Property, & Hospitality</h1>
          </div>
        </div>
        <div className="list-count-summary grid grid-cols-2 mt-20">
          {datas.map((item, index) => (
            <div key={index} className="summary text-center py-4 border border-gray-300">
              <span className="material-symbols-outlined fs-30">{item.mobile_icon}</span>
              <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">{item.mobile_name}</h1>
            </div>
          ))}
        </div>
      </div>

      {/* <div className="list-count-summary grid grid-cols-2 mt-20">
          <div className="summary text-center py-4">
            <span className="material-symbols-outlined fs-30"> apartment </span>
            <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">
              Manajemen <br />
              Properti
            </h1>
          </div>
          <div className="summary text-center py-4">
            <span className="material-symbols-outlined fs-30"> security </span>
            <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">Pengamanan dan Keamanan</h1>
          </div>
          <div className="summary text-center py-4">
            <span className="material-symbols-outlined fs-30"> badge </span>
            <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">
              Pusat <br />
              Pelatihan
            </h1>
          </div>
          <div className="summary text-center py-4">
            <span className="material-symbols-outlined fs-30"> description </span>
            <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">
              Supervisi dan <br />
              Desain
            </h1>
          </div>
        </div> */}

      {/* <div className="hero-component-mobile block md:hidden w-full"> */}
      {/* <div className="top-hero flex flex-col items-center justify-center h-[695px]">
          <div className="w-11/12 mx-auto">
            <h1 className="fs-24 font-bold bg-red-500 text-center color-neutral-white-100 leading-140 uppercase">Entertainment, Lifestyle Property, & Hospitality</h1>
          </div>
        </div> */}

      {/* <div className="list-count-summary grid grid-cols-2 mt-20">
          {datas &&
            datas.map((data, index) => (
              <Link to={data.href} className="summary text-center py-4 px-10 border border-gray-300" key={index}>
                <span className="material-symbols-outlined fs-30">{data.mobile_icon}</span>
                <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">{data.name}</h1>
              </Link>
            ))}
        </div> */}
      {/* </div> */}
    </section>
  );
}
{
  /* <div className="summary text-center py-4 border border-gray-300">
  <span className="material-symbols-outlined fs-30">apartment</span>
  <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">
    Manajemen <br />
    Properti
  </h1>
</div>
<div className="summary text-center py-4 border border-gray-300">
  <span className="material-symbols-outlined fs-30">security</span>
  <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">Pengamanan dan Keamanan</h1>
</div>
<div className="summary text-center py-4 border border-gray-300">
  <span className="material-symbols-outlined fs-30">badge</span>
  <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">
    Pusat <br />
    Pelatihan
  </h1>
</div>
<div className="summary text-center py-4 border border-gray-300">
  <span className="material-symbols-outlined fs-30">description</span>
  <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">
    Supervisi dan <br />
    Desain
  </h1>
</div> */
}

// <section>
//   {/* Desktop */}
//   <div className="hidden md:block">
//     <div className="hero-component h-full relative">
//       <video playsInline muted autoPlay loop className="w-full h-full">
//         <source type="video/webm" src="/video/video_banner.mp4" />
//       </video>

//       <div className="content flex flex-col justify-between items-center absolute top-0 bottom-0 w-full">
//         <div></div>
//         <div className="border-none w-11/12 mx-auto">
//           <h1 className="text-[42px] leading-[120%] font-bold text-center color-neutral-white-100 uppercase">Entertainment, Lifestyle Property, & Hospitality</h1>
//           <button onClick={showModal} className="flex gap-4 px-6 py-3 rounded-md mx-auto mt-10 flex-row items-center text-base text-center color-primary-blue-100 font-medium leading-[160%] bg-neutral-white-100">
//             <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
//               <path
//                 d="M8.5 14.5L14.5 10L8.5 5.5V14.5ZM10.5 0C4.98 0 0.5 4.48 0.5 10C0.5 15.52 4.98 20 10.5 20C16.02 20 20.5 15.52 20.5 10C20.5 4.48 16.02 0 10.5 0ZM10.5 18C6.09 18 2.5 14.41 2.5 10C2.5 5.59 6.09 2 10.5 2C14.91 2 18.5 5.59 18.5 10C18.5 14.41 14.91 18 10.5 18Z"
//                 fill="#233672"
//               />
//             </svg>
//             {lang_code === 'id' ? 'Lihat Video' : 'Watch Video'}
//           </button>

//           {modalVideo && (
//             <div aria-hidden="true" className="fixed top-0 mt-8 left-0 right-0 z-50 w-[900px] mx-auto p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal">
//               <div className="relative w-full h-full md:h-auto">
//                 <div className="relative bg-white rounded-lg shadow">
//                   <div className="flex items-start justify-between p-4 border-b rounded-t">
//                     <h3 className="text-base font-bold leading-[160%] color-neutral-black-100">GJS Video Profile</h3>
//                     <button onClick={showModal} type="button" className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
//                       <svg aria-hidden="true" className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
//                         <path
//                           fillRule="evenodd"
//                           d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
//                           clipRule="evenodd"
//                         ></path>
//                       </svg>
//                       <span className="sr-only">Close modal</span>
//                     </button>
//                   </div>
//                   <div className="p-6 space-y-6">
//                     <video width="100%" height="482px" src="/video/video_banner.mp4" controls>
//                       <source type="video/mp4" />
//                       Your browser does not support the video tag.
//                     </video>
//                   </div>
//                 </div>
//               </div>
//             </div>
//           )}
//         </div>

//         <div className="grid grid-flow-col grid-cols-4 w-full info-hero">
//           {datas.map((data) => (
//             <Link to={data.href} className="col-span-1 py-6 info" key={data.id}>
//               <div dangerouslySetInnerHTML={{ __html: data.icon }} className="text-white font-bold text-[40px] text-center flex flex-row justify-center mb-4"></div>
//               <p className="font-bold fs-20 leading-160 color-neutral-white-100 text-center">{data.name}</p>
//             </Link>
//           ))}
//         </div>
//       </div>
//     </div>
//   </div>

//   {/* Mobile */}
//   <div className="hero-component-mobile block md:hidden w-full">
//     <div className="top-hero flex flex-col items-center justify-center h-[695px]">
//       <div className="w-11/12 mx-auto">
//         <h1 className="fs-24 font-bold text-center color-neutral-white-100 leading-140 uppercase">Entertainment, Lifestyle Property, & Hospitality</h1>
//       </div>
//     </div>

//     <div className="list-count-summary grid grid-cols-2 mt-20">
//       {(lang_code === 'id'
//         ? [
//             { icon: 'apartment', name: 'Manajemen Properti' },
//             { icon: 'security', name: 'Pengamanan dan Keamanan' },
//             { icon: 'badge', name: 'Pusat Pelatihan' },
//             { icon: 'description', name: 'Supervisi dan Desain' },
//           ]
//         : [
//             { icon: 'apartment', name: 'Property Management' },
//             { icon: 'security', name: 'Security and Safety' },
//             { icon: 'badge', name: 'Training Center' },
//             { icon: 'description', name: 'Supervision and Design' },
//           ]
//       ).map((item, index) => (
//         <div key={index} className="summary text-center py-4 border border-gray-300">
//           <span className="material-symbols-outlined fs-30">{item.icon}</span>
//           <h1 className="fs-20 font-bold leading-160 color-primary-blue-100">
//             {item.name.split(' ').map((word, idx) =>
//               idx === 1 ? (
//                 <React.Fragment key={idx}>
//                   <br />
//                   {word}{' '}
//                 </React.Fragment>
//               ) : (
//                 word + ' '
//               )
//             )}
//           </h1>
//         </div>
//       ))}
//     </div>
//   </div>
// </section>
