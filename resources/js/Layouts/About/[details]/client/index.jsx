import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import ClientSection from './section/ClientSection';

export default function ClientLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/tentang/klien" direct_link_en="/en/about/clients" />
      <ClientSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
