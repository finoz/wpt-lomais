/**
 * Ficus - main TypeScript
 * JS minimale: solo comportamenti che CSS non può gestire
 */

import '../scss/main.scss'

document.addEventListener('DOMContentLoaded', () => {
  initNavigation()
})

/**
 * Comportamento navigazione mobile.
 * Il Navigation block di WP7 gestisce già hamburger e overlay via JS nativo,
 * ma qui possiamo aggiungere comportamenti extra se necessari.
 */
function initNavigation(): void {
  const header = document.querySelector('.wp-block-template-part') as HTMLElement | null
  if (!header) return

  // Scroll: aggiunge classe al header quando si scrolla
  const onScroll = (): void => {
    header.classList.toggle('is-scrolled', window.scrollY > 20)
  }

  window.addEventListener('scroll', onScroll, { passive: true })
  onScroll()
}
