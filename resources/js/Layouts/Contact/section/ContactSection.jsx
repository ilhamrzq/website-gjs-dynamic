import { useState, useRef, useEffect } from 'react';
import emailjs from '@emailjs/browser';
import '../contact.css';

export default function ContactSection({ lang_code }) {
  const [formSubmitted, setFormSubmitted] = useState(false);
  const [formError, setFormError] = useState(false);
  const [showRecaptchaError, setShowRecaptchaError] = useState(false);
  const formRef = useRef(null);

  // Load reCAPTCHA script
  useEffect(() => {
    const loadRecaptcha = () => {
      if (!document.querySelector('script[src*="recaptcha"]')) {
        const script = document.createElement('script');
        script.src = 'https://www.google.com/recaptcha/api.js';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
      }
    };

    loadRecaptcha();
  }, []);

  const sendEmail = (e) => {
    e.preventDefault();

    // Check if grecaptcha is loaded
    if (typeof window.grecaptcha === 'undefined') {
      alert('reCAPTCHA is not loaded yet. Please try again.');
      return;
    }

    const response = window.grecaptcha.getResponse();
    if (!response) {
      setShowRecaptchaError(true);
      alert('Please check the recaptcha');
      return;
    }

    setShowRecaptchaError(false);

    emailjs.sendForm('service_i35tv58', 'template_3wmdkt1', formRef.current, 'nTI89G0pdhgmilHtQ').then(
      (result) => {
        console.log('SUCCESS!', result.text);
        resetForm();
        setFormSubmitted(true);
        alert('Your form has been successfully submitted');
      },
      (error) => {
        console.log('FAILED...', error.text);
        setFormError(true);
      }
    );
  };

  const resetForm = () => {
    setFormSubmitted(false);
    setFormError(false);
    formRef.current.reset();

    // Check if grecaptcha is loaded before trying to reset
    if (typeof window.grecaptcha !== 'undefined') {
      window.grecaptcha.reset();
    }
  };

  return (
    <div className="content-contact">
      <div className="header-contact my-14 w-11/12 mx-auto">
        <div className="flex flex-row justify-between">
          <div className="back-navigation flex flex-row items-center gap-4">
            <p className="font-bold text-center text-[28px] text-black">{lang_code === 'id' ? 'Kontak' : 'Contact'}</p>
          </div>
        </div>
      </div>
      <div className="content-contact">
        <div className="grid grid-flow-row md:grid-flow-col md:grid-cols-2 gap-10 md:gap-0">
          <div className="col-span-1">
            <div className="flex flex-col">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d556.5429732935157!2d106.83147759437547!3d-6.185922410782305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f50056553ecd%3A0x2cb74d5faad32cba!2sGedung%20i-Hub!5e0!3m2!1sid!2sid!4v1749713705530!5m2!1sid!2sid"
                className="w-[100%] md:w-11/12 mx-auto"
                height="380"
                style={{ border: 0 }}
                allowFullScreen=""
                referrerPolicy="no-referrer-when-downgrade"
              ></iframe>
              <h5 className="text-subtitle my-10 w-11/12 mx-auto">Gedung i-Hub Lantai 3A, Jalan KH. Wahid Hasyim No. 38, Jakarta Pusat 10340, Indonesia</h5>
              <div className="list-contact w-11/12 mx-auto">
                <div className="flex flex-col gap-4">
                  <div className="contact flex flex-row gap-4 items-center">
                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11 5H10V0H0V14.5V16H14V8C14 6.34 12.66 5 11 5ZM2 2H8V5H2V2ZM6 13H2V8H6V13ZM8 13C7.45 13 7 12.55 7 12C7 11.45 7.45 11 8 11C8.55 11 9 11.45 9 12C9 12.55 8.55 13 8 13ZM8 10C7.45 10 7 9.55 7 9C7 8.45 7.45 8 8 8C8.55 8 9 8.45 9 9C9 9.55 8.55 10 8 10ZM11 13C10.45 13 10 12.55 10 12C10 11.45 10.45 11 11 11C11.55 11 12 11.45 12 12C12 12.55 11.55 13 11 13ZM11 10C10.45 10 10 9.55 10 9C10 8.45 10.45 8 11 8C11.55 8 12 8.45 12 9C12 9.55 11.55 10 11 10Z"
                        fill="#21243A"
                        fillOpacity="0.6"
                      />
                    </svg>
                    <p className="text-subtitle">+62 21 3983 6667 (Office hours only)</p>
                  </div>
                  <div className="contact flex flex-row gap-4 items-center">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M3.54 2C3.6 2.89 3.75 3.76 3.99 4.59L2.79 5.79C2.38 4.59 2.12 3.32 2.03 2H3.54ZM13.4 14.02C14.25 14.26 15.12 14.41 16 14.47V15.96C14.68 15.87 13.41 15.61 12.2 15.21L13.4 14.02ZM4.5 0H1C0.45 0 0 0.45 0 1C0 10.39 7.61 18 17 18C17.55 18 18 17.55 18 17V13.51C18 12.96 17.55 12.51 17 12.51C15.76 12.51 14.55 12.31 13.43 11.94C13.33 11.9 13.22 11.89 13.12 11.89C12.86 11.89 12.61 11.99 12.41 12.18L10.21 14.38C7.38 12.93 5.06 10.62 3.62 7.79L5.82 5.59C6.1 5.31 6.18 4.92 6.07 4.57C5.7 3.45 5.5 2.25 5.5 1C5.5 0.45 5.05 0 4.5 0Z"
                        fill="#21243A"
                        fillOpacity="0.6"
                      />
                    </svg>
                    <p className="text-subtitle">+62 21 391 1456 (Office hours only)</p>
                  </div>
                  <div className="contact flex flex-row gap-4 items-center">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M17.0498 2.91C15.1798 1.03 12.6898 0 10.0398 0C4.5798 0 0.129805 4.45 0.129805 9.91C0.129805 11.66 0.589805 13.36 1.4498 14.86L0.0498047 20L5.2998 18.62C6.7498 19.41 8.3798 19.83 10.0398 19.83C15.4998 19.83 19.9498 15.38 19.9498 9.92C19.9498 7.27 18.9198 4.78 17.0498 2.91ZM10.0398 18.15C8.5598 18.15 7.1098 17.75 5.8398 17L5.5398 16.82L2.4198 17.64L3.2498 14.6L3.0498 14.29C2.2298 12.98 1.7898 11.46 1.7898 9.91C1.7898 5.37 5.4898 1.67 10.0298 1.67C12.2298 1.67 14.2998 2.53 15.8498 4.09C17.4098 5.65 18.2598 7.72 18.2598 9.92C18.2798 14.46 14.5798 18.15 10.0398 18.15ZM14.5598 11.99C14.3098 11.87 13.0898 11.27 12.8698 11.18C12.6398 11.1 12.4798 11.06 12.3098 11.3C12.1398 11.55 11.6698 12.11 11.5298 12.27C11.3898 12.44 11.2398 12.46 10.9898 12.33C10.7398 12.21 9.9398 11.94 8.9998 11.1C8.2598 10.44 7.7698 9.63 7.6198 9.38C7.4798 9.13 7.5998 9 7.7298 8.87C7.8398 8.76 7.9798 8.58 8.0998 8.44C8.2198 8.3 8.2698 8.19 8.3498 8.03C8.4298 7.86 8.3898 7.72 8.3298 7.6C8.2698 7.48 7.7698 6.26 7.5698 5.76C7.3698 5.28 7.1598 5.34 7.0098 5.33C6.8598 5.33 6.6998 5.33 6.5298 5.33C6.3598 5.33 6.0998 5.39 5.8698 5.64C5.6498 5.89 5.0098 6.49 5.0098 7.71C5.0098 8.93 5.8998 10.11 6.0198 10.27C6.1398 10.44 7.7698 12.94 10.2498 14.01C10.8398 14.27 11.2998 14.42 11.6598 14.53C12.2498 14.72 12.7898 14.69 13.2198 14.63C13.6998 14.56 14.6898 14.03 14.8898 13.45C15.0998 12.87 15.0998 12.38 15.0298 12.27C14.9598 12.16 14.8098 12.11 14.5598 11.99Z"
                        fill="#21243A"
                        fillOpacity="0.6"
                      />
                    </svg>
                    <p className="text-subtitle">+62 8151 391 1456 (Chat only)</p>
                  </div>
                  <div className="contact flex flex-row gap-4 items-center">
                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M20 2C20 0.9 19.1 0 18 0H2C0.9 0 0 0.9 0 2V14C0 15.1 0.9 16 2 16H18C19.1 16 20 15.1 20 14V2ZM18 2L10 6.99L2 2H18ZM18 14H2V4L10 9L18 4V14Z" fill="#21243A" fillOpacity="0.6" />
                    </svg>
                    <p className="text-subtitle">marketing.gjs@mncgroup.com</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <form ref={formRef} onSubmit={sendEmail}>
            <div className="col-span-1 p-10 shadow-md rounded-md h-[100%]">
              <div className="title-form">
                <h1 className="title-form">Form</h1>
              </div>
              <div className="list-form my-10">
                <div className="form">
                  <label htmlFor="full_name" className="block">
                    {lang_code === 'id' ? 'Nama Lengkap' : 'Full Name'}
                  </label>
                  <input type="text" className="w-full" name="name" required />
                </div>
                <div className="form my-6">
                  <label htmlFor="full_name" className="block">
                    {lang_code === 'id' ? 'Subjek' : 'Subject'}
                  </label>
                  <input type="text" className="w-full" name="subject" required />
                </div>
                <div className="flex flex-row gap-6 my-6" style={{ display: 'none' }}>
                  <div className="form w-full">
                    <label htmlFor="full_name" className="block" style={{ display: 'none' }}>
                      = Email
                    </label>
                    <input type="text" className="w-full" name="email" style={{ display: 'none' }} />
                  </div>
                  <div className="form w-full">
                    <label htmlFor="full_name" className="block" style={{ display: 'none' }}>
                      {lang_code === 'id' ? 'Nomor Telepon' : 'Phone Number'}
                    </label>
                    <input type="text" className="w-full" name="phone" style={{ display: 'none' }} />
                  </div>
                </div>
                <div className="form my-6">
                  <label htmlFor="message" className="block">
                    {lang_code === 'id' ? 'Pesan' : 'Message'}
                  </label>
                  <textarea className="w-full" name="message" required />
                </div>
                <div className="form">
                  <div className="g-recaptcha w-full" data-sitekey="6LeuEK4mAAAAAJ56pJBGUIKquFqE3gKeWYeNQPy5"></div>
                </div>
                <div className="text-center">
                  <button type="submit" value="Send" className="button-submit__contact rounded-full text-white font-semibold text-xl w-32 h-32 mt-10 hover:transition hover:duration-150 hover:ease-in hover:scale-110">
                    Submit
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div className="modal rounded-2xl items-center flex flex-col justify-center hidden">
        <div className="correct-icon">
          <i className="fas fa-check"></i>
        </div>

        <h1 className="text-header">Your form has been successfully submitted</h1>
        <p className="text-subtitle">Your form will be answered as soon as possible.</p>
        <button className="text-button mt-10">Okay</button>
      </div>
    </div>
  );
}
