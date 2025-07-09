# Duikclub Nemo – Progressive Web App (PWA)

Welkom bij de officiële codebase van de Progressive Web App (PWA) voor **Duikclub Nemo** uit Kerkrade. Deze applicatie is ontworpen om het ledenbeheer, communicatie en de activiteitenplanning van de duikclub te digitaliseren en moderniseren.

---

## Inhoudsopgave

- [Beschrijving](#beschrijving)
- [Technische Stack](#technische-stack)
- [Functionaliteiten](#functionaliteiten)
- [Installatie](#installatie)
- [Authenticatie](#authenticatie)
- [Notificaties](#notificaties)
- [Ontwikkelrichtlijnen](#ontwikkelrichtlijnen)
- [Licentie](#licentie)

---

## Beschrijving

Deze responsieve PWA is gebouwd met Laravel 12, Vue 3 en InertiaJS, en biedt een moderne gebruikerservaring op desktop, tablet en mobiel. Gebruikers kunnen inloggen, duikactiviteiten bekijken, zich inschrijven voor evenementen, foto's en nieuwsberichten bekijken, en notificaties ontvangen.

---

## License

This project is licensed under the GNU General Public License v2 or later — see the [LICENSE](./LICENSE) file for details.


## Technische Stack

### Backend

- Laravel 12+
- PHP 8.2+
- Kreait Firebase Laravel package (push notificaties)
- Pusher WebSockets (in-app notificaties)
- MySQL (met strict mode)

### Frontend

- VueJS 3 + Composition API (`<script setup>`)
- InertiaJS v2+
- Pinia (state management)
- TailwindCSS 4
- Vite

---

## Functionaliteiten

- ✅ **Ledenbeheer** – Profielgegevens bekijken/bewerken.
- ✅ **Agenda** – Overzicht van duikactiviteiten en trainingen.
- ✅ **Nieuws** – Clubupdates en mededelingen.
- ✅ **Media Galerij** – Uploads van clubactiviteiten (foto/video).
- ✅ **Contactformulier** – Voor algemene vragen.
- ✅ **Authenticatie & Rollen** – Beheerder, lid, gast.
- ✅ **In-app notificaties** – Via Pusher (WebSockets).
- ✅ **Push notificaties** – Via Firebase.

---

## Installatie

### Vereisten

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+
- Laravel CLI

### Stappen

```bash
# Repository clonen
git clone https://github.com/jouw-org/dcnemo.git
cd dcnemo

# Dependencies installeren
composer install
npm install

# .env bestand aanmaken
cp .env.example .env

# Applicatiesleutel genereren
php artisan key:generate

# Database instellen en migreren
php artisan migrate --seed

# Vite development server starten
npm run dev

# Laravel server starten
php artisan serve
