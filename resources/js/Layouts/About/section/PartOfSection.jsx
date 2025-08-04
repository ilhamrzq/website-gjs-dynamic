export default function PartOfSection({ lang_code }) {
  
  const mnclandVideo = lang_code === 'id' 
  ? 'https://www.youtube.com/embed/cP9oBw36Gtw' 
  : 'https://www.youtube.com/embed/L3nF7WUquqM';

  const mncgroupVideo = lang_code === 'id' 
  ? 'https://www.youtube.com/embed/uhA6agUkDf8?si=TAqDiN63F9He4N-N' 
  : 'https://www.youtube.com/embed/4ACKoPWabus?si=KcvSdYeA5u5Y_xE3';

  return (
    <div className="my-40 flex flex-col gap-40">
      <section>
        <div className="title flex flex-col items-center gap-6">
          <h1 className="flex text-black font-bold text-[28px] md:text-[52px] gap-0 md:gap-1 items-center flex-col md:flex-row">
            {lang_code === 'id' ? 'Bagian Dari' : 'Part Of'}
            <span>
              <img alt="logo-mncland" src="/images/logo/mnc-tourism-indonesia.webp" width="225" height="86" />
            </span>
          </h1>
          <p className="font-normal color-neutral-black-60 text-center text-base md:w-8/12 w-11/12 mx-auto">
            {lang_code === 'id'
              ? 'Sebagai bagian dari MNC Group, MNC Tourism Indonesia telah berkembang menjadi salah satu perusahaan Hiburan Perhotelan terbesar di Indonesia. MNC Tourism Indonesia terus berkembang dan berfokus pada pengembangan proyek unggulannya, yaitu SEZ MNC Lido City, MNC Bali Resort, dan proyek-prestisius lainnya.'
              : 'As part of MNC Group, MNC Tourism Indonesia has grown to become one of the largest Entertainment Hospitality Companies in Indonesia. MNC Tourism Indonesia continues to grow and focuses on the development of its flagship projects, namely SEZ MNC Lido City, MNC Bali Resort, and other prestigious projects.'}
          </p>
          <div className="video my-10 w-11/12 md:w-8/12 mx-auto">
            <iframe
              width="100%"
              className="rounded-[8px] h-[200px] md:h-[450px] md:rounded-xl"
              src={mnclandVideo}
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
            ></iframe>
          </div>
          <a href="https://www.mncland.com/" target="_blank" className="button-primary text-white">
            {lang_code === 'id' ? 'Tentang MNC Tourism Indonesia' : 'Learn More About MNC Tourism Indonesia'}
          </a>
        </div>
      </section>

      <section>
        <div className="title flex flex-col gap-6 items-center">
          <h1 className="flex text-black font-bold text-[28px] md:text-[52px] gap-0 md:gap-4 items-center flex-col md:flex-row">
            {lang_code === 'id' ? 'Bagian Dari' : 'Part Of'}
            <br />
            <span>
              <img alt="logo-mncgroup" src="/images/about/MNCGroup.png" width="200" height="86" />
            </span>
          </h1>
          <p className="font-normal color-neutral-black-60 text-center text-base md:w-8/12 w-11/12 mx-auto">
            {lang_code === 'id'
              ? 'Berdiri pada tahun 1989, MNC Group telah berkembang menjadi salah satu kelompok bisnis nasional terbesar di Indonesia. Di bawah kepemimpinan pendirinya dan Ketua Eksekutif, Hary Tanoesoedibjo, MNC Group telah menjadi pemimpin dalam 4 investasi strategis: Media & Hiburan, Layanan Keuangan, Hiburan Perhotelan, dan Energi.'
              : 'Founded in 1989, MNC Group has grown to become one of the largest national business groups in Indonesia. Under the leadership of its founder and Executive Chairman Hary Tanoesoedibjo, MNC Group has become the leader in 4 strategic investments: Media & Entertainment, Financial Services, Entertainment Hospitality, and Energy.'}
          </p>
          <div className="video my-10 w-11/12 md:w-8/12 mx-auto">
            <iframe
              width="100%"
              className="rounded-[8px] h-[200px] md:h-[450px] md:rounded-xl"
              src={mncgroupVideo}
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
            ></iframe>
          </div>
          <a href="https://www.mncgroup.com/" target="_blank" className="button-primary text-white">
            {lang_code === 'id' ? 'Tentang MNC Group' : 'Learn More About MNC Group'}
          </a>
        </div>
      </section>
    </div>
  );
}
