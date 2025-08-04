import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import DesignSection from './section/DesignSection';

export default function DesignLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/layanan/supervisi-desain" direct_link_en="/en/services/design-supervision" />
      <DesignSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
