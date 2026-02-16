import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';

const WEB_ASSETS = '/web-assets';
const getAvatarUrl = (filename: string) => `${WEB_ASSETS}/${encodeURIComponent(filename)}`;

const TESTIMONIALS = [
  {
    quote:
      "Salman's insights have been invaluable. His strategic vision and leadership transformed our business.",
    name: 'John Doe',
    role: 'CEO of ABC Corp',
    rating: 5,
    avatar: 'client-logo.jpg',
  },
  {
    quote:
      'Salman brings a rare combination of vision and execution. His insights on AI and digital transformation have been invaluable to our growth.',
    name: 'Alex Chen',
    role: 'CEO, TechFlow',
    rating: 5,
    avatar: 'client-logo-2.jpg',
  },
  {
    quote:
      'Working with Salman opened doors we never thought possible. His network and strategic guidance are world-class.',
    name: 'Sarah Mitchell',
    role: 'Founder, NextGen Labs',
    rating: 5,
    avatar: 'client-logo-3.jpg',
  },
];

export function Testimonials() {
  const [index, setIndex] = useState(0);
  const [avatarError, setAvatarError] = useState(false);
  const current = TESTIMONIALS[index];

  const goNext = () => {
    setIndex((i) => (i + 1) % TESTIMONIALS.length);
    setAvatarError(false);
  };
  const goPrev = () => {
    setIndex((i) => (i - 1 + TESTIMONIALS.length) % TESTIMONIALS.length);
    setAvatarError(false);
  };

  return (
    <section id="testimonials" className="section testimonials" aria-labelledby="testimonials-heading">
      <div className="container testimonials__inner">
        <motion.h2
          id="testimonials-heading"
          className="testimonials__title"
          initial={{ opacity: 0, y: 16 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          TESTIMONIALS
        </motion.h2>

        <div className="testimonials__slider">
          <button
            type="button"
            onClick={goPrev}
            aria-label="Previous testimonial"
            className="testimonials__btn testimonials__btn--prev"
          >
            ←
          </button>

          <div className="testimonials__content">
            <div className="testimonials__avatar" key={current.avatar} aria-hidden>
              {!avatarError ? (
                <img
                  src={getAvatarUrl(current.avatar)}
                  alt=""
                  width={88}
                  height={88}
                  className="testimonials__avatar-img"
                  onError={() => setAvatarError(true)}
                />
              ) : null}
              <div
                className={`testimonials__avatar-placeholder${avatarError ? ' testimonials__avatar-placeholder--show' : ''}`}
                aria-hidden
              />
            </div>

            <AnimatePresence mode="wait">
              <motion.blockquote
                key={index}
                className="testimonials__quote"
                initial={{ opacity: 0, y: 12 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: -12 }}
                transition={{ duration: 0.3 }}
              >
                <div className="testimonials__rating" aria-hidden>
                  {'★'.repeat(current.rating)}
                </div>
                <p>&quot;{current.quote}&quot;</p>
                <footer>
                  <span className="testimonials__name">{current.name}</span>
                  <span className="testimonials__role">{current.role}</span>
                </footer>
              </motion.blockquote>
            </AnimatePresence>
          </div>

          <button
            type="button"
            onClick={goNext}
            aria-label="Next testimonial"
            className="testimonials__btn testimonials__btn--next"
          >
            →
          </button>
        </div>
      </div>
    </section>
  );
}
