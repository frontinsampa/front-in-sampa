import { defineConfig } from 'astro/config';

import partytown from '@astrojs/partytown';


// https://astro.build/config
export default defineConfig({
  integrations: [
    partytown({
      config: {
        forward: ['dataLayer.push'],
      },
    })
  ],
});

// export default {
//   // projectRoot: '.',     // Where to resolve all URLs relative to. Useful if you have a monorepo project.
//   // pages: './src/pages', // Path to Astro components, pages, and data
//   // dist: './dist',       // When running `astro build`, path to final static output
//   // public: './public',   // A folder of static files Astro will copy to the root. Useful for favicons, images, and other files that don’t need processing.
//   buildOptions: {
//     site: 'https://2023.frontinsampa.com.br/',
//     sitemap: true,
//   },
//   devOptions: {
//     hostname: '0.0.0.0',
//     port: 3030,
//   },
// };
