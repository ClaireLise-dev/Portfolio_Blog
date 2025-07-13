<?php

require('model/HomeManager.php');
require('model/ContactManager.php');
require('model/ProjectManager.php');
require('model/AdminManager.php');

function displayHome() {
    $model = new HomeManager();
    $projects = $model->getProjects();
    require('view/homeView.php');
}

function displayContact() {
    $model= new ContactManager();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if ($model->saveMessage($name, $email, $message)) {
            $successMessage = "Votre message a été envoyé avec succès.";
        } else {
            $errorMessage = "Une erreur est survenue lors de l'envoi de votre message.";
        }
    }               
    require('view/contactView.php');
}

function displayProject() {
    if (!isset($_GET['id']) || !isset($_GET['type'])) {
        $errorMessage = "Projet introuvable.";
        require('view/projectWebView.php');
        return;
    }

    $id = (int) $_GET['id'];
    $type = $_GET['type'];

    $manager = new ProjectManager(); 
    $project = $manager->getProjectById($id, $type);

    if (!$project) {
        $errorMessage = "Projet non trouvé.";
    }

    switch ($type) {
        case 'wordpress':
            require('view/projectWordpressView.php');
            break;
        case 'projects':
            require('view/projectWebView.php');
            break;
        default:
            require('view/articleView.php');
            break;
    }
}

function displayLoginForm(){
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $errorMessage = "Veuillez remplir tous les champs.";
        } else {
            $adminManager = new AdminManager();
            $admin = $adminManager->getAdminByEmail($email);

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = $admin['email'];
                $successMessage = "Connexion réussie !";
                header('Location: ?page=admin');
            } else {
                $errorMessage = "Email ou mot de passe incorrect.";
            }
        }
    }
    require('view/loginView.php');
}

function displayAdmin() {
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: ?page=login');
        exit;
    }

    $manager = new ProjectManager();
    $projects = $manager->getAll('projects');
    $wordpress = $manager->getAll('wordpress');
    $articles = $manager->getAll('articles');

    require('view/adminView.php');
}

function displayAddProjectForm() {
    require('view/addProjectView.php');
}


function addProject() {
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: ?page=login');
        exit;
    }

    $manager = new ProjectManager();

    $type = $_POST['type'] ?? '';
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $image = $_FILES['image']['name'] ?? '';


    if ($image && isset($_FILES['image']['tmp_name'])) {
        $target = 'public/img/' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $data = [
        'title' => $title,
        'subtitle' => $subtitle,
        'image' => $image
    ];

    if ($type === 'projects') {
        $data += [
            'description' => $_POST['description'] ?? '',
            'features' => $_POST['features'] ?? '',
            'technologies' => $_POST['technologies'] ?? '',
            'site_link' => $_POST['site_link'] ?? '',
            'github_link' => $_POST['github_link'] ?? ''
        ];
    } elseif ($type === 'wordpress') {
        $data += [
            'description' => $_POST['description'] ?? '',
            'features' => $_POST['features'] ?? '',
            'role' => $_POST['role'] ?? '',
            'site_link' => $_POST['site_link'] ?? ''
        ];
    } elseif ($type === 'articles') {
        $data += [
            'content' => $_POST['content'] ?? ''
        ];
    } else {
        $errorMessage = "Type de projet non reconnu.";
        require('view/addProjectView.php');
        return;
    }

    $success = $manager->insertProject($type, $data);

    if ($success) {
        $successMessage = "Projet ajouté avec succès.";
    } else {
        $errorMessage = "Erreur lors de l'ajout du projet.";
    }

    require('view/addProjectView.php');
}

function displayEditProjectForm()
{
    if (!isset($_GET['id']) || !isset($_GET['type'])) {
        $errorMessage = "ID ou type de projet manquant.";
        require 'view/editProjectView.php';
        return;
    }

    $id = $_GET['id'];
    $type = $_GET['type'];

    $projectManager = new ProjectManager();

    $project = $projectManager->getProjectById($id, $type);

    if (!$project) {
        $errorMessage = "Projet introuvable ou type invalide.";
    }

    require 'view/editProjectView.php';
}

function updateProject() {
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: ?page=login');
        exit;
    }

    $manager = new ProjectManager();

    $type = $_POST['type'] ?? '';
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $image = $_FILES['image']['name'] ?? '';

    if ($image && isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name']) {
        $target = 'public/img/' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $existing = $manager->getProjectById($id, $type);
        $image = $existing['image'] ?? '';
    }

    $data = [
        'title' => $title,
        'subtitle' => $subtitle,
        'image' => $image
    ];

    if ($type === 'projects') {
        $data += [
            'description' => $_POST['description'] ?? '',
            'features' => $_POST['features'] ?? '',
            'technologies' => $_POST['technologies'] ?? '',
            'site_link' => $_POST['site_link'] ?? '',
            'github_link' => $_POST['github_link'] ?? ''
        ];
    } elseif ($type === 'wordpress') {
        $data += [
            'description' => $_POST['description'] ?? '',
            'features' => $_POST['features'] ?? '',
            'role' => $_POST['role'] ?? '',
            'site_link' => $_POST['site_link'] ?? ''
        ];
    } elseif ($type === 'articles') {
        $data += [
            'content' => $_POST['content'] ?? ''
        ];
    } else {
        $errorMessage = "Type de projet non reconnu.";
        require('view/editProjectView.php');
        return;
    }

    $success = $manager->updateProject($type, $id, $data);

    if ($success) {
        header('Location: ?page=admin');
        exit;
    } else {
        $errorMessage = "Erreur lors de la mise à jour du projet.";
        $project = $manager->getProjectById($id, $type);
        require('view/editProjectView.php');
    }
}



function deleteProject() {
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: ?page=show-login');
        exit;
    }

    $id = $_GET['id'] ?? null;
    $type = $_GET['type'] ?? null;

    if (!$id || !$type) {
        echo "Paramètres manquants.";
        exit;
    }

    $manager = new ProjectManager();
    $manager->deleteProject((int) $id, $type);

    header('Location: ?page=admin');
    exit;
}