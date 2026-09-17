# WordPress & Hosting Support Playbook

Practical support workflow for WordPress websites, cPanel/WHM hosting, DNS, SSL, email, backups, migrations and incident troubleshooting.

## 1. Initial triage

1. Confirm the affected domain, service and exact symptom.
2. Check whether the issue is site-wide, page-specific, user-specific or network-specific.
3. Capture the error message, HTTP status and approximate start time.
4. Check recent changes: plugin/theme updates, PHP version, DNS changes, migrations, SSL renewals or server maintenance.
5. Preserve evidence before making changes.

## 2. WordPress incident workflow

- Confirm the site and `/wp-admin/` response.
- Check PHP errors and application logs.
- Verify disk space, file permissions and database connectivity.
- Isolate plugin conflicts safely.
- Check the active theme and child-theme customizations.
- Review WordPress core, plugin and theme update status.
- Confirm rewrite rules and `.htaccess` where applicable.
- Clear application/server/CDN caches only after identifying the likely fault domain.
- Test forms, login, checkout and other business-critical workflows after repair.

## 3. cPanel / WHM checks

- Account status and resource limits
- Disk and inode usage
- PHP version and required extensions
- File ownership and permissions
- Database/user assignments
- Cron jobs
- Error logs
- Backup availability
- SSL status
- DNS-zone consistency
- Mail routing and mailbox quota

## 4. DNS and domain troubleshooting

Check:

- Nameservers
- A / AAAA records
- CNAME records
- MX records
- SPF, DKIM and DMARC
- TTL and propagation state
- Whether the domain resolves to the intended server

Avoid making multiple DNS changes at once. Record the previous values before editing.

## 5. SSL troubleshooting

- Confirm certificate validity and hostname coverage.
- Check the full certificate chain.
- Confirm HTTP-to-HTTPS redirects.
- Check for mixed-content requests.
- Verify AutoSSL or certificate-renewal status.
- Re-test both `www` and non-`www` hostnames when used.

## 6. Business email support

- Confirm MX routing.
- Check mailbox quota and authentication settings.
- Verify SPF, DKIM and DMARC.
- Test inbound and outbound delivery separately.
- Review mail logs where available.
- Check whether the domain uses local mail, Google Workspace, Microsoft 365, Zoho or another provider before changing routing.

## 7. Backup and restore workflow

Before significant changes:

1. Create or confirm a current file backup.
2. Export the database.
3. Record the current PHP version and important configuration.
4. Confirm the restore method.

After restoration, verify login, forms, database-driven pages, media, SSL and scheduled jobs.

## 8. Website migration workflow

1. Audit source hosting and application requirements.
2. Take current files and database backup.
3. Prepare destination PHP/database configuration.
4. Transfer files and database.
5. Update configuration and URLs where required.
6. Test using a temporary host mapping or staging URL where possible.
7. Lower DNS TTL before planned cutover when appropriate.
8. Change DNS only after destination validation.
9. Re-issue/verify SSL.
10. Test forms, email, login, checkout and scheduled tasks.
11. Keep the old environment available during the rollback window.

## 9. Security baseline

- Never commit passwords, API keys or production configuration to Git.
- Use least-privilege accounts.
- Keep WordPress core, plugins and themes maintained.
- Remove abandoned extensions and unused admin accounts.
- Enforce strong passwords and MFA where available.
- Protect backups and private uploads.
- Review suspicious admin changes and unexpected file modifications.

## 10. Support communication

A useful incident update should state:

- What is affected
- What has been confirmed
- What action was taken
- Whether service is restored
- Any follow-up or monitoring needed

Avoid claiming resolution until the user-facing workflow has been tested.

## 11. Closure checklist

- Root cause identified or clearly documented
- Fix applied
- Website and admin tested
- Forms/email/checkout tested where applicable
- SSL and DNS verified
- Backup state confirmed
- Changes documented
- Client/user informed in plain language

## Career relevance

This playbook reflects hands-on WordPress development, cPanel/WHM administration, DNS, SSL, email, migration, backup/restore and production-support practices used in website and hosting support work.
