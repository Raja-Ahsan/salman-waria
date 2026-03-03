import { motion } from 'framer-motion';
import { Link } from 'react-router-dom';

const container = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.1, delayChildren: 0.2 },
  },
};

const item = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0 },
};

const portfolioItems = [
  {
    id: 'project-1',
    title: 'Brand Website Redesign',
    description: 'Full website redesign for a modern brand, focusing on performance, accessibility, and conversion.',
    image: 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=800&q=80',
    imageAlt: 'Website design showcase',
    url: '#',
  },
  {
    id: 'project-2',
    title: 'E-Commerce Platform',
    description: 'Custom e-commerce solution with seamless checkout and integrated analytics.',
    image: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80',
    imageAlt: 'E-commerce dashboard',
    url: '#',
  },
  {
    id: 'project-3',
    title: 'Corporate Portal',
    description: 'Enterprise portal with role-based access, dashboards, and reporting tools.',
    image: 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&q=80',
    imageAlt: 'Corporate portal interface',
    url: '#',
  },
];

function DigitalAmericanAgency() {
  return (
    <div className="inner-page inner-page--venture" role="document">
      <header>
        <section
          className="inner-page__hero"
          aria-label="Digital American Agency hero"
        >
          <div className="container inner-page__hero-inner">
            <motion.div
              className="inner-page__hero-content"
              variants={container}
              initial="hidden"
              animate="visible"
            >
              <motion.span
                className="inner-page__hero-label"
                variants={item}
              >
                Venture
              </motion.span>
              <motion.h1
                className="inner-page__hero-title"
                variants={item}
              >
                Digital American Agency
              </motion.h1>
              <motion.p
                className="inner-page__hero-subtitle"
                variants={item}
              >
                Helping Businesses Grow By Connecting Brands With Audiences in Meaningful Ways
              </motion.p>
              <motion.div variants={item}>
                <a
                  href="https://americandigitalagency.us/"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="inner-page__btn inner-page__btn--primary inner-page__hero-cta"
                >
                  Visit Website
                  <span aria-hidden="true"> ↗</span>
                </a>
              </motion.div>
            </motion.div>
          </div>
        </section>
      </header>

      <main className="inner-page__main">
        <section
          className="venture-portfolio"
          aria-labelledby="venture-portfolio-heading"
        >
          <div className="container">
            <motion.h2
              id="venture-portfolio-heading"
              className="venture-portfolio__heading"
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, margin: '-60px' }}
            >
              Portfolio
            </motion.h2>
            <motion.ul
              className="venture-portfolio__grid"
              variants={container}
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: '-60px' }}
            >
              {portfolioItems.map((project) => (
                <motion.li
                  key={project.id}
                  className="venture-portfolio__item"
                  variants={item}
                >
                  <article className="venture-portfolio__card">
                    <div className="venture-portfolio__img-wrap">
                      <img
                        src={project.image}
                        alt={project.imageAlt}
                        width={800}
                        height={500}
                        className="venture-portfolio__img"
                        loading="lazy"
                      />
                    </div>
                    <div className="venture-portfolio__content">
                      <h3 className="venture-portfolio__title">
                        {project.title}
                      </h3>
                      <p className="venture-portfolio__desc">
                        {project.description}
                      </p>
                      <a
                        href={project.url}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="venture-portfolio__link"
                      >
                        View Project
                        <span className="venture-portfolio__link-icon" aria-hidden="true">
                          ↗
                        </span>
                      </a>
                    </div>
                  </article>
                </motion.li>
              ))}
            </motion.ul>
            <motion.div
              className="venture-portfolio__back"
              initial={{ opacity: 0 }}
              whileInView={{ opacity: 1 }}
              viewport={{ once: true }}
            >
              <Link to="/#ventures" className="inner-page__btn inner-page__btn--primary">
                Back to Ventures
              </Link>
            </motion.div>
          </div>
        </section>
      </main>
    </div>
  );
}

export default DigitalAmericanAgency;
