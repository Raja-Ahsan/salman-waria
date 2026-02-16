const BASE = '/web-assets';

function path(name: string): string {
  return `${BASE}/${encodeURIComponent(name)}`;
}

export const assets = {
  hero: path('Rectangle 30.jpg'),
  bannerImage: path('banner-image.jpg'),
  logo: path('logo.png'),
  // logoAlt: path('logo.png'),
  // aboutPodium: path('7th-section.jpg'),
  aboutPhoto: path('7th-section.jpg'),
  section7Logo: path('7th-section-logo.png'),
  section3: path('3rd-section.jpg'),
  ventures: path('Group 70.jpg'),
  section4: path('4th-section.jpg'),
  unicornGif: path('1_xL8hHwKah8Jbn7SbaBwQFw.gif'),
  worldGif: path('world.gif'),
  worldTopLogo: path('world-top-logo.png'),
  subtract: path('Subtract.jpg'),
  whatidoBg: path('whatido-bg.jpg'),
  world2050: path('Group 5.jpg'),
  image2050: path('2050.png'),
  press: path('ChatGPT Image Jan 21, 2026, 10_24_20 PM 1.png'),
  pressAlt: path('90f2f58c-4955-40cb-b5e6-f3e3a19255da 1.png'),
  clientLogo: path('client-logo.jpg'),
  social: [
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector.png`,
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector-1.png`,
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector-2.png`,
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector-3.png`,
  ] as const,
  blog: [path('Group 67.jpg'), path('Group 70.jpg'), path('Rectangle 30.jpg')] as const,
} as const;
