import { motion } from 'framer-motion';
import { Link } from 'react-router-dom';
import { assets } from '../lib/assets';

export function Section3() {
  return (
    <section id="about" className="section section3"  aria-labelledby="section3-heading">
      <div
        className="section3__bg"
        style={{ backgroundImage: `url(${assets.section3})` }}
        role="img"
        aria-hidden="true"
      />
      <div className="section3__overlay" aria-hidden="true" />
      <div className="container section3__grid">
        <motion.div
          className="section3__content"
          initial={{ opacity: 0, x: -24 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true, margin: '-60px' }}
          transition={{ duration: 0.6 }}
        >
          <h2 id="section3-heading" className="section3__heading">
            I am Salman Waria, <span className="section3__span">a digital entrepreneur and technology-driven strategist
            with a passion for building impactful businesses.</span>
          </h2>
          <span className="section3__line" aria-hidden="true" />
          <p className="section3__body">
            Over the years, I have founded and led multiple digital ventures across
            different regions, helping brands grow through innovation, creativity, and
            smart digital solutions.
          </p>
          <Link to="/about" className="section3__read-more">
            Read More
          </Link>
        </motion.div>
        <div className="section3__spacer" aria-hidden="true" />
      </div>
    </section>
  );
}
