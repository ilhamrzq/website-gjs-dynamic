import '../../assets/css/homepage.css';
import Footer from '../../components/Footer';
import Navbar from '../../components/Navbar';
import AboutSection from './section/AboutSection';
import AwardSection from './section/AwardSection';
import ClientSection from './section/ClientSection';
import HeroSection from './section/HeroSection';
import NewsSection from './section/NewsSection';
import ProductSection from './section/ProductSection';
import ServiceSection from './section/ServiceSection';

export default function HomepageLayout({ lang_code }) {
  return (
    <>  
      <Navbar lang_code={lang_code} direct_link_id="/" direct_link_en="/en" />
      <HeroSection lang_code={lang_code} />
      <AboutSection lang_code={lang_code} />
      <ServiceSection lang_code={lang_code} />
      <ProductSection lang_code={lang_code} />
      <ClientSection lang_code={lang_code} />
      <AwardSection lang_code={lang_code} />
      <NewsSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
