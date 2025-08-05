import '../client.css';
import BackNavigation from '../../../../../components/BackNavigation';
import data from '../../../../../data/clients.json';
import { usePage } from '@inertiajs/react';

export default function ClientSection({ lang_code }) {
  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';

  return (
    <div className="content-clients">
      <BackNavigation backTo={lang_code === 'id' ? 'Tentang' : 'About'} hrefTo={backPath} />

      <section>
        <div>
          <div className="text-center flex flex-row justify-center">
            <img src="/images/logo/clients.png" alt="Clients Logo" className="absolute" />
          </div>
          <h1 className="color-neutra-black-100 font-bold mt-16 text-[28px] md:text-[52px] text-center">{lang_code === 'id' ? 'Klien' : 'Clients'}</h1>
          <div className="list-client my-[72px] w-10/12 mx-auto">
            <div className="client grid grid-cols-2 md:grid-cols-5 gap-[72px] items-start">
              {data.clients.map((client, index) => (
                <div key={index} className="card-client flex flex-col gap-4">
                  <div>
                    <img
                      src={client.image}
                      alt={client.name}
                      className="rounded-[10px] mx-auto"
                    />
                  </div>
                  <div className="mt-2">
                    <p className="color-neutral-black-100 text-base leading-[1.6] font-semibold text-center">
                      {client.name}
                    </p>
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
