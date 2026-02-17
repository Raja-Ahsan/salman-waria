import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import { assets } from '../lib/assets'

const POSTS = [
  { title: 'DIGITAL TRANSFORMATION TIPS', image: assets.blog[0] },
  { title: 'AI BUSINESS ADOPTION STRATEGIES', image: assets.blog[1] },
  { title: 'GROWTH MARKETING THAT DELIVERS ROI', image: assets.blog[2] },
  { title: 'THE FUTURE OF REMOTE WORK IN TECH', image: assets.blog[0] },
  { title: 'BLOCKCHAIN FOR BUSINESS INNOVATION', image: assets.blog[1] },
  { title: 'BUILDING SCALABLE STARTUPS IN 2025', image: assets.blog[2] },
  { title: 'SUSTAINABLE TECH SOLUTIONS FOR ENTERPRISES', image: assets.blog[0] },
  { title: 'DATA DRIVEN DECISION MAKING', image: assets.blog[1] },
  { title: 'INNOVATION AND CREATIVITY IN DIGITAL AGE', image: assets.blog[2] },
]

const container = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.08, delayChildren: 0.15 },
  },
}

const item = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0 },
}

function BlogsDetails() {
  return (
    <div className="inner-page inner-page--blogs">
      <section className="inner-page__hero" aria-label="Blogs page hero">
        <div className="container inner-page__hero-inner">
          <motion.div
            className="inner-page__hero-content"
            variants={container}
            initial="hidden"
            animate="visible"
          >
            <motion.span className="inner-page__hero-label" variants={item}>
              Blog
            </motion.span>
            <motion.h1 className="inner-page__hero-title" variants={item}>
              All Blogs
            </motion.h1>
            <motion.p className="inner-page__hero-subtitle" variants={item}>
              Insights on digital transformation, AI, and growth marketing
            </motion.p>
          </motion.div>
        </div>
      </section>

      <main className="inner-page__main">
        <section className="inner-page__section inner-page__section--blogs" aria-labelledby="blogs-heading">
          <div className="container">
            <h2 id="blogs-heading" className="sr-only">
              Blog posts
            </h2>
            <motion.ul
              className="inner-page__blogs-grid"
              variants={container}
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: '-40px' }}
            >
              {POSTS.map((post) => (
                <motion.li key={post.title} variants={item}>
                  <article className="inner-page__blog-card">
                    <Link to="#" className="inner-page__blog-card-link">
                      <div className="inner-page__blog-card-img">
                        <img
                          src={post.image}
                          alt=""
                          width={360}
                          height={220}
                          onError={(e) => {
                            const el = e.target as HTMLImageElement
                            el.style.background = 'var(--bg-card)'
                            el.alt = post.title
                          }}
                        />
                      </div>
                      <h3 className="inner-page__blog-card-title">{post.title}</h3>
                      <span className="inner-page__blog-card-link-text">Learn More</span>
                    </Link>
                  </article>
                </motion.li>
              ))}
            </motion.ul>
            {/* <motion.div
              className="inner-page__back-wrap"
              initial={{ opacity: 0, y: 12 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
            >
              <Link to="/#blog" className="inner-page__btn inner-page__btn--primary">
                Back to Home
              </Link>
            </motion.div> */}
          </div>
        </section>
      </main>
    </div>
  )
}

export default BlogsDetails
