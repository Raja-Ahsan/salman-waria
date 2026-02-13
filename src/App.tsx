import { useState, useCallback } from 'react'
import { useVantaFog } from './hooks/useVantaFog'
import { assets } from './lib/assets'
import { Header } from './components/Header'
import { Hero } from './components/Hero'
import { About } from './components/About'
import { Ventures } from './components/Ventures'
import { WhatIDo } from './components/WhatIDo'
import { World2050 } from './components/World2050'
import { LatestPress } from './components/LatestPress'
import { Testimonials } from './components/Testimonials'
import { Contact } from './components/Contact'
import { Blog } from './components/Blog'
import { Brands } from './components/Brands'
import { Section3 } from './components/Section3'
import { Footer } from './components/Footer'
import './App.css'

function App() {
  const vantaRef = useVantaFog();
  const [mousePos, setMousePos] = useState({ x: -999, y: -999 });

  const handleBannerMouseMove = useCallback((e: React.MouseEvent<HTMLElement>) => {
    const rect = e.currentTarget.getBoundingClientRect();
    setMousePos({
      x: e.clientX - rect.left,
      y: e.clientY - rect.top,
    });
  }, []);

  const handleBannerMouseLeave = useCallback(() => {
    setMousePos({ x: -999, y: -999 });
  }, []);

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
          ref={vantaRef}
          className="banner-section__vanta"
          aria-hidden="true"
          style={
            {
              '--mouse-x': `${mousePos.x}px`,
              '--mouse-y': `${mousePos.y}px`,
            } as React.CSSProperties
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
        <About />
        <LatestPress />
        <Testimonials />
        <Contact />
        <Blog />
      </main>
      <Footer />
    </>
  )
}

export default App
