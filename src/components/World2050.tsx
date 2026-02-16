import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

export function World2050() {
  return (
    <section id="world-2050" className="world2050" aria-labelledby="world2050-heading">
      <div className="container world2050__grid">
        <motion.div
          className="world2050__media"
          initial={{ opacity: 0, x: -30 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <img
            src={assets.image2050}
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
            WORLD, IN 2050
          </motion.h2>
          <motion.p
            className="world2050__subtitle"
            initial={{ opacity: 0, y: 12 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: 0.05 }}
          >
            THE FUTURE UNVEILED
          </motion.p>
          <motion.p
            className="world2050__body"
            initial={{ opacity: 0, y: 16 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: 0.1 }}
          >
            World In 2050: The Future Unveiled Takes You On A Gripping Journey Into The Next Three
            Decades, Where Artificial Superintelligence, Quantum Computing, And Genetic Engineering
            Redefine The Very Fabric Of Civilization.
          </motion.p>
          <motion.div
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            transition={{ delay: 0.2 }}
          >
            <a href="#contact" className="world2050__cta">
              Get 1 Chapter Copy
            </a>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
