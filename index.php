<?php 

require('controller/Controller.php');

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
        } elseif ($_GET['page'] == 'delete-project') {
            deleteProject();
        }else {
            throw new Exception('Page introuvable');
        }
    } else {
        displayHome();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}