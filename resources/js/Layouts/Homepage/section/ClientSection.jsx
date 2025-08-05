import { Link } from '@inertiajs/react';
import data from '../../../data/clients.json';

export default function ClientSection({ lang_code }) {
  const mobileData = data.clients.slice(0, 6);

  const viewMoreClient = lang_code === 'id' ? { to: '/id/tentang/klien', label: 'Lebih Lanjut' } : { to: '/en/about/clients', label: 'View More' };

  return (
    <div className="client-component">
      <div className="wrapper-clients">
        {/* Title & Subtitle */}
        <div className="flex flex-col items-center gap-4">
          <h1 className="text-primary leading-[60px] text-[28px] md:text-[40px] font-semibold text-center">{lang_code === 'id' ? 'Klien Kami' : 'Our Clients'}</h1>
          <p className="text-subtitle text-center w-full md:w-6/12">
            {lang_code === 'id'
              ? 'Saat ini kami tersebar di 132 kota dan 32 provinsi di seluruh Indonesia, melayani 45 gedung yang meliputi area seluas total 5.000 hektar.'
              : 'We are currently spread across 132 cities and 32 province, serving 45 buildings which covers an area 5000 ha.'}
          </p>
        </div>

        {/* Desktop Grid */}
        <div className="clients my-[56px] w-11/12 mx-auto hidden md:block">
          <div className="grid grid-flow-row md:grid-cols-5 h-full w-full justify-around gap-x-[70px] gap-y-[56px]">
            {data.clients.map((item, index) => (
              <div key={index} className="flex items-center">
                <img loading="lazy" src={item.image} alt={item.name} className="shadow-2xl rounded-xl" />
              </div>
            ))}
          </div>
        </div>

        {/* Mobile Grid */}
        <div className="clients my-[56px] w-11/12 mx-auto block md:hidden">
          <div className="grid grid-cols-2 md:grid-cols-2 h-full w-full justify-around gap-x-[70px] gap-y-[56px]">
            {mobileData.map((item, index) => (
              <div key={index} className="flex items-center">
                <img loading="lazy" src={item.image} alt={item.name} className="shadow-2xl rounded-xl" />
              </div>
            ))}
          </div>
        </div>

        {/* CTA View More */}
        <div className="mx-auto text-center py-14">
          <Link href={viewMoreClient.to} className="button-primary text-white inline-flex items-center gap-2">
            {viewMoreClient.label}
            <span className="material-symbols-outlined text-base">arrow_forward</span>
          </Link>
        </div>
      </div>
    </div>
  );
}
