import { motion } from 'framer-motion';

export function Hero() {
  return (
    <div className="container hero">
      <div className="hero__content">
        <motion.h1
          className="hero__name"
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.2, duration: 0.6 }}
        >
          Salman Waria
        </motion.h1>
        <motion.p
          className="hero__title"
          initial={{ opacity: 0, y: 24 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.35, duration: 0.6 }}
        >
          DIGITAL ENTREPRENEUR{' '}
          <a href="#what-i-do" className="hero__title-link">
            &amp; TECH INNOVATOR
          </a>
        </motion.p>
        <motion.div
          initial={{ opacity: 0, y: 24 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.5, duration: 0.6 }}
        >
          <a href="#contact" className="hero__cta">
            Work With Me
          </a>
        </motion.div>
      </div>
    </div>
  );
}
