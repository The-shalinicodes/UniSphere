<?php
/**
 * Club Management System - Main Entry Point
 * 
 * This file serves as the main entry point for the Club Management System.
 * It redirects users to the appropriate interface based on their role.
 */

// Start session
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect based on user role
    switch ($_SESSION['user_role']) {
        case 'admin':
        case 'superadmin':
            header('Location: backend/admin/admindashboard.php');
            break;
        case 'member':
            header('Location: frontend/pages/member.html');
            break;
        default:
            header('Location: frontend/pages/index.html');
    }
} else {
    // Redirect to main website
    header('Location: frontend/pages/index.html');
}
exit();
?>
