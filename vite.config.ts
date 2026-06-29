import { defineConfig } from 'vite'
import { resolve } from 'path'

const themeDir = 'wp-content/themes/ficus'

export default defineConfig({
  // Il root degli asset sorgente
  root: resolve(__dirname, `${themeDir}/assets`),

  build: {
    // Output nella stessa dir del tema
    outDir: resolve(__dirname, `${themeDir}/assets/dist`),
    emptyOutDir: true,

    // Genera manifest.json per il PHP enqueue
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, `${themeDir}/assets/ts/main.ts`),
      },
    },
  },

  // Dev server: Vite gira su 5173, WP su 8080
  server: {
    port: 5173,
    strictPort: true,
    // Permette richieste dal dominio WP locale
    cors: true,
    // Hot reload quando cambiano i file PHP/HTML del tema
    watch: {
      usePolling: true,
    },
  },
})
