const BASE = '/web-assets';

function path(name: string): string {
  return `${BASE}/${encodeURIComponent(name)}`;
}

export const assets = {
  hero: path('Rectangle 30.jpg'),
  bannerImage: path('banner-image.jpg'),
  logo: path('logo.png'),
  logoAlt: path('Group 55.png'),
  aboutPodium: path('Group 67.jpg'),
  ventures: path('Group 70.jpg'),
  unicornGif: path('1_xL8hHwKah8Jbn7SbaBwQFw.gif'),
  world2050: path('Group 5.jpg'),
  press: path('ChatGPT Image Jan 21, 2026, 10_24_20 PM 1.png'),
  pressAlt: path('90f2f58c-4955-40cb-b5e6-f3e3a19255da 1.png'),
  social: [
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector.png`,
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector-1.png`,
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector-2.png`,
    `${BASE}/${encodeURIComponent('Social Media Icon')}/Vector-3.png`,
  ] as const,
  blog: [path('Group 67.jpg'), path('Group 70.jpg'), path('Rectangle 30.jpg')] as const,
} as const;
