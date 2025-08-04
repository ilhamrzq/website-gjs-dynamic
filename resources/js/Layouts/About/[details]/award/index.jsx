import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import AwardSection from './section/AwardSection';

export default function AwardLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/tentang/penghargaan" direct_link_en="/en/about/awards" />
      <AwardSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
