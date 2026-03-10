import { useState, useCallback, useEffect } from 'react'
import { Routes, Route, useLocation } from 'react-router-dom'
import { assets } from './lib/assets'
import { Header } from './components/Header'
import { Hero } from './components/Hero'
import { Ventures } from './components/Ventures'
import { WhatIDo } from './components/WhatIDo'
import { World2050 } from './components/World2050'
import { LatestPress } from './components/LatestPress'
// import { Testimonials } from './components/Testimonials'
import { Contact } from './components/Contact'
import { Blog } from './components/Blog'
import { Brands } from './components/Brands'
import { Section3 } from './components/Section3'
import { Footer } from './components/Footer'
import { Layout } from './components/Layout'
import AboutPage from './innerpages/aboutpage'
import BlogsDetails from './innerpages/blogsdetails'
import BookDetails from './innerpages/bookdetails'
import DigitalAmericanAgency from './ventures/digital-american-agency'
import LogicWorks from './ventures/logic-works'
import LogicWorksDubai from './ventures/logic-works-dubai'
import LogicMediaHouse from './ventures/logic-media-house'
import './App.css'
import ContactPage from './innerpages/contact'
import DigitalTransformationTips from './blogs/digital-transformation-tips'


function ScrollToTop() {
  const { pathname, hash } = useLocation();
  useEffect(() => {
    if (pathname === '/' && hash === '#contact') {
      const el = document.getElementById('contact');
      if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
      window.scrollTo(0, 0);
    }
  }, [pathname, hash]);
  return null;
}

function HomePage() {
  const [mousePos, setMousePos] = useState(() =>
    typeof window !== 'undefined'
      ? { x: window.innerWidth / 2, y: window.innerHeight / 2 }
      : { x: 0, y: 0 }
  )

  const handleBannerMouseMove = useCallback((e: React.MouseEvent<HTMLElement>) => {
    const rect = e.currentTarget.getBoundingClientRect()
    setMousePos({ x: e.clientX - rect.left, y: e.clientY - rect.top })
  }, [])

  const handleBannerMouseLeave = useCallback((e: React.MouseEvent<HTMLElement>) => {
    const rect = e.currentTarget.getBoundingClientRect()
    setMousePos({ x: rect.width / 2, y: rect.height / 2 })
  }, [])

  return (
    <>
      <section
        className="banner-section"
        id="home"
        aria-label="Introduction"
        onMouseMove={handleBannerMouseMove}
        onMouseLeave={handleBannerMouseLeave}
      >
        <div
          className="banner-section__bg"
          style={{ backgroundImage: `url(${assets.bannerImage})` }}
          role="img"
          aria-hidden="true"
        />
        <div
          className="banner-section__circle"
          aria-hidden="true"
          style={
            { '--mouse-x': `${mousePos.x}px`, '--mouse-y': `${mousePos.y}px` } as React.CSSProperties
          }
        />
        <div className="banner-section__overlay" aria-hidden="true" />
        <Header />
        <Hero />
      </section>
      <main>
        <Brands />
        <Section3 />
        <Ventures />
        <WhatIDo />
        <World2050 />
        <LatestPress />
        {/* <Testimonials /> */}
        <Contact />
        <Blog />
      </main>
      <Footer />
    </>
  )
}

function App() {
  return (
    <>
      <ScrollToTop />
      <Routes>
      <Route path="/" element={<HomePage />} />
      <Route element={<Layout />}>
        <Route path="about" element={<AboutPage />} />
        <Route path="blogsdetails" element={<BlogsDetails />} />
          <Route path="bookdetails" element={<BookDetails />} />
          <Route path="digitalamericanagency" element={<DigitalAmericanAgency />} />
          <Route path="logicworks" element={<LogicWorks />} />
          <Route path="logicworksdubai" element={<LogicWorksDubai />} />
          <Route path="logicmediahouse" element={<LogicMediaHouse />} />
        
          <Route path="contactpage" element={<ContactPage />} />
          {/* Blogs Routes */}
          <Route path="digitaltransformationtips" element={<DigitalTransformationTips />} />
      </Route>
    </Routes>
    </>
  );
}

export default App;
