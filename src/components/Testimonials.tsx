import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';

const TESTIMONIALS = [
  {
    quote:
      "Salman's insights have been invaluable. His strategic vision and leadership transformed our business.",
    name: 'John Doe',
    role: 'CEO of ABC Corp',
    rating: 5,
  },
  {
    quote:
      'Salman brings a rare combination of vision and execution. His insights on AI and digital transformation have been invaluable to our growth.',
    name: 'Alex Chen',
    role: 'CEO, TechFlow',
    rating: 5,
  },
  {
    quote:
      'Working with Salman opened doors we never thought possible. His network and strategic guidance are world-class.',
    name: 'Sarah Mitchell',
    role: 'Founder, NextGen Labs',
    rating: 5,
  },
];

export function Testimonials() {
  const [index, setIndex] = useState(0);
  const current = TESTIMONIALS[index];

  const goNext = () => setIndex((i) => (i + 1) % TESTIMONIALS.length);
  const goPrev = () => setIndex((i) => (i - 1 + TESTIMONIALS.length) % TESTIMONIALS.length);

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
          <div className="testimonials__avatar" aria-hidden>
            <div className="testimonials__avatar-placeholder" />
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
              <p>&quot;{current.quote}&quot;</p>
              <footer>
                <cite className="testimonials__name">{current.name.toUpperCase()}, {current.role.toUpperCase()}</cite>
              </footer>
              <div className="testimonials__rating" aria-hidden>
                {'★'.repeat(current.rating)}
              </div>
            </motion.blockquote>
          </AnimatePresence>

          <div className="testimonials__nav">
            <button
              type="button"
              onClick={goPrev}
              aria-label="Previous testimonial"
              className="testimonials__btn"
            >
              ←
            </button>
            <button
              type="button"
              onClick={goNext}
              aria-label="Next testimonial"
              className="testimonials__btn"
            >
              →
            </button>
          </div>
        </div>
      </div>
    </section>
  );
}
