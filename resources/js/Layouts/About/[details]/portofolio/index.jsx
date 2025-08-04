import '../../../../assets/css/about.css';
import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import ImageSection from './section/ImageSection';

export default function PortofolioLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/tentang/portofolio" direct_link_en="/en/about/portfolio" />
      <ImageSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
