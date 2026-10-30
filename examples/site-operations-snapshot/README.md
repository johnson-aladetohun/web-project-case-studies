# Site Operations Snapshot — WordPress Support Demo

**Type:** Original, standalone sample plugin for portfolio review. **Not** client production code.

**Skills demonstrated:** WordPress/PHP hooks, administration screens, role/capability checks, safe output escaping, operational diagnostics, documentation, and honest limitation reporting.

## What it does

Creates **Tools → Site Ops Snapshot**, a **read-only** WordPress administrator page displaying:

| Check | What it helps triage | What it does *not* establish |
| --- | --- | --- |
| WordPress version | Version inventory | Whether updates are safe |
| PHP version and memory limit | Hosting compatibility | Available server resources |
| Homepage HTTPS scheme | Basic URL configuration | Certificate validity or mixed-content status |
| WP-Cron configuration | Whether built-in cron is disabled | Whether an external cron job exists |
| Active site plugin count | Plugin inventory | Whether plugins are safe or compatible |

It links to the official WordPress Site Health screen. **Nothing is modified, transmitted, stored, or uploaded.**

## Run locally

1. Create a test WordPress installation with PHP 7.4 or higher.
2. Copy [site-operations-snapshot.php](site-operations-snapshot.php) to `wp-content/plugins/site-operations-snapshot/site-operations-snapshot.php`.
3. Activate **Site Operations Snapshot (Portfolio Demo)** in **Plugins**.
4. Sign in with a WordPress administrator account and open **Tools → Site Ops Snapshot**.
5. Compare observations with WordPress **Tools → Site Health** and hosting control-panel checks.
6. Disable or remove the demo after review.

**Do not install on a customer or production site without authorization and staging validation.**

## Safety decisions

- `ABSPATH` guard prevents direct script execution.
- `manage_options` capability controls page registration and viewing.
- Values and labels are output via `esc_html()`; the Site Health link uses `esc_url()`.
- No custom database queries, AJAX endpoints, REST routes, settings mutations, file reads, or external HTTP requests.
- No secrets, client configuration files, API keys or user/customer records are included.
- Checking the homepage URL scheme is *not* a certificate/SSL audit.
- WP-Cron being disabled may be expected when an external cron schedule is installed.

## Suggested manual checks

- An administrator can open the page; a subscriber/editor cannot access it.
- A local site using an HTTP home URL shows “Needs review” instead of claiming HTTPS.
- Turning off WP-Cron in a **local test only** changes its descriptive status.
- All values are escaped; no input or modification controls appear.
- The sample is disabled and removed without leaving application data behind.

## Intended interview walkthrough

> “This is an intentionally limited and read-only tool. It demonstrates that I can write a WordPress admin page safely, distinguish signals from proof, and document what support engineers should verify next.”

See the [WordPress & Hosting Support Playbook](../../wordpress-hosting-support-playbook/README.md) for the wider troubleshooting process.

**Status:** Source example supplied for review. No automated or production testing is claimed.
