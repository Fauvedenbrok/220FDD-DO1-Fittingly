<?php
/**
 * config.php
 *
 * Returns an array of configuration settings for the application.
 * This file is mainly used for storing SMTP and email settings.
 *
 * Keys:
 * - smtp_host: The SMTP server host.
 * - smtp_user: The SMTP username (usually the email address).
 * - smtp_pass: The SMTP password.
 * - smtp_port: The SMTP server port.
 * - smtp_encryption: The encryption method for SMTP (e.g., 'tls').
 * - from_email: The default sender email address.
 * - from_name: The default sender name.
 *
 * @return array Configuration settings for email and SMTP.
 */
return [
    'smtp_host' => 'send.one.com',
    'smtp_user' => 'info.fittingly@dumpvanplaatjes.nl',
    'smtp_pass' => 'fittingly',
    'smtp_port' => 587,
    'smtp_encryption' => 'tls',
    'from_email' => 'info.fittingly@dumpvanplaatjes.nl',
    'from_name' => 'Fittingly'
];
