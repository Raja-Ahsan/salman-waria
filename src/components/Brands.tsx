import { motion } from 'framer-motion';
import AiiEstate from '../assets/images/ai-estate.png';
import Freedom from '../assets/images/freedom.png';
import GreatAmerican from '../assets/images/great-american.png';


const BRANDS = [
  {

    image: AiiEstate,
    link: '#',
  },
  {
 
    image: Freedom,
    link: 'http://build-freedom.ai/',
  },
  {
   
    image: GreatAmerican,
    link: 'https://greatamerican.ai/',
  },
  {

    image: AiiEstate,
    link: '#',
  },
  {
 
    image: Freedom,
    link: 'http://build-freedom.ai/',
  },
  {
   
    image: GreatAmerican,
    link: 'https://greatamerican.ai/',
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
            <div key={`${brand.image}-${i}`} className="brands__item">
              <a
                href={brand.link}
                target="_blank"
                rel="noopener noreferrer"
                className="brands__item-link"
                aria-label={`Brand ${i + 1}`}
              >
                <img
                  src={brand.image}
                  alt="{}"
                  className="brands__item-img"
                  loading="lazy"
                />
              </a>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
