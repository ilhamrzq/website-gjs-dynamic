import { Link } from 'react-router-dom';
import '../design.css';

export default function DesignSection({ lang_code }) {
  const backLink = lang_code === 'id' ? { to: '/id', label: 'Layanan' } : { to: '/en', label: 'Service Detail' };

  return (
    <div className="content-newspage">
      <div className="design-supervision__service relative hidden md:block">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backLink.to} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-white-100">
              {backLink.label}
            </h3>
          </Link>
        </div>
        <div className="absolute left-0 right-0 bottom-[-100px] justify-center flex flex-col items-center">
          <div className="design-icon">
            <div className="design-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                description
              </span>
            </div>
          </div>
          <h1 className="fs-28 font-bold text-center">{lang_code === 'id' ? 'Supervisi & Desain' : 'Design and Supervision'}</h1>
        </div>
      </div>

      <div className="design-supervision__service__mobile relative block md:hidden">
        <div className="header-career py-[72px] w-10/12 mx-auto">
          <Link to={backLink.to} className="flex flex-row gap-4 items-center">
            <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
              </svg>
            </div>
            <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-black-100">
              {backLink.label}
            </h3>
          </Link>
        </div>
        <div className="image-banner-mobile">
          <img className="w-full object-cover" src="/images/services/mobile/service_mobile_design.png" alt="training-center" />
        </div>
        <div className="absolute left-0 right-0 bottom-[-160px] justify-center flex flex-col items-center bg-layanan py-[56px]">
          <div className="design-icon">
            <div className="design-icon__rounded text-center">
              <span className="material-symbols-outlined color-primary-blue-100" style={{ fontSize: '52px' }}>
                description
              </span>
            </div>
          </div>
          <h1 className="fs-24 font-bold text-center">{lang_code === 'id' ? 'Supervisi & Desain' : 'Design and Supervision'}</h1>
        </div>
      </div>

      <section>
        {lang_code === 'id' ? (
          <div className="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p className="text-subtitle">
              Perencanaan atau yang sudah akrab dengan istilah planning adalah satu dari fungsi manajemen yang sangat penting. Rencana yang baik akan sangat mempengaruhi proses pekerjaan dalam merancang desain ruangan Anda yang ada di
              gedung bertingkat, perumahan, hingga konsep pertamanan.
              <br />
              <br />
              Ruang atau bangunan agar sesuai dengan fungsinya dibutuhkan rencana, rancangan, dan pengawasan yang tepat. Global Jasa Sejahtera menyediakan layanan konsultasi untuk perencanaan, perancangan, dan pengawasan dengan fokus pada
              gedung bertingkat, perhotelan, perumahan, serta pertamanan.
              <br />
              <br />
              Didukung oleh tenaga profesional, jujur, berintegritas, berpengalaman, serta ahli di bidang interior dan aristektur, kami berkomitmen untuk selalu memberikan layanan terbaik bagi para klien dan selalu mengutamakan kualitas dan
              ketepatan waktu dengan standar kerja yang tinggi.
            </p>
          </div>
        ) : (
          <div className="w-11/12 md:w-10/12 mx-auto my-[180px]">
            <p className="text-subtitle mb-4">
              Planning, or what is commonly known as 'perencanaan' in Indonesian, is one of the crucial functions of management. A well-crafted plan significantly influences the workflow in designing spaces, whether they are in multi-story
              buildings, residential areas, or garden concepts.
            </p>

            <p className="text-subtitle mb-4">
              To ensure that spaces or buildings serve their intended functions, proper planning, design, and supervision are essential. Global Jasa Sejahtera offers consulting services for planning, design, and supervision with a specific
              focus on multi-story buildings, hospitality, residential projects, and landscaping.
            </p>
            <p className="text-subtitle mb-4">
              Backed by a team of dedicated professionals who are honest, experienced, and knowledgeable in the fields of interior design and architecture, we are committed to delivering the best services to our clients. Our priority is
              always to uphold quality and timeliness, maintaining high standards of workmanship.
            </p>
          </div>
        )}
      </section>
    </div>
  );
}
