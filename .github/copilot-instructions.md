## Quick orientation for automated coding agents

This repository is a Laravel (v12+) backend with an Inertia + Vue 3 frontend (Vite). The goal of this file is to surface concrete, discoverable knowledge so an AI agent can make safe, useful edits quickly.

### Quick start (commands you can run locally)
- Install PHP deps: `composer install`
- Install node deps: `npm install`
- Local frontend dev: `npm run dev` (starts Vite)
- Full dev (backend + queue + pail + vite): run `composer dev` (see `composer.json` -> `scripts.dev` which uses `concurrently`)
- Run tests: `composer test` (this clears config then runs `php artisan test`, see `phpunit.xml` for test env overrides)

### Big-picture architecture (what to read first)
- Laravel app: `app/` (Controllers, Models, Requests, Middleware). Single-responsibility controllers and many resource controllers are used.
- Routes: `routes/web.php` — shows major entry points and nested resource routing (notably products -> clusters -> blocks -> graves).
- Frontend: Vite + Inertia + Vue 3. Inertia pages are referenced in routes with `Inertia::render('...')`; check `resources/js` for the matching Vue pages/components.
- SSR: `composer dev:ssr` and `npm run build:ssr` are present — project supports server-side rendering via Laravel + Inertia SSR commands (see `composer.json`).

### Project-specific conventions and patterns
- Resource routes are widely used. Example: nested resource routes for clusters -> blocks -> graves in `routes/web.php`.
- Routes often map directly to controller classes (e.g., `ProvinceController::class`) and to Inertia pages (e.g., `Inertia::render('Admin/Dashboard/Index')`). When adding pages, keep the Inertia page path consistent with `resources/js/Pages` or the repo's pages folder.
- Autoloaded helpers: `app/Helpers/helpers.php` is loaded via Composer `autoload.files` — prefer adding small project helpers there when needed.
- Permissions: uses `spatie/laravel-permission`. Role/permission checks will likely follow that package's patterns.
- Ziggy (`tightenco/ziggy`) is used to expose Laravel routes to JS — use Ziggy for generating route URLs client-side.

### Tests, CI, and environment
- Tests run via Pest / PHPUnit. See `phpunit.xml` — it sets testing env variables (DB_DATABASE=testing, QUEUE_CONNECTION=sync, etc.). Tests may expect an in-memory or sqlite testing DB. Composer's `post-create-project-cmd` will create `database/database.sqlite` and run migrations when a project is created.
- Use `composer test` to run the test suite; for single tests use `php artisan test --filter=Name`.

### Integration points & external deps
- Key packages: `inertiajs/inertia-laravel`, `@inertiajs/vue3`, `laravel/framework`, `spatie/laravel-permission`, `tightenco/ziggy`, Vite + Vue plugins (see `package.json`).
- Background jobs: `php artisan queue:listen` is used in local dev (`composer dev` runs it). Many dev scripts expect the queue to run in-process or sync (testing sets QUEUE_CONNECTION=sync).

### Where to look for common edits
- Add/modify API endpoints or views: `routes/web.php`, `app/Http/Controllers/*`, `resources/js/Pages/*`.
- Models and relationships: `app/Models/*` (Grave, GraveBlock, GraveCluster, etc.).
- Business rules: look for `app/Http/Requests/*` for validation and `app/Services` if present.

### Helpful grep patterns
- Find Inertia page names: `grep -R "Inertia::render" -n routes/ app/`
- Find resource routes: `grep -R "Route::resource" -n routes/`
- Find models: `ls app/Models`

### Safety and assumptions
- Do not assume additional build tooling beyond Composer + NPM/Vite unless you find it in `composer.json`/`package.json`.
- Database migrations and `php artisan migrate` are present; running migrations in a CI or dev environment may alter state — prefer using sqlite testing DB when running unit tests.

If any section is unclear or you'd like more details (for example exact Inertia pages paths or where frontend pages live), tell me which area to expand and I'll update this file.
