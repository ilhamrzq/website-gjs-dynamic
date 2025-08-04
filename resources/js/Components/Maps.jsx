import '../assets/css/maps.css';

export default function Maps({ contentMaps, contactButton }) {
  return (
    <div className="grid grid-flow-row md:grid-flow-col md:grid-cols-2 gap-4">
      <div
        className="col-span-2 p-0 md:p-12 bg-neutral-white-100 right-items-maps"
        style={{
          background: "url('/images/logo/logo-gjs-transparent.png') no-repeat",
          backgroundPosition: 'right -140px bottom',
        }}
      >
        <div className="flex flex-col justify-evenly h-full p-4 md:p-0">
          <div>
            <h1 className="font-bold fs-24 md:text-[40px] color-neutral-black-100 pr-4">{contentMaps}</h1>
            <p className="text-subtitle">Gedung i-Hub Lantai 3A, Jalan KH. Wahid Hasyim No. 38, Jakarta Pusat 10340, Indonesia</p>
          </div>
          <div className="flex flex-col md:flex-row my-4 gap-4 relative">
            <a href="https://api.whatsapp.com/send?phone=081513911456" target="_blank" rel="noopener noreferrer" className="text-button">
              {contactButton}
            </a>
            {/* <button className="button-secondary">Download Company Profile</button> */}
          </div>
        </div>
      </div>
    </div>
  );
}
