import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import { assets } from '../lib/assets'

const POSTS = [
  { title: 'DIGITAL TRANSFORMATION TIPS', image: assets.blog[0] },
  { title: 'AI BUSINESS ADOPTION STRATEGIES', image: assets.blog[1] },
  { title: 'GROWTH MARKETING THAT DELIVERS ROI', image: assets.blog[2] },
  { title: 'THE FUTURE OF REMOTE WORK IN TECH', image: 'https://images.unsplash.com/photo-1662638600479-793f67d3b9f9?q=80&w=1331&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
  { title: 'BLOCKCHAIN FOR BUSINESS INNOVATION', image: 'https://images.unsplash.com/photo-1631864031824-d636e1dc5292?q=80&w=1331&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'},
  { title: 'BUILDING SCALABLE STARTUPS IN 2025', image: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'},
  { title: 'SUSTAINABLE TECH SOLUTIONS FOR ENTERPRISES', image: 'https://www.serverconsultancy.co.uk/wp-content/uploads/2023/12/Environmental-Responsibility-in-sustainable-IT-solutions-for-SMEs-1.jpg'  },
  { title: 'DATA DRIVEN DECISION MAKING', image: 'https://plus.unsplash.com/premium_photo-1682126255537-d3d08524f263?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
  { title: 'INNOVATION AND CREATIVITY IN DIGITAL AGE', image: 'https://i0.wp.com/andrewggibson.com/wp-content/uploads/2023/12/DALL%C2%B7E-2023-12-27-08.45.07-A-stunning-and-visually-captivating-digital-collage-in-a-16_9-aspect-ratio-symbolizing-the-fusion-of-technology-and-creativity.-Feature-a-realistic-h-jpg.webp?fit=1792%2C1024&ssl=1'   },
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
