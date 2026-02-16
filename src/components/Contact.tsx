import { useState } from 'react';
import { motion } from 'framer-motion';
import { useVantaFog } from '../hooks/useVantaFog';

export function Contact() {
  const vantaRef = useVantaFog();
  const [status, setStatus] = useState<'idle' | 'sending' | 'sent' | 'error'>('idle');

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setStatus('sending');
    // Simulate submit; replace with your backend/API
    setTimeout(() => setStatus('sent'), 1200);
  };

  return (
    <section id="contact" className="container contact" aria-labelledby="contact-heading">
      
      <div className="container contact__inner">
      <div
        ref={vantaRef}
        className="contact__fog"
        aria-hidden="true"
      />
        <motion.h2
          id="contact-heading"
          className="contact__title"
          initial={{ opacity: 0, y: 16 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          CONTACT
        </motion.h2>
        <motion.p
          className="contact__subtitle"
          initial={{ opacity: 0, y: 12 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.05 }}
        >
          Let&apos;s build something impactful together.
        </motion.p>

        <motion.form
          className="contact__form"
          onSubmit={handleSubmit}
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.1 }}
        >
          <label className="contact__label">
            <span className="sr-only">Name</span>
            <input
              type="text"
              name="name"
              placeholder="Name"
              required
              className="contact__input"
              disabled={status === 'sending'}
            />
          </label>
          <label className="contact__label">
            <span className="sr-only">Email</span>
            <input
              type="email"
              name="email"
              placeholder="Email"
              required
              className="contact__input"
              disabled={status === 'sending'}
            />
          </label>
          <label className="contact__label">
            <span className="sr-only">Phone</span>
            <input
              type="tel"
              name="phone"
              placeholder="Phone"
              className="contact__input"
              disabled={status === 'sending'}
            />
          </label>
          <label className="contact__label">
            <span className="sr-only">Project</span>
            <input
              type="text"
              name="project"
              placeholder="Project"
              className="contact__input"
              disabled={status === 'sending'}
            />
          </label>
          <label className="contact__label contact__label--full">
            <span className="sr-only">Message</span>
            <textarea
              name="message"
              placeholder="Message"
              rows={5}
              required
              className="contact__input contact__textarea"
              disabled={status === 'sending'}
            />
          </label>
          <motion.button
            type="submit"
            className="contact__submit"
            disabled={status === 'sending'}
            whileHover={{ scale: 1.02 }}
            whileTap={{ scale: 0.98 }}
          >
            {status === 'sending' ? 'SENDING...' : status === 'sent' ? 'SENT' : 'Submit'}
          </motion.button>
        </motion.form>
      </div>
    </section>
  );
}
