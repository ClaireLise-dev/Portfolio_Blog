<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('controller/controller.php');

try {
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'home') {
            displayHome();
        } elseif ($_GET['page'] == 'contact') {
            displayContact();
        } elseif ($_GET['page'] == 'project') {
            displayProject();
        } elseif ($_GET['page'] == 'login') {
            displayLoginForm();
        } elseif ($_GET['page'] == 'admin') {
            displayAdmin();
        } elseif ($_GET['page'] == 'add-project') {
            displayAddProjectForm(); 
        } elseif ($_GET['page'] == 'submit-project') {
            addProject(); 
        } elseif ($_GET['page'] === 'edit') {
            displayEditProjectForm();
        } elseif ($_GET['page'] === 'update-project') {
            updateProject();
        } elseif ($_GET['page'] == 'delete') {
            deleteProject();
        }elseif ($_GET['page'] === 'logout') {
            logoutAdmin();
        }else {
            throw new Exception('Page introuvable');
        }
    } else {
        displayHome();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}