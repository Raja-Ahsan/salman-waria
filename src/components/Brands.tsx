import { motion } from 'framer-motion';

const BRANDS = [
  {
    name: 'AMERICAN DIGITAL AGENCY LLC',
    tagline: 'WHERE AMERICAN DREAMS COME TRUE',
  },
  {
    name: 'ELITE PRO',
    tagline: 'WEBSITE',
  },
  {
    name: 'LWS',
    tagline: 'LIBERTY WEBSTUDIO',
  },
  {
    name: 'LogicWorks',
    tagline: null,
  },
];

export function Brands() {
  return (
    <section className="brands" id="brands" aria-labelledby="brands-heading">
      <div className="container brands__header">
        <motion.h2
          id="brands-heading"
          className="brands__title"
          initial={{ opacity: 0, y: 16 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          BRANDS CREATED BY ME
        </motion.h2>
      </div>

      <div className="brands__slider-wrap">
        <div className="brands__slider">
          {[...BRANDS, ...BRANDS].map((brand, i) => (
            <div key={`${brand.name}-${i}`} className="brands__item">
              <span className="brands__item-name">{brand.name}</span>
              {brand.tagline != null && brand.tagline !== '' && (
                <span className="brands__item-tagline">{brand.tagline}</span>
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
