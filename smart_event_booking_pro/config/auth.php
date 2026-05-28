<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
function require_login(){ if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; } }
function require_admin(){ require_login(); if(($_SESSION['role'] ?? '') !== 'admin'){ header('Location: dashboard.php?error=admin'); exit; } }
function e($value){ return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function current_user(){ return $_SESSION['name'] ?? 'Guest'; }
function is_admin(){ return ($_SESSION['role'] ?? '') === 'admin'; }
?>