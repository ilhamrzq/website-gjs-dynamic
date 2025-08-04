import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import ConsultancySection from './section/ConsultancySection';

export default function ConsultancyLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/layanan/pengamanan" direct_link_en="/en/services/consultancy-security" />
      <ConsultancySection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
