import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import MobileAppSection from './section/MobileAppSection';

export default function MobileAppLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/produk/mobile-aplikasi" direct_link_en="/en/product/mobile-app" />
      <MobileAppSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
