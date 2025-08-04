import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import WebAppSection from './section/WebAppSection';

export default function WebAppLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/produk/web-aplikasi" direct_link_en="/en/product/web-app" />
      <WebAppSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
