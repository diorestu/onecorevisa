# OneCoreVisa Admin CMS

Panel: `/admin/login`. Uses locally bundled Tabler Free 1.4.0 (MIT), with Indonesian interface labels and English/Indonesian content fields.

## Setup

Run from the project root with the normal application environment configured:

```sh
php artisan migrate
php artisan cms:import
php artisan storage:link
php artisan admin:create
npm install
npm run build
```

`admin:create` asks for name, unique email, and a password of at least 12 characters. There is no default administrator/password and no public registration. Existing users have no administrator access unless explicitly granted. The administrator flag is not mass assignable.

`cms:import` imports existing service categories, 52 services, existing price structures, copy strings and structured page content. It runs in a transaction and preserves existing edits, publication settings and deleted services on subsequent runs. Existing source data provides a fallback before initialization. No articles are invented or seeded.

The public storage disk must be writable and `public/storage` must point to `storage/app/public`. Images accept JPEG, PNG and WebP, up to 5 MB each. Original assets remain in their existing locations. Replaced uploads are retained to avoid deleting shared images.

### SQLite permissions and login 419

SQLite needs write access to both the database file and its parent directory to create journal/WAL files. Running migrations as root can leave the directory owned by root even when the database file belongs to the PHP-FPM user. On the OneCoreVisa aaPanel server, PHP-FPM runs as `www` and the database is `database/database.sqlite`:

```sh
chown www:www database database/database.sqlite
chmod 775 database
chmod 664 database/database.sqlite
```

Use the actual PHP-FPM user and configured SQLite path on other servers. Do not apply these ownership commands recursively to application source files. Preserve the same write access for existing SQLite journal/WAL sidecar files, if present.

This deployment failure can present as login HTTP 419 with an empty `sessions` table: Laravel's database session handler catches an INSERT exception and attempts an UPDATE, which can affect zero rows without persisting the new session. A root CLI write test can succeed while the web process fails. Check permissions as the PHP-FPM user; do not disable CSRF or regenerate `APP_KEY` to address this problem.

Reference: [SQLite journal-file locations](https://www.sqlite.org/tempfiles.html#rollback_journals).

## Editing

- **Copywriting:** search existing text and edit EN/ID. Stable keys and template placement are managed by the application. Saving changes public text immediately.
- **Konten Halaman:** edit the hero image/identity, service highlights, visa purposes, application steps, FAQs, contact information, and legacy service landing-page content. Fields and repeatable items are labeled. For paired homepage highlights/visa purposes, maintain the same number and order of items in EN/ID. WhatsApp uses country code and digits only, without `+`.
- **Artikel:** title, excerpt, body, cover, alt text and SEO metadata in both languages. The body editor uses Markdown, with formatting buttons; raw HTML is stripped and unsafe links are disabled when rendered. Save before opening authenticated EN/ID previews. Set `Published` to publish, optionally with a future publication time. The form states the application timezone. Drafts, future articles, and articles in inactive categories are private. Published articles appear at `/articles`, on the homepage and in the sitemap.
- **Kategori:** distinguish article categories from service categories. Categories referenced by articles/services cannot be deleted; built-in service categories can be deactivated. Deactivation hides their services publicly. Existing service category slugs are locked to preserve public URLs.
- **Layanan:** visa/legal fields, requirements, inclusions, ordering, publication and image. Prices support base IDR, optional USD supplements, EN/ID notes and repeated duration/price options. An empty price gives a consultation quote. Each price option needs IDR and both language labels. Slug and category are locked after the first save to preserve URLs. Delete removes the service from public results while retaining an internal tombstone so import does not recreate it.

Lists provide search, pagination and relevant category/status filters. Validation retains text input; file selections must be selected again after an error. Forms warn before leaving unsaved changes and disable the save button while submitting.

RU/ES continue using the site's existing public translation behavior; this admin only edits EN/ID. New article pages accept EN/ID only. No production deployment is performed by these setup steps automatically.

## Verification

Automated verification: `php artisan test`, `vendor/bin/pint --dirty --test`, `npm run build`, and `php artisan view:cache`.

`AdminSessionTest` explicitly enables CSRF checking and verifies that a database-backed session retains its token over HTTPS, accepts a valid administrator login, and still rejects a tokenless login with HTTP 419. Ordinary Laravel feature tests bypass CSRF by default, so the explicit coverage is necessary.

The feature suite exercises explicit admin authorization, login/logout, initial-account creation, idempotent import, EN/ID public edits, all imported service save/render paths, reference-protected categories, image MIME validation, nested uploads, sparse repeater uploads, draft/future/category publication visibility, article sanitization, preview authorization, category filtering and discovery.

Browser QA uses an isolated temporary SQLite database and a temporary QA administrator. Browser plugin was unavailable; validation uses the Playwright CLI. Check login, each management module, copy/content edits reaching the public page, article draft/preview/publish, category filtering/deletion protection, service editing, removal/addition of repeater items, and responsive navigation at 1440×1000 and 390×844. Evidence is kept outside the repository under `/tmp/onecore-cms-evidence` for this session.
