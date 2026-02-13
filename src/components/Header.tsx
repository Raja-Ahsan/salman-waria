import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { assets } from '../lib/assets';

const NAV_LINKS = [
  { label: 'Home', href: '#home' },
  { label: 'About', href: '#about' },
  { label: 'Book', href: '#contact' },
  { label: 'Blog', href: '#blog' },
];

export function Header() {
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <motion.header
      className="header"
      initial={{ y: -80, opacity: 0 }}
      animate={{ y: 0, opacity: 1 }}
      transition={{ duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
    >
      <div className="container header__inner">
        <a href="#home" className="header__logo" aria-label="Salman Waria Home">
          <img
            src={assets.logo}
            alt="Salman Waria"
            className="header__logo-img"
            width={88}
            height={139}
          />
        </a>

        <nav className="header__nav" aria-label="Main navigation">
          <ul className="header__nav-list">
            {NAV_LINKS.map((link, i) => (
              <li key={link.href}>
                <motion.a
                  href={link.href}
                  className="header__nav-link"
                  initial={{ opacity: 0, y: -10 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: 0.05 * i, duration: 0.4 }}
                  onClick={() => setMenuOpen(false)}
                >
                  {link.label}
                </motion.a>
              </li>
            ))}
          </ul>
          <a href="#contact" className="header__cta header__cta--outline" onClick={() => setMenuOpen(false)}>
            Contact With Me
          </a>
        </nav>

        <motion.button
          type="button"
          className="header__burger"
          aria-label={menuOpen ? 'Close menu' : 'Open menu'}
          aria-expanded={menuOpen}
          onClick={() => setMenuOpen(!menuOpen)}
          whileTap={{ scale: 0.95 }}
        >
          <span className={menuOpen ? 'header__burger-line open' : 'header__burger-line'} />
          <span className={menuOpen ? 'header__burger-line open' : 'header__burger-line'} />
          <span className={menuOpen ? 'header__burger-line open' : 'header__burger-line'} />
        </motion.button>
      </div>

      <AnimatePresence>
        {menuOpen && (
          <motion.div
            className="header__mobile-menu"
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: 'auto' }}
            exit={{ opacity: 0, height: 0 }}
            transition={{ duration: 0.3 }}
          >
            <div className="container">
              <ul className="header__mobile-list">
                {NAV_LINKS.map((link, i) => (
                  <motion.li
                    key={link.href}
                    initial={{ opacity: 0, x: -20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: 0.03 * i }}
                  >
                    <a href={link.href} onClick={() => setMenuOpen(false)}>
                      {link.label}
                    </a>
                  </motion.li>
                ))}
              </ul>
              <a href="#contact" className="header__mobile-cta header__mobile-cta--outline" onClick={() => setMenuOpen(false)}>
                Contact With Me
              </a>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </motion.header>
  );
}
