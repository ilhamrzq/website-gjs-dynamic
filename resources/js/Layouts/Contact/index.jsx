import Footer from '../../components/Footer';
import Navbar from '../../components/Navbar';
import ContactSection from './section/ContactSection';

export default function ContactLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/kontak" direct_link_en="/en/contact" />
      <ContactSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
