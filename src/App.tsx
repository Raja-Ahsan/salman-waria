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
import { Footer } from './components/Footer'
import './App.css'

function App() {
  return (
    <>
      <section className="banner-section" id="home" aria-label="Introduction">
        <div
          className="banner-section__bg"
          style={{ backgroundImage: `url(${assets.bannerImage})` }}
          role="img"
          aria-hidden="true"
        />
        <div className="banner-section__overlay" aria-hidden="true" />
        <Header />
        <Hero />
      </section>
      <main>
        <About />
        <Ventures />
        <WhatIDo />
        <World2050 />
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
