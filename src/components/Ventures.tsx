import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const VENTURES = [
  { title: 'AI IN HEALTHCARE', description: 'Intelligent solutions for the future of healthcare.' },
  { title: 'FINTECH SOLUTIONS', description: 'Innovative financial technology and digital banking.' },
  { title: 'EDTECH INNOVATIONS', description: 'Transforming education through technology.' },
  { title: 'REAL ESTATE TECH', description: 'PropTech and smart real estate solutions.' },
];

const container = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.08, delayChildren: 0.2 },
  },
};

const cardItem = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0 },
};

export function Ventures() {
  return (
    <section id="ventures" className="section ventures" aria-labelledby="ventures-heading">
      <div className="container ventures__grid">
        <div className="ventures__col">
          <motion.h2
            id="ventures-heading"
            className="ventures__title"
            initial={{ opacity: 0, x: -24 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
          >
            VENTURES
          </motion.h2>
          <motion.ul
            className="ventures__list"
            variants={container}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true, margin: '-60px' }}
          >
            {VENTURES.map((v) => (
              <motion.li key={v.title} variants={cardItem}>
                <a href="#contact" className="ventures__card">
                  <div>
                    <h3 className="ventures__card-title">{v.title}</h3>
                    <p className="ventures__card-desc">{v.description}</p>
                  </div>
                  <span className="ventures__card-arrow" aria-hidden>→</span>
                </a>
              </motion.li>
            ))}
          </motion.ul>
        </div>

        <motion.div
          className="ventures__media"
          initial={{ opacity: 0, scale: 0.98 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
        >
          <img
            src={assets.ventures}
            alt="Salman Waria"
            width={560}
            height={400}
          />
        </motion.div>
      </div>
    </section>
  );
}
