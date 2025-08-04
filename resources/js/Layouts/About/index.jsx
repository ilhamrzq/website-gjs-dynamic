import '../../assets/css/about.css';
import Footer from '../../components/Footer';
import Navbar from '../../components/Navbar';
import AboutSection from './section/AboutSection';
import MissionSection from './section/MissionSection';
import PartOfSection from './section/PartOfSection';

export default function AboutLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/tentang" direct_link_en="/en/about" />
      <AboutSection lang_code={lang_code} />
      <MissionSection lang_code={lang_code} />
      <PartOfSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
