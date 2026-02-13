import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

export function World2050() {
  return (
    <section id="world-2050" className="section world2050" aria-labelledby="world2050-heading">
      <div className="container world2050__grid">
        <motion.div
          className="world2050__media"
          initial={{ opacity: 0, x: -30 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <img
            src={assets.world2050}
            alt="World in 2050"
            width={400}
            height={480}
          />
        </motion.div>

        <div className="world2050__content">
          <motion.h2
            id="world2050-heading"
            className="world2050__title"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            WORLD. IN 2050.
          </motion.h2>
          <motion.p
            className="world2050__subtitle"
            initial={{ opacity: 0, y: 12 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: 0.05 }}
          >
            VISIONARY INSIGHTS FOR THE FUTURE.
          </motion.p>
          <motion.p
            className="world2050__body"
            initial={{ opacity: 0, y: 16 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: 0.1 }}
          >
            A vision for the future—exploring how technology, sustainability, and human
            collaboration will reshape our world. Join the conversation and help shape what comes
            next.
          </motion.p>
          <motion.div
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            transition={{ delay: 0.2 }}
          >
            <a href="#contact" className="world2050__cta">
              Get Started
            </a>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
