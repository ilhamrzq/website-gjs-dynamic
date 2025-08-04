import Footer from '../../../../components/Footer';
import Navbar from '../../../../components/Navbar';
import TrainingSection from './section/TrainingSection';

export default function TrainingLayout({ lang_code }) {
  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id="/id/layanan/pusat-pelatihan" direct_link_en="/en/services/training-center" />
      <TrainingSection lang_code={lang_code} />
      <Footer lang_code={lang_code} />
    </>
  );
}
