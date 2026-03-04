import { useState } from 'react'
import { motion } from 'framer-motion'

const container = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.1, delayChildren: 0.2 },
  },
}

const item = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0 },
}

function ContactPage() {
  const [status, setStatus] = useState<'idle' | 'sending' | 'sent' | 'error'>('idle')

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    setStatus('sending')
    // Replace with your backend/API
    setTimeout(() => setStatus('sent'), 1200)
  }

  return (
    <div className="inner-page inner-page--contact">
      <section className="inner-page__hero" aria-label="Contact page hero">
        <div className="container inner-page__hero-inner">
          <motion.div
            className="inner-page__hero-content"
            variants={container}
            initial="hidden"
            animate="visible"
          >
            <motion.span className="inner-page__hero-label" variants={item}>
              Contact
            </motion.span>
            <motion.h1 className="inner-page__hero-title" variants={item}>
              Get in Touch
            </motion.h1>
            <motion.p className="inner-page__hero-subtitle" variants={item}>
              Let&apos;s build something impactful together. Send a message and we&apos;ll get back to you.
            </motion.p>
          </motion.div>
        </div>
      </section>

      <main className="inner-page__main">
        <section
          className="inner-page__section inner-page__section--contact"
          aria-labelledby="contact-form-heading"
        >
          <div className="container">
            <div className="inner-page__grid inner-page__grid--contact">
              <motion.div
                className="inner-page__contact-form-wrap"
                initial={{ opacity: 0, y: 24 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true, margin: '-40px' }}
                transition={{ duration: 0.5, ease: [0.22, 1, 0.36, 1] }}
              >
                <h2 id="contact-form-heading" className="sr-only">
                  Contact form
                </h2>
                <motion.form
                  className="contact-page__form"
                  onSubmit={handleSubmit}
                  initial={{ opacity: 0, y: 16 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: 0.1 }}
                >
                  <label className="contact-page__label">
                    <span className="sr-only">Name</span>
                    <input
                      type="text"
                      name="name"
                      placeholder="Name"
                      required
                      className="contact-page__input"
                      disabled={status === 'sending'}
                    />
                  </label>
                  <label className="contact-page__label">
                    <span className="sr-only">Email</span>
                    <input
                      type="email"
                      name="email"
                      placeholder="Email"
                      required
                      className="contact-page__input"
                      disabled={status === 'sending'}
                    />
                  </label>
                  <label className="contact-page__label">
                    <span className="sr-only">Phone</span>
                    <input
                      type="tel"
                      name="phone"
                      placeholder="Phone"
                      className="contact-page__input"
                      disabled={status === 'sending'}
                    />
                  </label>
                  <label className="contact-page__label">
                    <span className="sr-only">Project</span>
                    <input
                      type="text"
                      name="project"
                      placeholder="Project"
                      className="contact-page__input"
                      disabled={status === 'sending'}
                    />
                  </label>
                  <label className="contact-page__label contact-page__label--full">
                    <span className="sr-only">Message</span>
                    <textarea
                      name="message"
                      placeholder="Message"
                      rows={5}
                      required
                      className="contact-page__input contact-page__textarea"
                      disabled={status === 'sending'}
                    />
                  </label>
                  <motion.button
                    type="submit"
                    className="contact-page__submit"
                    disabled={status === 'sending'}
                    whileHover={{ scale: 1.02 }}
                    whileTap={{ scale: 0.98 }}
                  >
                    {status === 'sending'
                      ? 'Sending...'
                      : status === 'sent'
                        ? 'Message Sent'
                        : 'Send Message'}
                  </motion.button>
                </motion.form>
              </motion.div>

              <motion.div
                className="inner-page__contact-info"
                initial={{ opacity: 0, x: 24 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true, margin: '-40px' }}
                transition={{ duration: 0.5, ease: [0.22, 1, 0.36, 1] }}
              >
                <h3 className="inner-page__contact-info-title">Contact Info</h3>
                <p className="inner-page__contact-info-text">
                  For business inquiries, partnerships, or speaking opportunities, reach out via the form or the details below.
                </p>
                <ul className="inner-page__contact-info-list" aria-label="Contact details">
                  <li>
                    <span className="inner-page__contact-info-label">Email</span>
                    <a href="mailto:hello@salmanwaria.com" className="inner-page__contact-info-link">
                      hello@salmanwaria.com
                    </a>
                  </li>
                  <li>
                    <span className="inner-page__contact-info-label">Location</span>
                    <span className="inner-page__contact-info-value">Dubai, UAE</span>
                  </li>
                </ul>
              </motion.div>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}

export default ContactPage
