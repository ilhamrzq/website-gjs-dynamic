import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import career from '../../../../../../data/career.json';
import '../careerdetail.css';

export default function CareerDetailSection({ lang_code }) {
  const [showModal, setShowModal] = useState(false);
  const [items, setItems] = useState(null);
  const { id } = useParams();

  const data_career = career.career;

  useEffect(() => {
    const item = data_career.find((item) => item.id == id);
    setItems(item);
  }, [id]);

  const showModalHandler = () => {
    setShowModal(!showModal);
  };

  if (!items) {
    return <div>Loading...</div>;
  }

  return (
    <div className="career">
      <div className="header-career pt-[72px] pb-[28px] w-10/12 mx-auto">
        <Link to="/id/tentang/karir" className="flex flex-row gap-4 items-center">
          <div className="arrow w-[48px] h-[48px] bg-neutral-white-100 p-4 rounded-[32px]">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 7H3.83L9.42 1.41L8 0L0 8L8 16L9.41 14.59L3.83 9H16V7Z" fill="#233672" />
            </svg>
          </div>
          <h3 className="text-[28px] font-bold leading-[150%] text-center color-neutral-black-100">{lang_code === 'id' ? 'Karir' : 'Career'}</h3>
        </Link>
        <div className="search-form w-full md:w-6/12 mx-auto mt-[28px]">
          <h1 className="text-[28px] md:text-[52px] leading-120 font-bold color-neutral-black-100 text-center">{items.job_position}</h1>
        </div>
      </div>
      {/* End Navigation */}

      {/* Modal */}
      {showModal && (
        <div aria-hidden="true" className="fixed top-0 mt-8 left-0 right-0 z-50 w-[900px] mx-auto p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal">
          <div className="relative w-full h-full md:h-auto">
            {/* Modal content */}
            <div className="relative bg-white rounded-lg shadow">
              {/* Modal header */}
              <div className="flex items-start justify-between p-4 border-b rounded-t">
                <h3 className="text-base font-bold leading-[160%] color-neutral-black-100">GJS Video Profile</h3>
                <button
                  onClick={showModalHandler}
                  type="button"
                  className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                  <svg aria-hidden="true" className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fillRule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clipRule="evenodd"
                    ></path>
                  </svg>
                  <span className="sr-only">Close modal</span>
                </button>
              </div>
              {/* Modal body */}
              <div className="modal-container">
                <div className="modal-content">
                  <div className="p-6 space-y-6">
                    <form className="w-full">
                      <div className="flex flex-wrap -mx-3 mb-6">
                        <div className="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" htmlFor="grid-first-name">
                            Name
                          </label>
                          <input
                            className="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name"
                            type="text"
                            placeholder="Jane"
                          />
                          <p className="text-red-500 text-xs italic">Please fill out this field.</p>
                        </div>
                        <div className="w-full md:w-1/2 px-3">
                          <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" htmlFor="grid-last-name">
                            Email
                          </label>
                          <input
                            className="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name"
                            type="text"
                            placeholder="Doe"
                          />
                        </div>
                      </div>
                      <div className="flex flex-wrap -mx-3 mb-6">
                        <div className="w-full px-3">
                          <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" htmlFor="grid-phone">
                            Phone
                          </label>
                          <input
                            className="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-phone"
                            type="text"
                            placeholder="09669771232"
                          />
                          <p className="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                        </div>
                      </div>
                      <div className="flex flex-wrap -mx-3 mb-6">
                        <div className="w-full px-3">
                          <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" htmlFor="grid-phone-2">
                            Phone
                          </label>
                          <input
                            className="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-phone-2"
                            type="text"
                            placeholder="09669771232"
                          />
                          <p className="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div className="backdrop"></div>
              </div>
              {/* Modal footer */}
            </div>
          </div>
        </div>
      )}

      {/* Content */}
      <div className="grid grid-flow-row md:grid-flow-col md:grid-cols-12 w-11/12 mx-auto md:gap-[58px]">
        <div className="col-span-12 md:col-span-4">
          <div className="card rounded-[10px]">
            <div className="head bg-primary-blue-100 rounded-t-[10px]">
              <h1 className="text-[20px] leading-160 font-bold color-neutral-white-100 px-6 py-4">Job Information</h1>
            </div>
            <div className="list-recruitment p-6 space-y-2 bg-primary-blue-10 rounded-b-[10px]">
              <div className="list">
                <h3 className="text-base leading-160 color-neutral-black-100 font-semibold">Education Level</h3>
                <h3 className="color-neutral-black-60 leading-160 font-normal">{items.education_level}</h3>
              </div>
              <div className="list">
                <h3 className="text-base leading-160 color-neutral-black-100 font-semibold">Job Level</h3>
                <h3 className="color-neutral-black-60 leading-160 font-normal">{items.job_level}</h3>
              </div>
              <div className="list">
                <h3 className="text-base leading-160 color-neutral-black-100 font-semibold">Location</h3>
                <h3 className="color-neutral-black-60 leading-160 font-normal">{items.location}</h3>
              </div>
              <div className="list">
                <h3 className="text-base leading-160 color-neutral-black-100 font-semibold">Working Experience</h3>
                <h3 className="color-neutral-black-60 leading-160 font-normal">{items.experience}</h3>
              </div>
            </div>
          </div>
        </div>
        <div className="col-span-8 md:col-span-8 mt-[58px] md:mt-[0]">
          <div className="flex flex-col gap-6">
            {/* Title Responsibilities */}
            <div className="responsibilities">
              <div className="flex flex-row gap-3 items-center">
                <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M14.334 4.99992V2.66659H9.66732V4.99992H14.334ZM2.66732 7.33325V20.1666H21.334V7.33325H2.66732ZM21.334 4.99992C22.629 4.99992 23.6673 6.03825 23.6673 7.33325V20.1666C23.6673 21.4616 22.629 22.4999 21.334 22.4999H2.66732C1.37232 22.4999 0.333984 21.4616 0.333984 20.1666L0.345651 7.33325C0.345651 6.03825 1.37232 4.99992 2.66732 4.99992H7.33398V2.66659C7.33398 1.37159 8.37232 0.333252 9.66732 0.333252H14.334C15.629 0.333252 16.6673 1.37159 16.6673 2.66659V4.99992H21.334Z"
                    fill="#233672"
                  />
                </svg>
                <h1 className="text-[20px] font-bold leading-160">Job Description</h1>
              </div>
              <div className="list my-3 color-neutral-black-60 font-normal leading-160 text-base">
                <ul className="list-disc list-inside">{items.job_desc && items.job_desc.map((desc, index) => <li key={index}>{desc}</li>)}</ul>
              </div>
            </div>
            {/* Title Responsibilities */}

            {/* Requirement */}
            <div className="requirement">
              <div className="flex flex-row gap-3 items-center">
                <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M14.334 4.99992V2.66659H9.66732V4.99992H14.334ZM2.66732 7.33325V20.1666H21.334V7.33325H2.66732ZM21.334 4.99992C22.629 4.99992 23.6673 6.03825 23.6673 7.33325V20.1666C23.6673 21.4616 22.629 22.4999 21.334 22.4999H2.66732C1.37232 22.4999 0.333984 21.4616 0.333984 20.1666L0.345651 7.33325C0.345651 6.03825 1.37232 4.99992 2.66732 4.99992H7.33398V2.66659C7.33398 1.37159 8.37232 0.333252 9.66732 0.333252H14.334C15.629 0.333252 16.6673 1.37159 16.6673 2.66659V4.99992H21.334Z"
                    fill="#233672"
                  />
                </svg>
                <h1 className="text-[20px] font-bold leading-160">Job Requirements</h1>
              </div>
              <div className="list my-3 color-neutral-black-60 font-normal leading-160 text-base">
                <ul className="list-disc list-inside">{items.job_req && items.job_req.map((req, index) => <li key={index}>{req}</li>)}</ul>
              </div>
            </div>
            {/* Requirement */}
          </div>
          {/* Send Email */}
          <div className="flex flex-col md:flex-row justify-between px-6 py-3 bg-primary-blue-10 rounded-[8px] items-start md:items-center mt-10 gap-4 md:gap-0">
            <div className="desc w-8/12">
              <h6 className="text-base color-primary-blue-100 leading-160">
                Send an email to <strong> hr.gjs@mncgroup.com </strong> to apply this position. <strong> Subject Building Manager - Name. </strong>
              </h6>
            </div>
            <div>
              <button className="bg-primary-gradient-button px-3 py-4 font-medium text-base leading-160 text-center color-neutral-white-100 rounded-md">Apply Now</button>
            </div>
          </div>
          {/* Send Email */}
        </div>
      </div>
    </div>
  );
}
