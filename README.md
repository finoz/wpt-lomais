# wpt-lomais

Child theme WordPress per **Agricola 2000 / A2K (Lomais)**.  
Basato su [wpt-ficus](https://github.com/finoz/wpt-ficus) come parent theme.

## Prerequisiti

- Docker Desktop
- nvm + Node 22 (`nvm use` nella cartella tema)
- `wpt-ficus` clonato nella stessa directory padre (`../wpt-ficus`)

## Avvio locale

```bash
# 1. Avvia WordPress
docker compose up -d
# → WP su http://localhost:8080
# → phpMyAdmin su http://localhost:8081

# 2. Setup WP (prima volta): http://localhost:8080/wp-admin
#    Attiva il tema "Lomais" (il parent Ficus viene caricato automaticamente)

# 3. Avvia Vite in modalità dev
cd wp-content/themes/lomais
nvm use
npm install   # solo la prima volta
npm run dev
```

## Build produzione

```bash
cd wp-content/themes/lomais
npm run build
# Output in assets/dist/ — già in .gitignore
```

## Brand

| Token         | Valore    | Uso                        |
|---------------|-----------|----------------------------|
| primary       | `#1a6236` | Verde Lomais               |
| secondary     | `#e5ce00` | Giallo                     |
| giallo-100    | `#FCFAE5` | Background giallo chiaro   |
| giallo-200    | `#F2F1BF` | Background giallo medio    |
| giallo-300    | `#F7F0B2` | Background giallo intenso  |
| surface       | `#f0f0f0` | Sfondo neutro              |
| text          | `#000000` | Testo principale           |

Font: **Clash Display** (headings, slug `serif`) + **Open Sans** (body, slug `sans`)  
File in `wp-content/themes/lomais/assets/fonts/`

## Aggiornamenti automatici (GitHub Updater)

Il tema si aggiorna da GitHub tramite `Ficus_GitHub_Updater`.  
Il repo di riferimento è `finoz/wpt-lomais`. Nessun plugin richiesto.

Per repo privati, aggiungi in `wp-config.php`:
```php
define( 'FICUS_GITHUB_TOKEN', 'ghp_...' );
```

### Procedura di rilascio

Un semplice push non innesca aggiornamenti WP: serve una **GitHub Release** con tag semver.

```bash
# 1. Bump versione in wp-content/themes/lomais/style.css
#    Version: 1.0.0 → 1.1.0

# 2. Commit e push
git add .
git commit -m "release: v1.1.0 - descrizione modifiche"
git push

# 3. Crea tag + release in un colpo solo
gh release create v1.1.0 --generate-notes
# --generate-notes popola automaticamente le note dai commit dall'ultima release
# oppure scrivi le note a mano: --notes "Descrizione modifiche"
```

Il tag deve corrispondere al valore `Version:` in `style.css`, preceduto da `v`.  
Esempio: `Version: 1.1.0` → tag `v1.1.0`.

## Struttura

```
wpt-lomais/
  docker-compose.yml
  wp-content/
    themes/
      lomais/             ← child theme (questo repo)
        assets/
          fonts/          ← woff2 self-hosted
          scss/           ← sorgenti SCSS
          ts/             ← sorgenti TypeScript
          dist/           ← output Vite (gitignored)
        functions.php
        style.css
        theme.json        ← brand token (colori, font, scale)
        vite.config.ts
        package.json
```

> Il parent `wpt-ficus` non è incluso nel repo - viene montato via Docker da `../wpt-ficus`.
