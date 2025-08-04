import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import CareerSection from './section/CareerSection';

export default function CareerLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/tentang/karir" direct_link_en="/en/about/career" />
      <CareerSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
