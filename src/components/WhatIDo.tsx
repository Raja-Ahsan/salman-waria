import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const SERVICES = [
  {
    num: '1',
    title: 'BUSINESS STRATEGY',
    description: 'Data-driven strategies to scale your business and enter new markets.',
  },
  {
    num: '2',
    title: 'TECHNOLOGY CONSULTING',
    description: 'Expert guidance on AI, blockchain, and digital transformation.',
  },
  {
    num: '3',
    title: 'INVESTMENT & FUNDRAISING',
    description: 'Connecting startups with capital and strategic partners.',
  },
  {
    num: '4',
    title: 'SPEAKING & MENTORSHIP',
    description: 'Keynotes, workshops, and one-on-one leadership mentorship.',
  },
  {
    num: '5',
    title: 'DIGITAL TRANSFORMATION',
    description: 'End-to-end digital transformation for traditional enterprises.',
  },
];

export function WhatIDo() {
  return (
    <section id="what-i-do" className="section whatido" aria-labelledby="whatido-heading">
      <div className="container whatido__inner">
        <motion.div
          className="whatido__graphic"
          initial={{ scale: 0, opacity: 0 }}
          whileInView={{ scale: 1, opacity: 1 }}
          viewport={{ once: true }}
          transition={{ type: 'spring', stiffness: 120, damping: 18 }}
        >
          <img
            src={assets.unicornGif}
            alt=""
            width={140}
            height={140}
            onError={(e) => {
              (e.target as HTMLImageElement).style.display = 'none';
            }}
          />
          <span className="whatido__graphic-fallback">S.H.</span>
        </motion.div>

        <motion.h2
          id="whatido-heading"
          className="whatido__title"
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          WHAT I DO
        </motion.h2>

        <div className="whatido__grid">
          {SERVICES.map((s, i) => (
            <motion.article
              key={s.num}
              className="whatido__card"
              initial={{ opacity: 0, y: 24 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, margin: '-40px' }}
              transition={{ delay: 0.05 * i, duration: 0.5 }}
              whileHover={{ y: -4, transition: { duration: 0.2 } }}
            >
              <span className="whatido__card-num">{s.num}</span>
              <h3 className="whatido__card-title">{s.title}</h3>
              <p className="whatido__card-desc">{s.description}</p>
            </motion.article>
          ))}
        </div>
      </div>
    </section>
  );
}
