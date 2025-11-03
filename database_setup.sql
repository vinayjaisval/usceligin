-- CELIGIN OTP System Database Setup
-- Run these commands in phpMyAdmin or MySQL command line

-- 1. First, verify your database exists
USE us_devceligin;

-- 2. Create otp_verifications table
CREATE TABLE IF NOT EXISTS `otp_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `verified_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('login','registration','reset_password') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'login',
  `method` enum('phone','email') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'phone',
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otp_verifications_phone_index` (`phone`),
  KEY `otp_verifications_email_index` (`email`),
  KEY `otp_verifications_phone_created_at_index` (`phone`,`created_at`),
  KEY `otp_verifications_email_created_at_index` (`email`,`created_at`),
  KEY `otp_verifications_otp_code_expires_at_index` (`otp_code`,`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Add new columns to users table
ALTER TABLE `users`
ADD COLUMN `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `email`,
ADD COLUMN `phone_verified_at` timestamp NULL DEFAULT NULL AFTER `email_verified_at`,
ADD COLUMN `last_otp_sent_at` timestamp NULL DEFAULT NULL AFTER `phone_verified_at`,
ADD COLUMN `otp_attempts_count` int(11) NOT NULL DEFAULT '0' AFTER `last_otp_sent_at`,
ADD COLUMN `is_phone_primary` tinyint(1) NOT NULL DEFAULT '0' AFTER `otp_attempts_count`;

-- 4. Add indexes to users table for performance
ALTER TABLE `users`
ADD INDEX `users_phone_index` (`phone`);

-- 5. Insert test user data (optional)
-- INSERT INTO `users` (`name`, `email`, `phone`, `password`, `created_at`, `updated_at`)
-- VALUES
-- ('Test User', 'test@celigin.com', '9876543210', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- 6. Verify tables are created correctly
SHOW TABLES LIKE 'otp_verifications';
DESCRIBE otp_verifications;
DESCRIBE users;

-- 7. Check if all required columns exist
SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = 'us_devceligin_1nov25'
AND TABLE_NAME = 'users'
AND COLUMN_NAME IN ('phone', 'phone_verified_at', 'last_otp_sent_at', 'otp_attempts_count', 'is_phone_primary');

-- 8. Cleanup old OTPs (run periodically)
-- DELETE FROM otp_verifications WHERE expires_at < DATE_SUB(NOW(), INTERVAL 1 DAY);