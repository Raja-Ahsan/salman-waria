import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

export function LatestPress() {
  return (
    <section id="press" className="section container press" aria-labelledby="press-heading">
      <div className="container press__grid">
        <div className="press__content">
          <motion.h2
            id="press-heading"
            className="press__title"
            initial={{ opacity: 0, x: -20 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
          >
            LATEST PRESS
          </motion.h2>
          <p className="press__headline">
            Launch Of Al-Powered Mobile Apps You Can Link To Articles Like Press Releases About
            Logic Works And Yourself.
          </p>
          <motion.a
            href="#blog"
            className="press__link"
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            whileHover={{ x: 8 }}
          >
            Learn More
          </motion.a>
        </div>

        <div className="press__logo-wrap" aria-hidden="true">
          <img
            src={assets.section7Logo}
            alt=""
            className="press__logo"
            width={160}
            height={160}
            onError={(e) => {
              (e.target as HTMLImageElement).src = assets.logo;
            }}
          />
        </div>

        <motion.div
          className="press__media"
          initial={{ opacity: 0, scale: 0.98 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <img
            src={assets.aboutPhoto}
            alt="Salman Waria"
            width={600}
            height={400}
            onError={(e) => {
              const el = e.target as HTMLImageElement;
              el.src = assets.pressAlt;
            }}
          />
        </motion.div>
      </div>
    </section>
  );
}
