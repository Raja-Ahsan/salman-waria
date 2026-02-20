import { useState } from 'react';
import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const VENTURES = [
  {
    title: 'AMERICAN DIGITAL AGENCY',
    description: 'Helping Businesses Grow By Connecting Brands With Audiences in Meaningful Ways',
    
  },
  {
    title: 'LOGIC WORK',
    description: 'Blending Technology And Storytelling To Drive Digital Success.',
  },
  {
    title: 'LOGIC WORKS (DUBAI)',
    description: 'Digital Innovation Hub Pushing The Boundaries In The Heart Of The Tech World.',
  },
  {
    title: 'LOGIC MEDIA HOUSE',
    description: 'Revolutionizing Filmmaking With Modern Tech And Compelling Narratives.',
  },
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
  const [iconError, setIconError] = useState(false);

  return (
    <section id="ventures" className="container section ventures" aria-labelledby="ventures-heading">
      <div className="ventures__wrap">
        <div className="ventures__left">
          <div className="container ventures__left-inner">
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
                    <span className="ventures__card-icon" aria-hidden="true">
                      {!iconError ? (
                        <img
                          src={assets.logo}
                          alt=""
                          width={28}
                          height={28}
                          onError={() => setIconError(true)}
                        />
                      ) : (
                        <span className="ventures__card-icon-fallback">SH</span>
                      )}
                    </span>
                    <div className="ventures__card-text">
                      <h3 className="ventures__card-title">{v.title}</h3>
                      <p className="ventures__card-desc">{v.description}</p>
                    </div>
                    <span className="ventures__card-btn" aria-hidden="true">
                      ↗
                    </span>
                  </a>
                </motion.li>
              ))}
            </motion.ul>
          </div>
        </div>

        <motion.div
          className="ventures__media"
          initial={{ opacity: 0 }}
          whileInView={{ opacity: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
        >
          <img
            src={assets.section4}
            alt="Salman Waria"
            width={600}
            height={700}
          />
        </motion.div>

        <div className="ventures__view-all-wrap">
          <a href="#ventures" className="ventures__view-all">
            View All Ventures
          </a>
        </div>
      </div>
    </section>
  );
}
