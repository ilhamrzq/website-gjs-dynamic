import React, { useMemo } from 'react';
import { Link } from '@inertiajs/react';
import dataNews from './../../../../data/news.json';
import '../newsDetail.css';

export default function NewsDetailSection({ lang_code, id }) {
  // Get news data based on language
  const data_news = useMemo(() => {
    return lang_code === 'id' ? dataNews.news_id : dataNews.news_en;
  }, [lang_code]);

  // Find the specific news item
  const news = useMemo(() => {
    return data_news.find((p) => p.id === Number(id));
  }, [data_news, id]);

  // Get recent news (latest 2 items excluding current one)
  const another_news = useMemo(() => {
    return data_news
      .filter((item) => item.id !== Number(id))
      .sort((a, b) => b.id - a.id)
      .slice(0, 2);
  }, [data_news, id]);

  // If news not found, show error message
  if (!news) {
    return (
      <div className="content-news-detail__page mt-10 w-10/12 mx-auto">
        <div className="text-center py-20">
          <h1 className="text-2xl font-bold text-red-500">News not found</h1>
          <Link href={lang_code === 'id' ? '/id/berita' : '/en/news'} className="text-blue-500 underline mt-4 inline-block">
            Back to News
          </Link>
        </div>
      </div>
    );
  }

  const backLink = lang_code === 'id' ? '/id/berita' : '/en/news';
  const newsDetailLink = lang_code === 'id' ? '/id/berita' : '/en/news';
  const recentNewsTitle = lang_code === 'id' ? 'Berita Terbaru' : 'Latest News';
  const backButtonText = lang_code === 'id' ? 'Berita' : 'News';

  return (
    <div className="content-news-detail__page mt-10 w-10/12 mx-auto">
      <Link href={backLink} className="header-newspage">
        <div className="flex flex-row justify-between my-14">
          <div className="back-navigation flex flex-row items-center gap-4">
            <span className="material-symbols-outlined text-2xl"> arrow_back </span>
            <p className="font-bold text-center text-[28px] text-black">{backButtonText}</p>
          </div>
        </div>
      </Link>
      <div className="grid grid-flow-row md:grid-cols-10 gap-8">
        <div className="col-span-7 detail-news">
          <div className="flex flex-col gap-8">
            <div className="image-news__detail relative">
              <img src={news.img} className="rounded-2xl w-full object-cover" alt={news.title} />
              <p
                className="absolute top-0 m-4 px-4 py-[2px] color-neutral-white-100 rounded-[2px]"
                style={{
                  background: 'rgba(33, 36, 58, 0.6)',
                  backdropFilter: 'blur(3px)',
                }}
              >
                {news.category}
              </p>
            </div>
            <div className="content-news__detail">
              <p className="label-news__detail max-w-min px-4 py-[2px] mb-4 opacity-60 rounded-[4px] bg-gray-200">{news.date}</p>
              <h1 className="heading-news__detail text-black text-2xl font-semibold">{news.title}</h1>
              <div className="desc-news__detail mt-2 text-subtitle text-justify" dangerouslySetInnerHTML={{ __html: news.desc }} />
            </div>
          </div>
        </div>
        <div className="col-span-7 md:col-span-3 recent-news h-max">
          <div className="p-8">
            <div className="title">
              <h1 className="text-black font-bold text-2xl">{recentNewsTitle}</h1>
            </div>
            <div className="list-recent mt-8">
              {another_news.map((item) => (
                <Link key={item.id} href={`${newsDetailLink}/${item.id}`} className="recent flex flex-col gap-4">
                  <img src={item.img} alt={item.title} />
                  <h3 className="text-black text-base font-semibold mb-4">{item.title}</h3>
                </Link>
              ))}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
