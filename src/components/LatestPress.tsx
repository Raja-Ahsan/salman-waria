import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const PRESS_LOGO_NAMES = ['Forbes', 'Entrepreneur', 'TechCrunch', 'Bloomberg'];

export function LatestPress() {
  return (
    <section id="press" className="section press" aria-labelledby="press-heading">
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
            Decoding the future: Salman Waria&apos;s Visionary Approach to AI & Blockchain.
          </p>
          <motion.a
            href="#blog"
            className="press__link"
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            whileHover={{ x: 8 }}
          >
            Read Article
          </motion.a>
          <ul className="press__logos" aria-label="As featured in">
            {PRESS_LOGO_NAMES.map((name) => (
              <li key={name}>
                <span className="press__logo-name">{name}</span>
              </li>
            ))}
          </ul>
        </div>

        <motion.div
          className="press__media"
          initial={{ opacity: 0, scale: 0.98 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <img
            src={assets.press}
            alt="Salman Waria"
            width={600}
            height={400}
            onError={(e) => {
              const el = e.target as HTMLImageElement;
              el.src = assets.pressAlt;
            }}
          />
          <span className="press__badge" aria-hidden />
        </motion.div>
      </div>
    </section>
  );
}
