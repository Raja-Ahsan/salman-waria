import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const container = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.12, delayChildren: 0.2 },
  },
};

const item = {
  hidden: { opacity: 0, y: 24 },
  visible: { opacity: 1, y: 0 },
};

export function About() {
  return (
    <section id="about" className="section about" aria-labelledby="about-heading">
      <div className="container about__grid">
        <motion.div
          className="about__text-block"
          variants={container}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: '-80px' }}
        >
          <motion.p className="about__body" variants={item}>
            I&apos;m a global Entrepreneur and technology evangelist alongside a Visionary Pioneer
            for building impactful businesses. My focus spans AI, blockchain, and sustainable tech
            to create lasting value.
          </motion.p>
          <motion.a
            href="#ventures"
            className="about__read-more"
            variants={item}
            whileHover={{ x: 4 }}
          >
            Read More
          </motion.a>
        </motion.div>

        <motion.div
          className="about__media"
          initial={{ opacity: 0, x: 40 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true, margin: '-80px' }}
          transition={{ duration: 0.7, ease: [0.22, 1, 0.36, 1] }}
        >
          <img
            src={assets.aboutPodium}
            alt="Salman Waria speaking at ALTECH"
            width={600}
            height={400}
          />
        </motion.div>
      </div>
    </section>
  );
}
