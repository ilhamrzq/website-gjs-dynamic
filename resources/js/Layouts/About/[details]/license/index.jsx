import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import LicenseSection from './section/LicenseSection';

export default function LicenseLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/tentang/suratizin" direct_link_en="/en/about/license" />
      <LicenseSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
