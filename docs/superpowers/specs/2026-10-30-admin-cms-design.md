# OneCoreVisa admin CMS

Status: proposed for approval. Languages requested: English and Indonesian only.

## Intent

Provide a working admin panel to manage website copywriting, page content, articles, categories, and services without editing PHP or Blade. Use the actual free Tabler admin template, integrated into the existing Laravel 12 application.

## Approach

The recommended approach is Laravel controllers, Blade views, Eloquent models, and the existing database. It fits the current public site and session infrastructure and avoids a separate application to deploy. A separate SPA adds API and authentication work without a requested benefit; a hosted CMS adds an external service and content synchronization. The user specified Tabler Free and EN/ID; the integrated architecture is the implementer's recommendation.

## Admin experience

- `/admin/login`: email/password authentication with throttling, session regeneration, logout, and explicit administrator authorization. No public registration. Supply an interactive Artisan command to create the initial administrator without hardcoded credentials.
- `/admin`: overview with real record counts and links to the five management areas.
- Copywriting: searchable existing strings grouped by website area; English and Indonesian fields for navigation, headings, descriptions, labels, and calls to action. Stable internal keys remain hidden from normal editing. Changes appear in the corresponding public locations.
- Content: edit structured homepage sections and supporting page content, including hero slides, about content, service highlights, process steps, FAQs, contact information, and images as applicable to the existing site. Provide normal labeled fields and repeatable item controls, rather than exposing raw JSON. Editing content must not execute arbitrary HTML or Blade.
- Articles: searchable list, category filter, create/edit/delete with confirmation, EN/ID title, slug, excerpt, formatted body, cover image and alt text, SEO title/description, draft/published status and publication date. Published articles have working public index and detail pages, and appear in the homepage news area. Drafts and future publications are inaccessible publicly. Provide authenticated preview. Rich text must be sanitized server-side.
- Categories: manage article and service categories with clearly separated type, EN/ID labels/descriptions, slug, ordering, image when used, and active state. Prevent deletion while referenced. Existing service categories retain their current public slugs; prevent edits that would break existing URLs. New service categories must have working public listing pages.
- Services: manage visa and legal services with category, stable slug/code, EN/ID title, summary, stay duration, processing time, validity, requirements, allowed/prohibited activities, inclusions, image, ordering and publication state. Manage existing price structures, currencies, duration options and notes with normal form fields. Field visibility follows visa/legal service type. Draft services are excluded from public lists and return 404 on public detail pages.
- Lists provide pagination, search, empty states and success feedback. Forms retain input after validation errors. All destructive actions use POST/DELETE plus CSRF and confirmation.

The admin interface labels will be Indonesian as an implementer default; content editors show EN/ID fields clearly. One administrator role is sufficient for this scope. No additional approval workflow, user-management UI, or audit-history product is proposed.

## Visual direction

Use Tabler Free with its actual layout, tables, forms, validation, responsive navigation and components. White/light default, blue primary actions and existing OneCoreVisa logo. ENERGY 1 / RHYTHM 1 / MOTION 1: predictable data-entry screens with restrained interaction feedback. Use a persistent sidebar on desktop and collapsible navigation on mobile. These choices support frequent editing and recognizable Tabler behavior. Bundle pinned assets locally and retain their MIT license. Do not include premium components.

## Public integration and compatibility

Import existing copy, content, service categories, services, legal content and pricing into the database using an idempotent command/seeder. Re-running imports must not overwrite administrator edits. Extract current source data into a dedicated legacy source/provider where useful rather than maintaining two competing catalogs. No fabricated articles or replacement marketing claims.

The database becomes the source of truth for imported EN/ID content after initialization. The website must remain usable before initial content import, with existing source data as a defined fallback. Query content once per request or cache by content version; avoid per-string database queries. Invalidate any relevant cache after writes.

Keep current service routes and deliberate legacy redirects, including category/source-category mapping, ordering, and price-option behavior. Preserve current C13/C14 stay wording while importing. Existing RU/ES public behavior remains available through its current translation mechanism; new admin translation fields and translated article publishing are EN/ID only. Do not generate RU/ES translations. Existing legacy content should remain available to those locales without exposing draft records.

Article categories are separate from service categories. Published article detail and index pages need EN/ID URLs or language parameters consistent with existing routing, appropriate SEO/canonical/hreflang handling for available translations, and sitemap entries. Update the news navigation to a working article destination as needed.

## Data and safety

Use typed models/tables for categories, services and articles, with EN/ID attributes (JSON translation attributes or translation tables chosen by the implementer). Structured page content and copy strings use stable keys and validated shapes. Relational references, unique slugs and nonnegative prices are enforced. Resolve uploads through one image-handling implementation with server-side MIME/size validation; accept JPEG/PNG/WebP and reject SVG or executable formats. Keep existing image paths working, and never delete shared legacy assets when replacing an upload.

Restrict all admin endpoints, preview routes and writes to explicitly authorized admin users. Hash passwords using Laravel facilities and do not log credentials. Validate and sanitize rich text; escape plain copy. Use database transactions for multi-record edits and imports. Preserve existing published data if a transaction fails. Document migration, storage and initial-user setup in the repository.

## Validation and delivery

Verify authentication, authorization, CRUD validation, publication visibility, EN/ID output, upload validation, sanitized article content, import idempotency, category reference protection, cache invalidation, and existing service URL/price compatibility with meaningful automated tests. Run the existing test suite and asset build. Perform browser checks for login, each management module, an end-to-end edit reaching the public website, published versus draft articles/services, and desktop/mobile navigation and forms. Report any environment limitation explicitly.

Deliver the implemented local application and setup instructions. Production deployment is outside this request.
