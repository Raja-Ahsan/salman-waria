import { useState } from 'react';
import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const SOCIAL_LINKS = [
  { name: 'Twitter', href: 'https://twitter.com/salmanwaria', icon: assets.social[0] },
  { name: 'LinkedIn', href: 'https://www.linkedin.com/in/salmanwaria', icon: assets.social[1] },
  { name: 'Instagram', href: 'https://www.instagram.com/salmanwaria', icon: assets.social[2] },
  { name: 'Facebook', href: 'https://www.facebook.com/salmanwaria', icon: assets.social[3] },
];

export function Footer() {
  const [email, setEmail] = useState('');

  const handleSubscribe = (e: React.FormEvent) => {
    e.preventDefault();
    if (email) setEmail('');
  };

  return (
    <footer className="footer" role="contentinfo">
      <div className="container footer__inner">
        <div className="footer__top">
          <motion.div
            className="footer__brand"
            initial={{ opacity: 0, y: 12 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            <img
              src={assets.logo}
              alt=""
              className="footer__logo-img"
              width={48}
              height={48}
              onError={(e) => {
                (e.target as HTMLImageElement).style.display = 'none';
              }}
            />
            <span className="footer__logo-text">S.H.</span>
            <p className="footer__copy">
              © 2026 Salman Waria. All Rights Reserved.
            </p>
            <address className="footer__address">
              123 Main Street, Suite 400, New York, NY 10001
            </address>
          </motion.div>

          <motion.div
            className="footer__newsletter"
            initial={{ opacity: 0, y: 12 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: 0.1 }}
          >
            <p className="footer__newsletter-label">Subscribe to Newsletter</p>
            <form onSubmit={handleSubscribe} className="footer__newsletter-form">
              <label className="sr-only" htmlFor="footer-email">Email</label>
              <input
                id="footer-email"
                type="email"
                placeholder="Your email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="footer__newsletter-input"
              />
              <button type="submit" className="footer__newsletter-btn">
                Subscribe
              </button>
            </form>
            <ul className="footer__social">
              {SOCIAL_LINKS.map((s, i) => (
                <motion.li
                  key={s.name}
                  initial={{ opacity: 0 }}
                  whileInView={{ opacity: 1 }}
                  viewport={{ once: true }}
                  transition={{ delay: 0.05 * i }}
                >
                  <a
                    href={s.href}
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label={s.name}
                  >
                    <img src={s.icon} alt="" width={20} height={20} />
                  </a>
                </motion.li>
              ))}
            </ul>
          </motion.div>
        </div>

        <motion.div
          className="footer__name-block"
          initial={{ opacity: 0 }}
          whileInView={{ opacity: 1 }}
          viewport={{ once: true }}
        >
          <span className="footer__name">SALMAN WARIA</span>
        </motion.div>
      </div>
    </footer>
  );
}
