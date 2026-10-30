# Technical Support Incident Simulation

**Portfolio exercise; not a customer incident.** A fictional small-business WordPress site reports that its contact form stopped delivering messages after a hosting migration.

## Incoming ticket

> “The site looks normal, but enquiry emails are not arriving. We moved hosting yesterday. Can you help?”

**Impact:** Potentially missing business enquiries. **Priority:** High until intake path and data preservation are assessed.

## Triage questions

1. Which forms and recipient mailboxes are affected? When did delivery last work?
2. Are submissions stored in WordPress or the form plugin, and is there a way to export them safely?
3. Did DNS, MX, SPF, DKIM, DMARC, SMTP settings, sender address or hosting mail routing change?
4. Are there relevant server, WordPress, SMTP or mail-provider rejection logs?
5. Does the failure affect all email or just form notifications?

## Safe diagnostic sequence

1. Confirm affected form and obtain an authorized test submission, avoiding real personal data.
2. Check that the form accepts the submission and whether it reaches the plugin's internal storage.
3. Verify **MX records** and whether email is routed to the intended provider, not accidentally to the migrated hosting server.
4. Check the configured SMTP host, authenticated mailbox, encryption, sender identity, and permission scope.
5. Inspect SPF, DKIM and DMARC records for alignment; do not blindly overwrite existing records.
6. Run a controlled outbound test, record the provider response, and inspect any rejection/bounce.
7. Validate a second recipient and mailbox spam/quarantine rules if necessary.
8. Only after diagnosing the cause, propose the smallest reversible configuration change and log the prior state.

## Example client update

> We confirmed the website accepts new form submissions. Email delivery is being investigated separately, focusing on the mail route and authenticated sender configuration following the migration. No DNS settings have been changed yet. We will confirm delivery using a controlled test before marking the incident resolved.

This is sample communication, **not** evidence of a real incident being resolved.

## Resolution criteria

- Submission captured and safely retained where applicable.
- Notification accepted by the actual mail service and received in the test mailbox.
- Headers/sender authentication checked without exposing sensitive data.
- Customer confirms expected notification behavior.
- Remediation, changes and rollback plan documented.

## Skills illustrated

WordPress support, hosting migration triage, cPanel/WHM awareness, email delivery, DNS and authentication records, incident documentation, and clear customer communication.

**Do not publish:** credentials, SMTP passwords, real customer tickets, client names, mailbox addresses, logs containing personal data, or private site backups.
