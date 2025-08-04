import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import ManagementSection from './section/ManagementSection';

export default function ManagementLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/layanan/manajemen-properti" direct_link_en="/en/services/building-management" />
      <ManagementSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
