<?php
session_start();

// Clear all variables from $_SESSION
session_unset();

// Alternatively, you can destroy the entire session including session cookie
// session_destroy();

header("Location: AccountPage.html");
exit;