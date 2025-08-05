import { useState, useEffect, useMemo } from 'react';
import { Link } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';
import BackNavigation from '../../../components/BackNavigation';
import dataNews from '../../../data/news.json';

export default function NewsSection({ lang_code }) {
  const [search, setSearch] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('');
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 5;

  // Sort news data by id in descending order
  const data_news = useMemo(() => {
    const newsData = lang_code === 'id' ? dataNews.news_id : dataNews.news_en;
    return newsData.sort((a, b) => b.id - a.id);
  }, []);

  // Filter news based on search and category
  const searchNews = useMemo(() => {
    return data_news.filter((item) => {
      if (selectedCategory === '') {
        return item.title.toLowerCase().includes(search.toLowerCase());
      } else {
        return item.title.toLowerCase().includes(search.toLowerCase()) && item.category.toLowerCase().includes(selectedCategory.toLowerCase());
      }
    });
  }, [data_news, search, selectedCategory]);

  // Get unique categories
  const uniqueCategory = useMemo(() => {
    const categories = new Set();
    data_news.forEach((news) => {
      categories.add(news.category);
    });
    return Array.from(categories);
  }, [data_news]);

  // Paginate news
  const paginatedNews = useMemo(() => {
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return searchNews.slice(start, end);
  }, [searchNews, currentPage, itemsPerPage]);

  // Calculate total pages
  const totalPages = useMemo(() => {
    return Math.ceil(searchNews.length / itemsPerPage);
  }, [searchNews.length, itemsPerPage]);

  // Generate page numbers with dots
  const pageNumbers = useMemo(() => {
    const total = totalPages;
    const current = currentPage;
    const delta = 1;

    if (total <= 5) {
      return Array.from({ length: total }, (_, i) => i + 1);
    }

    const range = [];
    const rangeWithDots = [];
    let l, r;

    if (current <= 3) {
      l = 1;
      r = 3;
    } else if (current >= total - 2) {
      l = total - 2;
      r = total;
    } else {
      l = current - delta;
      r = current + delta;
    }

    for (let i = 1; i <= total; i++) {
      if (i === 1 || i === total || (i >= l && i <= r)) {
        range.push(i);
      }
    }

    let prev = null;
    for (let i of range) {
      if (prev !== null && i - prev > 1) {
        rangeWithDots.push('...');
      }
      rangeWithDots.push(i);
      prev = i;
    }

    return rangeWithDots;
  }, [totalPages, currentPage]);

  // Reset to first page when search results change
  useEffect(() => {
    setCurrentPage(1);
  }, [searchNews]);

  // Scroll up each time currentPage changes
  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, [currentPage]);

  const goToPage = (page) => {
    setCurrentPage(page);
  };

  const nextPage = () => {
    if (currentPage < totalPages) {
      setCurrentPage(currentPage + 1);
    }
  };

  const prevPage = () => {
    if (currentPage > 1) {
      setCurrentPage(currentPage - 1);
    }
  };

  const handleSearchChange = (e) => {
    setSearch(e.target.value);
  };

  const handleCategoryChange = (e) => {
    setSelectedCategory(e.target.value);
  };

  const { url } = usePage();

  const backPath = url.startsWith('/en') ? '/en' : '/id';

  return (
    <>
      <div className="content-newspage mt-10 w-11/12 md:w-10/12 mx-auto">
        <div className="header-newspage">
          <div className="flex flex-col md:flex-row justify-between">
            <BackNavigation backTo={lang_code === 'id' ? 'Berita' : 'News'} hrefTo={backPath} />
            <div className="flex flex-col md:flex-row gap-3 mt-4">
              <div className="bg-white border-black">
                <div className="flex">
                  <div className="z-10 text-center px-3 py-2">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="32" height="32" rx="16" fill="url(#paint0_linear_522_9748)" />
                      <g clipPath="url(#clip0_522_9748)">
                        <path
                          d="M19.1067 11.0134L20.9933 12.9L19.1067 14.7867L17.22 12.9L19.1067 11.0134ZM14 11.3334V14H11.3333V11.3334H14ZM20.6667 18V20.6667H18V18H20.6667ZM14 18V20.6667H11.3333V18H14ZM19.1067 9.12671L15.3333 12.8934L19.1067 16.6667L22.88 12.8934L19.1067 9.12671ZM15.3333 10H10V15.3334H15.3333V10ZM22 16.6667H16.6667V22H22V16.6667ZM15.3333 16.6667H10V22H15.3333V16.6667Z"
                          fill="white"
                        />
                      </g>
                      <defs>
                        <linearGradient id="paint0_linear_522_9748" x1="32" y1="0" x2="-2.73313" y2="3.30867" gradientUnits="userSpaceOnUse">
                          <stop stopColor="#445487" />
                          <stop offset="1" stopColor="#233672" />
                        </linearGradient>
                        <clipPath id="clip0_522_9748">
                          <rect width="16" height="16" fill="white" transform="translate(8 8)" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <select value={selectedCategory} onChange={handleCategoryChange} className="w-full -ml-14 pl-14 pr-24 py-2 rounded-lg border-2 border-gray-200 outline-none bg-white h-[48px] font-medium text-sm text-[#21243A]">
                    <option value="">{lang_code === 'id' ? 'Semua Kategori' : 'All Category'}</option>
                    {uniqueCategory.map((kategori) => (
                      <option key={kategori} value={kategori}>
                        {kategori}
                      </option>
                    ))}
                  </select>
                </div>
              </div>
              <div className="search">
                <div className="flex">
                  <div className="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                    <span className="material-symbols-outlined text-base"> search </span>
                  </div>
                  <input
                    type="text"
                    value={search}
                    onChange={handleSearchChange}
                    className="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none h-[48px]"
                    placeholder={lang_code === 'id' ? 'Cari Berita ...' : 'Search News ...'}
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="news">
          <div className="news-content mt-10 grid grid-flow-row w-full gap-8">
            {searchNews.length === 0 ? (
              <div className="text-center mt-10">
                <p className="text-2xl font-semibold flex gap-4 items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                    <path
                      fill="currentColor"
                      d="M10 .188A9.812 9.812 0 0 0 .187 10A9.812 9.812 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.824 1.824 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188zM10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16zM4.937 7.469a5.446 5.446 0 0 0-.812 2.875a5.46 5.46 0 0 0 5.469 5.469a5.516 5.516 0 0 0 3.156-1a7.166 7.166 0 0 1-.75.03a7.045 7.045 0 0 1-7.063-7.062c0-.104-.005-.208 0-.312z"
                    />
                  </svg>
                  {lang_code === 'id' ? 'Berita Tidak Ditemukan' : 'News Not Found'}
                </p>
              </div>
            ) : (
              <div>
                {paginatedNews.map((item_news) => {
                  const newsDetail = lang_code === 'id' ? { to: `/id/berita/${item_news.id}`, label: 'Selengkapnya' } : { to: `/en/news/${item_news.id}`, label: 'Read More' };

                  return (
                    <div key={item_news.id} className="card shadow-2xl rounded-2xl grid md:grid-cols-3 my-4">
                      <div className="news-content__image col-span-3 md:col-span-1">
                        <img
                          src={item_news.img}
                          className="rounded-2xl w-full h-[200px] md:h-[350px] object-cover"
                          alt={item_news.title}
                        />
                      </div>
                      <div className="news-content__desc px-3 py-8 flex flex-col justify-between items-start col-span-2">
                        <p className="px-4 py-[2px] mb-4 opacity-60 rounded-[4px] bg-gray-200">
                          {item_news.category} | {item_news.date}
                        </p>
                        <h3 className="mb-2 font-semibold text-2xl text-primary">{item_news.title}</h3>
                        <p className="mb-8 text-subtitle text-justify mt-4">{item_news.thumbnail_desc}</p>
                        <Link href={newsDetail.to} className="button-secondary">
                          {newsDetail.label}
                        </Link>
                      </div>
                    </div>
                  );
                })}
              </div>
            )}
          </div>
        </div>
      </div>
      <div className="flex justify-center flex-wrap gap-2 mt-8 items-center">
        <button onClick={prevPage} disabled={currentPage === 1} className="button-secondary disabled:opacity-50 mr-2">
          <span className="material-symbols-outlined text-xl mt-2"> arrow_back </span>
        </button>
        {pageNumbers.map((page, index) => (
          <button
            key={index}
            onClick={() => typeof page === 'number' && goToPage(page)}
            className={`px-3 py-1 rounded ${currentPage === page ? 'bg-primary-blue-100 text-white font-semibold' : 'text-black'} ${typeof page !== 'number' ? 'cursor-default' : ''}`}
            disabled={page === '...'}
          >
            {page}
          </button>
        ))}
        <button onClick={nextPage} disabled={currentPage === totalPages} className="button-secondary disabled:opacity-50 ml-2">
          <span className="material-symbols-outlined text-xl mt-2"> arrow_forward </span>
        </button>
      </div>
    </>
  );
}
