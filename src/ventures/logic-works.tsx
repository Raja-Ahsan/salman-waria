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
    title: 'Digital Storytelling Platform',
    description: 'Platform that blends technology and narrative to create engaging digital experiences.',
    image: 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&q=80',
    imageAlt: 'Digital collaboration',
    url: '#',
  },
  {
    id: 'project-2',
    title: 'Brand Experience & Strategy',
    description: 'End-to-end digital strategy and execution driving growth and audience connection.',
    image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
    imageAlt: 'Strategy and analytics',
    url: '#',
  },
  {
    id: 'project-3',
    title: 'Content & Tech Integration',
    description: 'Unifying content, design, and technology for measurable digital success.',
    image: 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
    imageAlt: 'Team and technology',
    url: '#',
  },
];

function LogicWorks() {
  return (
    <div className="inner-page inner-page--venture" role="document">
      <header>
        <section
          className="inner-page__hero"
          aria-label="Logic Work hero"
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
                Logic Work
              </motion.h1>
              <motion.p
                className="inner-page__hero-subtitle"
                variants={item}
              >
                Blending Technology And Storytelling To Drive Digital Success.
              </motion.p>
              <motion.div variants={item}>
                <a
                  href="#"
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

export default LogicWorks;
