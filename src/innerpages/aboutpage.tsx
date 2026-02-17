import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import { assets } from '../lib/assets'

const container = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.1, delayChildren: 0.2 },
  },
}

const item = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0 },
}

function AboutPage() {
  return (
    <div className="inner-page inner-page--about">
      <section className="inner-page__hero" aria-label="About page hero">
        <div className="container inner-page__hero-inner">
          <motion.div
            className="inner-page__hero-content"
            variants={container}
            initial="hidden"
            animate="visible"
          >
            <motion.span className="inner-page__hero-label" variants={item}>
              About
            </motion.span>
            <motion.h1 className="inner-page__hero-title" variants={item}>
              Salman Waria
            </motion.h1>
            <motion.p className="inner-page__hero-subtitle" variants={item}>
              Global Entrepreneur & Technology Evangelist
            </motion.p>
          </motion.div>
        </div>
      </section>

      <main className="inner-page__main">
        <section className="inner-page__section inner-page__section--about" aria-labelledby="about-content-heading">
          <div className="container">
            <div className="inner-page__grid inner-page__grid--about">
              <motion.div
                className="inner-page__text-block"
                variants={container}
                initial="hidden"
                whileInView="visible"
                viewport={{ once: true, margin: '-60px' }}
              >
                <motion.h2 id="about-content-heading" className="inner-page__heading" variants={item}>
                  ABOUT
                </motion.h2>
                <motion.p className="inner-page__body" variants={item}>
                  I&apos;m a global Entrepreneur and technology evangelist alongside a Visionary Pioneer
                  for building impactful businesses. My focus spans AI, blockchain, and sustainable tech
                  to create lasting value.
                </motion.p>
                <motion.p className="inner-page__body" variants={item}>
                  Over the years, I have founded and led multiple digital ventures across different regions,
                  helping brands grow through innovation, creativity, and smart digital solutions.
                </motion.p>
                <motion.div variants={item}>
                  <Link to="/#ventures" className="inner-page__btn inner-page__btn--primary">
                    Explore Ventures
                  </Link>
                </motion.div>
              </motion.div>

              <motion.div
                className="inner-page__media-block"
                initial={{ opacity: 0, x: 40 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true, margin: '-60px' }}
                transition={{ duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
              >
                <div className="inner-page__media-wrap">
                  <img
                    src={assets.aboutPhoto}
                    alt="Salman Waria"
                    width={600}
                    height={400}
                    onError={(e) => {
                      (e.target as HTMLImageElement).src = assets.logo
                    }}
                  />
                </div>
                <div className="inner-page__logo-badge" aria-hidden="true">
                  <img
                    src={assets.section7Logo}
                    alt=""
                    width={120}
                    height={120}
                    onError={(e) => {
                      (e.target as HTMLImageElement).src = assets.logo
                    }}
                  />
                </div>
              </motion.div>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}

export default AboutPage
