import { useParams } from 'react-router-dom';
import Navbar from '../../../../../components/Navbar';
import CareerDetailSection from './section/CareerDetailSection';

export default function CareerDetailLayout({ lang_code }) {
  const { id } = useParams();

  const direct_link_id = id ? `/id/tentang/karir/${id}` : '/id/tentang/karir';
  const direct_link_en = id ? `/en/about/career/${id}` : '/en/about/career';

  return (
    <>
      <Navbar lang_code={lang_code} direct_link_id={direct_link_id} direct_link_en={direct_link_en} />
      <CareerDetailSection lang_code={lang_code} />
    </>
  );
}
