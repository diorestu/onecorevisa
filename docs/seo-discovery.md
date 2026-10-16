# SEO, GEO, and AEO foundation

The website renders metadata and JSON-LD on the server. There are no external API keys or SEO subscriptions required.

## Deployment

Set `APP_URL` to the final HTTPS origin. If the public origin differs from `APP_URL`, set `SEO_SITE_URL` explicitly, for example `https://onecorevisa.com`. Canonical, hreflang, structured data, social image, sitemap, and llms URLs use this value. Rebuild Laravel's config cache after changing environment values (`php artisan config:cache`).

The production web server must route missing files to `public/index.php`, as with the existing service pages. `/robots.txt` is now a Laravel route so its sitemap origin follows configuration. Remove any previous static `public/robots.txt` on deployment; do not keep a stale copy in the web server or CDN.

## Included

- Unique home, category, and service titles and descriptions.
- Canonicals discard tracking parameters. English uses the clean URL; Indonesian uses `?lang=id`. Explicit locale URLs work without a session. Internal navigation retains the selected language, and EN/ID switches stay on the same page.
- Reciprocal `en`, `id`, and `x-default` hreflang in HTML and XML sitemap. Detailed service text currently remains English where the original catalog has no Indonesian translation.
- Open Graph and Twitter large-image previews with an absolute PNG image URL and image dimensions.
- Organization, WebSite, WebPage/CollectionPage, Service, and BreadcrumbList JSON-LD using the visible business and service data. No unverified address, ratings, reviews, prices, or credentials are added.
- `/sitemap.xml` lists the homepage, existing category and legacy category pages, and all catalog service details in both locales. It deliberately omits language-switch redirects and consultation submission. No artificial `lastmod` dates are generated.
- `/robots.txt` retains public crawler access and advertises the sitemap.
- `/llms.txt` offers a plain-text directory of current services and contact details. It is a supplementary discovery file, not a guarantee that AI systems will read or cite the site.
- Favicon SVG, PNG, multi-size ICO, Apple touch icon, and a 1200×630 social preview, derived from the existing OneCoreVisa logo. Regenerate with `php scripts/generate-brand-assets.php` (GD required).

## Verification and publication

Run `php artisan test` for metadata, locale, structured-data, and discovery checks. The sitemap test requests every listed URL and checks its canonical. Run `vendor/bin/pint --test` against changed PHP files for formatting.

After deployment, inspect `/robots.txt`, `/sitemap.xml`, `/llms.txt`, and the social image over the real HTTPS domain. Submit the sitemap to Google Search Console and Bing Webmaster Tools using the site owner's accounts. Validate representative home/category/detail URLs with Schema.org Validator and Google's Rich Results Test. Generic Service markup does not imply a Google rich-result feature, and FAQ rich-result markup is not added to invisible content.

This local implementation does not verify live indexing, ranking, AI citations, Search Console ownership, or CDN/firewall access by crawlers. Existing visa rules, requirements, and processing estimates still need ongoing editorial review by the business; this change does not independently validate immigration guidance.

## References

- [Google: AI features and your website](https://developers.google.com/search/docs/appearance/ai-features): the same SEO fundamentals apply; structured data should match visible text.
- [Google: localized versions](https://developers.google.com/search/docs/specialty/international/localized-versions): distinct accessible language URLs and reciprocal hreflang.
- [Google: structured data](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data): JSON-LD and eligibility guidance.
