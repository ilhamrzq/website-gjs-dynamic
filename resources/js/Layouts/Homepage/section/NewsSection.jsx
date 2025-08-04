import { useState, useMemo } from 'react';
import { Link } from '@inertiajs/react';

import data from '../../../data/news.json';

export default function NewsSection({ lang_code }) {
  const [externalNewsLinks, setExternalNewsLink] = useState([
    { name: 'MNC Peduli', url: 'https://www.mncpeduli.org/' },
    { name: 'Okezone', url: 'https://www.okezone.com/' },
    { name: 'SindoNews', url: 'https://www.sindonews.com/' },
  ]);

  const viewMoreNews = lang_code === 'id' ? { to: '/id/berita', label: 'Berita Lainnya' } : { to: '/en/news', label: 'View More' };

  const news_highlight = lang_code === 'id' ? data.news_id : data.news_en;

  const news = useMemo(() => {
    const sorted = [...news_highlight].sort((a, b) => b.id - a.id);
    return sorted.slice(0, 2);
  }, [news_highlight]);

  return (
    <div className="news-component">
      <div className="wrapper-news mt-40 w-11/12 mx-auto">
        <div className="news">
          <div className="news-title text-center relative flex items-center justify-center">
            <img loading="lazy" src="/images/images/news-icon.png" className="absolute -top-20" alt="news_icon" />
            <h1 className="text-primary font-bold leading-[150%] text-[28px] md:text-[40px]">{lang_code === 'id' ? 'Berita Terbaru' : 'Check Our Latest News'}</h1>
          </div>

          <div className="news-content mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
            {news.map((item) => {
              const newsDetail = lang_code === 'id' ? { to: `/id/berita/${item.id}`, label: 'Selengkapnya' } : { to: `/en/news/${item.id}`, label: 'Read More' };
            
              return (
                <div key={item.id} className="card shadow-2xl rounded-2xl overflow-hidden flex flex-col">
                  <div className="news-content__image">
                    <img loading="lazy" src={item.img} alt={item.title} className="rounded-t-2xl w-full h-[200px] md:h-[300px] xl:h-[400px] 2xl:h-[500px] object-cover" />
                  </div>
                  <div className="news-content__desc px-8 py-8 flex flex-col flex-1">
                    <p className="mb-4 opacity-60 text-sm">
                      {item.category} | {item.date}
                    </p>
                    <h3 className="mb-2 font-semibold text-2xl text-primary truncate hover:text-clip">{item.title}</h3>
                    <p className="mb-8 text-subtitle text-justify flex-1">{item.thumbnail_desc}</p>
                    <Link to={newsDetail.to} className="button-secondary w-max self-start mt-auto">
                      {newsDetail.label}
                    </Link>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </div>

      {/* CTA All News */}
      <div className="mx-auto text-center my-[52px]">
        <Link to={viewMoreNews.to} className="button-primary text-white inline-flex items-center gap-2">
          {viewMoreNews.label}
          <span className="material-symbols-outlined text-base">arrow_forward</span>
        </Link>
      </div>

      {/* External News Links */}
      <div className="text-center">
        <hr className="mt-[-24px] my-4 border-t border-gray-300 w-1/4 mx-auto" />
        <p className="text-primary font-semibold mb-1">{lang_code === 'id' ? 'Lihat Juga:' : 'See Also:'}</p>
        <div className="flex flex-wrap justify-center gap-4">
          {externalNewsLinks.map((source, index) => (
            <a key={index} href={source.url} target="_blank" rel="noopener noreferrer" className="px-4 py-2 rounded bg-primary-blue-100 text-white font-medium">
              {source.name}
            </a>
          ))}
        </div>
      </div>
    </div>
  );
}
