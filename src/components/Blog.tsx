import { motion } from 'framer-motion';
import { assets } from '../lib/assets';

const POSTS = [
  {
    title: 'The Rise of AI in Business: A New Era',
    date: 'FEB 24, 2026',
    image: assets.blog[0],
  },
  {
    title: 'Blockchain for Social Impact',
    date: 'FEB 20, 2026',
    image: assets.blog[1],
  },
  {
    title: 'Future of Work: Tech & Humanity',
    date: 'FEB 18, 2026',
    image: assets.blog[2],
  },
];

export function Blog() {
  return (
    <section id="blog" className="section blog" aria-labelledby="blog-heading">
      <div className="container blog__inner">
        <motion.h2
          id="blog-heading"
          className="blog__title"
          initial={{ opacity: 0, y: 16 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          BLOG
        </motion.h2>

        <ul className="blog__grid">
          {POSTS.map((post, i) => (
            <motion.li
              key={post.title}
              initial={{ opacity: 0, y: 24 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, margin: '-40px' }}
              transition={{ delay: 0.08 * i }}
            >
              <article className="blog__card">
                <a href="#">
                  <div className="blog__card-img-wrap">
                    <img
                      src={post.image}
                      alt=""
                      width={360}
                      height={220}
                      onError={(e) => {
                        const el = e.target as HTMLImageElement;
                        el.style.background = 'var(--bg-card)';
                        el.alt = post.title;
                      }}
                    />
                  </div>
                  <h3 className="blog__card-title">{post.title}</h3>
                  <time className="blog__card-date" dateTime="2026-02-24">
                    {post.date}
                  </time>
                </a>
              </article>
            </motion.li>
          ))}
        </ul>
      </div>
    </section>
  );
}
