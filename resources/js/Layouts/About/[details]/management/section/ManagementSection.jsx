import { usePage } from '@inertiajs/react';
import BackNavigation from '../../../../../components/BackNavigation';
import data from '../../../../../data/structure.json';

export default function ManagementSection({ lang_code }) {
  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';

  const data_commissioners = lang_code === 'id' ? data.data_commissioners_id : data.data_commissioners_en;
  const data_directors = lang_code === 'id' ? data.data_directors_id : data.data_directors_en;

  return (
    <div className="content-about">
      <BackNavigation backTo={lang_code === 'id' ? 'Tentang' : 'About'} hrefTo={backPath} />

      <section>
        <div className="text-center flex flex-row justify-center">
          <img src="/images/logo/management-bod.png" className="absolute" alt="Management BOD" />
        </div>

        <h1 className="color-neutra-black-100 font-bold mt-16 fs-28 md:text-[52px] text-center">{lang_code === 'id' ? 'Manajemen & Direksi' : 'Management and Board of Directors'}</h1>

        {/* KOMISARIS */}
        <div className="commisioners">
          <h3 className="text-center text-[24px] md:text-[40px] leading-140 font-bold color-primary-blue-100 mt-72 mb-10">{lang_code === 'id' ? 'Komisaris' : 'Commissioners'}</h3>
          <div className="list-commissioners">
            <div className="w-11/12 mx-auto grid grid-flow-row gap-10">
              {data_commissioners.map((com) => (
                <div key={com.name} className="card grid grid-flow-row md:grid-flow-col md:grid-cols-12 gap-10 p-4">
                  <div className="md:col-span-3">
                    <img src={com.image} className="rounded-2xl w-full" alt={com.name} />
                  </div>
                  <div className="md:col-span-9">
                    <div className="title_name">
                      <h1 className="font-semibold text-[28px] 2xl:text-[42px] leading-150 color-neutral-black-100 mb-2">{com.name}</h1>
                      <p className="text-[20px] 2xl:text-[28px] leading-160 color-neutral-black-60">{com.title}</p>
                    </div>
                    <div className="mt-8">
                      <p className="text-base 2xl:text-[20px] leading-160 text-justify color-neutral-black-60" dangerouslySetInnerHTML={{ __html: com.desc }} />
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* DIREKTUR */}
        <div className="directors">
          <h3 className="text-center fs-40 leading-140 font-bold color-primary-blue-100 mt-72 mb-10">Direktur</h3>
          <div className="list-directors">
            <div className="w-11/12 mx-auto grid grid-flow-row gap-10">
              {data_directors.map((dir) => (
                <div key={dir.name} className="card grid grid-flow-row md:grid-flow-col md:grid-cols-12 gap-10 p-4">
                  <div className="md:col-span-3">
                    <img src={dir.image} alt={dir.name} style={{ aspectRatio: '4 / 6', objectFit: 'cover' }} className="rounded-2xl w-full" />
                  </div>
                  <div className="md:col-span-9">
                    <div className="title_name">
                      <h1 className="font-semibold text-[28px] 2xl:text-[42px] leading-150 color-neutral-black-100 mb-2">{dir.name}</h1>
                      <p className="text-[20px] 2xl:text-[28px] leading-160 color-neutral-black-60">{dir.title}</p>
                    </div>
                    <div className="mt-8">
                      <p className="text-base 2xl:text-[20px] leading-160 text-justify color-neutral-black-60" dangerouslySetInnerHTML={{ __html: dir.desc }} />
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
