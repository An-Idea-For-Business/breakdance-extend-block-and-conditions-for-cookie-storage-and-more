<?php

//namespace AIFB\BDCustomElmentsAndConditions\SSRSetCookieHandler;

if (!defined('WPINC')) {
    die;
}

if (!class_exists('SSRSetCookieHandler')) {
    class SSRSetCookieHandler {
        
        const COOKIE_DISABLED = 0;
        const COOKIE_ENABLED = 1;

        /**
         * Set a custom cookie based on provided settings.
         *
         * @param array $cookieSettings Settings for the cookie.
         * @return bool True if the cookie was successfully set, false otherwise.
         */
        public static function setCustomCookie(array $cookieSettings): bool {
            $defaultSettings = [
                'name' => null,
                'value' => null,
                'date' => null,
                'path' => '/',
                'secure' => self::COOKIE_DISABLED,
                'httponly' => self::COOKIE_DISABLED,
                'samesite' => 'Strict',
                'delete' => self::COOKIE_DISABLED
            ];

            $settings = array_merge($defaultSettings, $cookieSettings);
            
            // Data sanitization
            $sanitizedSettings = array_map('sanitize_text_field', $settings);
            $sanitizedSettings['secure'] = filter_var($settings['secure'], FILTER_VALIDATE_INT) === 1;
            $sanitizedSettings['httponly'] = filter_var($settings['httponly'], FILTER_VALIDATE_INT) === 1;
            $sanitizedSettings['delete'] = filter_var($settings['delete_cookie'], FILTER_VALIDATE_INT) === 1;

            // If the "delete" option is enabled, delete the cookie
            if ($sanitizedSettings['delete']) {
                $result = setcookie($sanitizedSettings['name'], '', time() - 3600, $sanitizedSettings['path']);
                if (!$result) {
                    error_log("Unable to delete cookie {$sanitizedSettings['name']}.");
                }
                return $result;
            }

            // Data validation
            if (empty($sanitizedSettings['name']) || empty($sanitizedSettings['value']) || empty($sanitizedSettings['date'])) {
                error_log("Incomplete cookie information.");
                return false;
            }

            // Setting the cookie
            $result = setcookie(
                $sanitizedSettings['name'],
                $sanitizedSettings['value'],
                [
                    'expires' => strtotime($sanitizedSettings['date']),
                    'path' => $sanitizedSettings['path'],
                    'secure' => $sanitizedSettings['secure'],
                    'httponly' => $sanitizedSettings['httponly'],
                    'samesite' => $sanitizedSettings['samesite']
                ]
            );

            if (!$result) {
                error_log("Unable to set cookie {$sanitizedSettings['name']}.");
            }
            return $result;
        }
    }
}

// Usage
$cookieSettings = $propertiesData['content']['cookie_settings'] ?? [];
$result = SSRSetCookieHandler::setCustomCookie($cookieSettings);

if (!$result) {
    error_log("Failed to set or delete the cookie.");
}