import { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import { assets } from '../lib/assets';

const NAV_LINKS = [
  { label: 'Home', href: '/', to: '/' },
  { label: 'About', href: '#about', to: '/#about' },
  { label: 'Book', href: '#book', to: '/#book' },
  { label: 'Blog', href: '#blog', to: '/#blog' },
];

const PAGE_TO_HASH: Record<string, string> = {
  '/about': '#about',
  '/bookdetails': '#book',
  '/blogsdetails': '#blog',
};

export function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const location = useLocation();

  const handleNavClick = (link: (typeof NAV_LINKS)[0], e: React.MouseEvent) => {
    setMenuOpen(false);
    const currentHash = PAGE_TO_HASH[location.pathname];
    const isSamePage = link.href === currentHash;
    if (isSamePage) {
      e.preventDefault();
      return;
    }
    const hash = link.href?.startsWith('#') ? link.href.slice(1) : null;
    if (hash && location.pathname === '/') {
      const el = document.getElementById(hash);
      el?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  return (
    <motion.header
      className="header"
      initial={{ y: -80, opacity: 0 }}
      animate={{ y: 0, opacity: 1 }}
      transition={{ duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
    >
      <div className="container header__inner">
        <Link to="/" className="header__logo" aria-label="Salman Waria Home">
          <img
            src={assets.logo}
            alt="Salman Waria"
            className="header__logo-img"
            width={88}
            height={139}
          />
        </Link>

        <nav className="header__nav" aria-label="Main navigation">
          <ul className="header__nav-list">
            {NAV_LINKS.map((link, i) => (
              <li key={link.to ?? link.href}>
                <motion.div
                  initial={{ opacity: 0, y: -10 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: 0.05 * i, duration: 0.4 }}
                >
                  <Link
                    to={link.to}
                    className="header__nav-link"
                    onClick={(e) => handleNavClick(link, e)}
                  >
                    {link.label}
                  </Link>
                </motion.div>
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
                    key={link.to ?? link.href}
                    initial={{ opacity: 0, x: -20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: 0.03 * i }}
                  >
                    <Link
                      to={link.to}
                      onClick={(e) => handleNavClick(link, e)}
                    >
                      {link.label}
                    </Link>
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
