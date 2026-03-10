import { Link, useLocation } from 'react-router-dom';
import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const NAV_LINKS = [
  { label: 'Home', to: '/' },
  { label: 'About', to: '/about' },
  { label: 'Book', to: '/bookdetails' },
  { label: 'Blog', to: '/blogsdetails' },
  { label: 'Contact', to: '/#contact' },
];

const SOCIAL_LINKS = [
  { name: 'Facebook', href: 'https://www.facebook.com/salmanwariaofficial', icon: assets.social[0] },
  { name: 'LinkedIn', href: 'https://ae.linkedin.com/in/salman-waria-tech-entrepreneur', icon: assets.social[1] },
  { name: 'Instagram', href: 'https://www.instagram.com/salman.waria/', icon: assets.social[2] },
  { name: 'IMDB', href: 'https://www.imdb.com/name/nm11841602/', icon: assets.social[3] },
];

export function Footer() {
  const location = useLocation();

  const handleContactClick = (e: React.MouseEvent) => {
    if (location.pathname === '/') {
      e.preventDefault();
      document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
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
            <Link to="/" className="footer__logo">
              <img
                src={assets.logo}
                alt=""
                className="footer__logo-img"
                width={56}
                height={56}
                onError={(e) => {
                  (e.target as HTMLImageElement).style.display = 'none';
                }}
              />
            </Link>
            <nav className="footer__nav" aria-label="Footer navigation">
              <ul className="footer__nav-list">
                {NAV_LINKS.map((link) => (
                  <li key={link.to}>
                    <Link
                      to={link.to}
                      className="footer__nav-link"
                      onClick={link.to === '/#contact' ? handleContactClick : undefined}
                    >
                      {link.label}
                    </Link>
                  </li>
                ))}
              </ul>
            </nav>
          </motion.div>

          <motion.div
            className="footer__newsletter"
            initial={{ opacity: 0, y: 12 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: 0.1 }}
          >
            <p className="footer__newsletter-label">SUBSCRIBE MY NEWSLETTER</p>
            <form onSubmit={(e) => e.preventDefault()} className="footer__newsletter-form">
              <label className="sr-only" htmlFor="footer-email">Email</label>
              <input
                id="footer-email"
                type="email"
                placeholder="Email"
                className="footer__newsletter-input"
              />
              <button type="submit" className="footer__newsletter-btn">
                Send
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
