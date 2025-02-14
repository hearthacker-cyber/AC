<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// If you want to destroy the session cookie, you can do so like this:
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: login.html"); // Change to your login page or homepage
exit();
?>
