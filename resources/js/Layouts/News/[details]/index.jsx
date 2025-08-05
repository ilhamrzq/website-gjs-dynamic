import Navbar from '../../../components/Navbar';
import Footer from '../../../components/Footer';
import NewsDetailSection from './section/NewsDetailSection';

export default function NewsDetailLayout({ lang_code, id }) {
  const direct_link_id = id ? `/id/berita/${id}` : '/id/berita';
  const direct_link_en = id ? `/en/news/${id}` : '/en/news';

  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id={direct_link_id} direct_link_en={direct_link_en} />
      <NewsDetailSection lang_code={lang_code} id={id} />
      <Footer lang_code={lang_code} />
    </>
  );
}
