import Footer from '../../components/Footer';
import Navbar from '../../components/Navbar';
import NewsSection from './section/NewsSection';

export default function NewsLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/berita" direct_link_en="/en/news" />
      <NewsSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
