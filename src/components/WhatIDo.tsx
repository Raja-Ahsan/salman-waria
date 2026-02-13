import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const SERVICES = [
  {
    title: 'DIGITAL STRATEGY & GROWTH',
    icon: (
      <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
        <circle cx="24" cy="24" r="8" />
        <path d="M24 8v4M24 36v4M8 24h4M36 24h4M12.7 12.7l2.8 2.8M32.5 32.5l2.8 2.8M12.7 35.3l2.8-2.8M32.5 15.5l2.8-2.8M35.3 35.3l-2.8-2.8M15.5 15.5l-2.8-2.8" />
        <path d="M24 16l-2 6 4 2 4-2-2-6" />
      </svg>
    ),
  },
  {
    title: 'TECH INNOVATION & AI SOLUTIONS',
    icon: (
      <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
        <rect x="8" y="8" width="32" height="32" rx="2" />
        <path d="M16 20h16M16 24h12M16 28h8" />
        <circle cx="34" cy="14" r="2" />
        <path d="M20 36l4-4 4 4 6-6" />
      </svg>
    ),
  },
  {
    title: 'BRAND DEVELOPMENT & STORYTELLING',
    icon: (
      <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
        <path d="M8 40V16l16-8 16 8v24" />
        <path d="M24 8v32M8 24h32" />
        <path d="M8 16l16 8 16-8" />
      </svg>
    ),
  },
  {
    title: 'BUSINESS SCALING & GLOBAL EXPANSION',
    icon: (
      <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
        <circle cx="24" cy="24" r="10" />
        <ellipse cx="24" cy="24" rx="10" ry="4" />
        <path d="M24 14v20M14 24h20" />
        <path d="M34 24l4-2M10 24l-4-2M24 34l-2-4M24 14l-2 4" />
      </svg>
    ),
  },
  {
    title: 'DIGITAL MARKETING & PERFORMANCE ADS',
    icon: (
      <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
        <path d="M28 16L16 28v8h4l8-8V16z" />
        <path d="M16 28c-4-2-6-6-6-10s2-8 6-10" />
        <path d="M32 20c2 2 3 5 3 8s-1 6-3 8" />
      </svg>
    ),
  },
];

export function WhatIDo() {
  return (
    <section id="what-i-do" className="section whatido" aria-labelledby="whatido-heading">
      <div className="container whatido__inner">
        

        <div className="whatido__bg_image">
        <motion.div
          className="whatido__graphic"
          initial={{ scale: 0.9, opacity: 0 }}
          whileInView={{ scale: 1, opacity: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5 }}
        >
          
          <span className="whatido__graphic-bg" aria-hidden="true">
            <img src={assets.worldGif} alt="" width={320} height={320} />
          </span>
          <img
            className="whatido__graphic-logo"
            src={assets.worldTopLogo}
            alt=""
            width={200}
            height={200}
            onError={(e) => {
              (e.target as HTMLImageElement).style.display = 'none';
            }}
          />
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
                key={s.title}
                className="whatido__card"
                initial={{ opacity: 0, y: 24 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true, margin: '-40px' }}
                transition={{ delay: 0.05 * i, duration: 0.4 }}
                whileHover={{ y: -4, transition: { duration: 0.2 } }}
              >
                <span className="whatido__card-icon" aria-hidden="true">
                  {s.icon}
                </span>
                <h3 className="whatido__card-title">{s.title}</h3>
              </motion.article>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
