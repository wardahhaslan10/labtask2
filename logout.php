<?php

session_start();

// ==========================================
// CLEAR ALL SESSION VARIABLES
// ==========================================

$_SESSION = [];

// ==========================================
// DESTROY SESSION
// ==========================================

session_destroy();
// ==========================================
// PREVENT BROWSER CACHE
// ==========================================

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// ==========================================
// REDIRECT TO PAGE 1
// ==========================================

header("Location: index.php");
exit();

?>