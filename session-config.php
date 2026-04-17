<?php
// session-config.php

// Start session with secure settings
session_start([
    'cookie_lifetime' => 0, // Session cookie lasts until the browser is closed
    'cookie_secure' => true, // Only send cookie over HTTPS
    'cookie_httponly' => true, // Not accessible via JavaScript
    'cookie_samesite' => 'Strict', // CSRF protection
]);

// Set session timeout
$timeout_duration = 1800; // 30 minutes
if (isset($_SESSION['LAST_ACTIVITY'])) {
    if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration) {
        // Last request was more than $timeout_duration seconds ago
        session_unset(); // Unset $_SESSION variables
        session_destroy(); // Destroy session
    }
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time stamp

// Other security settings
ini_set('session.use_only_cookies', '1'); // Prevent session hijacking
ini_set('session.serialize_handler', 'php_serialize'); // Use PHP serialization
ini_set('session.gc_maxlifetime', $timeout_duration); // Session garbage collection

// Ensure session ID is regenerated to prevent fixation attacks
if (empty($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time(); // Store creation time
} else if (time() - $_SESSION['CREATED'] > 300) { // Session is older than 5 minutes
    session_regenerate_id(true); // Regenerate session id and delete old session
    $_SESSION['CREATED'] = time(); // Update creation time
}
?>