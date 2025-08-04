import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import StructureSection from './section/StructureSection';

export default function StructureLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/tentang/struktur" direct_link_en="/en/about/structure" />
      <StructureSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
