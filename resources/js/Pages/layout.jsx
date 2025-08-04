import React from "react";
import { Toaster } from "react-hot-toast";
import '../assets/css/index.css';
import ScrollToTop from '../components/ScrollToTop';

const RootLayout = ({ children }) => {
    return (
        <>
            <Toaster
                position="top-right"
                toastOptions={{
                    duration: 3000,
                    removeDelay: 1000,
                }}
            />
            {children}
            <ScrollToTop />
        </>
    );
};

export default RootLayout;
