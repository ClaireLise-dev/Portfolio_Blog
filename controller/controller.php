<?php

// Inclusion des gestionnaires de données (modèles)
require('model/HomeManager.php');
require('model/ContactManager.php');
require('model/ProjectManager.php');
require('model/AdminManager.php');

// Affiche la page d’accueil avec les projets récupérés via HomeManager
function displayHome()
{
    $model = new HomeManager();
    $projects = $model->getProjects();
    require('view/homeView.php');
}

// Affiche la page de contact et traite l’envoi du formulaire si POST
function displayContact()
{
    $model = new ContactManager();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sécurisation des entrées utilisateur
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Enregistrement du message
        if ($model->saveMessage($name, $email, $message)) {
            $successMessage = "Votre message a été envoyé avec succès.";
        } else {
            $errorMessage = "Une erreur est survenue lors de l'envoi de votre message.";
        }
    }
    require('view/contactView.php');
}

// Affiche un projet selon son type et son ID (web, wordpress, article)
function displayProject()
{
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

    // Choix de la vue à afficher selon le type de projet
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

// Affiche le formulaire de connexion et gère la connexion + cookie « remember me »
function displayLoginForm()
{
    session_start();
    if (isset($_SESSION['admin'])) {
        header('Location: ?page=admin');
        exit;
    }

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

                // Gestion du cookie « se souvenir de moi »
                if (!empty($_POST['remember_me'])) {
                    $token = bin2hex(random_bytes(32));
                    setcookie('remember_token', $token, time() + 3600 * 24 * 30, '/', '', false, true);
                    $adminManager->storeRememberToken($admin['id'], $token);
                }

                header('Location: ?page=admin');
                exit;
            } else {
                $errorMessage = "Email ou mot de passe incorrect.";
            }
        }
    }

    require('view/loginView.php');
}

// Affiche la page d'administration avec liste des projets (si connecté)
function displayAdmin()
{
    session_start();

    // Connexion automatique via cookie si présent
    if (!isset($_SESSION['admin']) && isset($_COOKIE['remember_token'])) {
        $adminManager = new AdminManager();
        $admin = $adminManager->getAdminByToken($_COOKIE['remember_token']);
        if ($admin) {
            $_SESSION['admin'] = $admin['email'];
        }
    }

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

// Affiche le formulaire d’ajout de projet
function displayAddProjectForm()
{
    require('view/addProjectView.php');
}

// Traite l’ajout d’un nouveau projet depuis le formulaire admin
function addProject()
{
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: ?page=login');
        exit;
    }

    $manager = new ProjectManager();

    // Récupération des données du formulaire
    $type = $_POST['type'] ?? '';
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $image = $_FILES['image']['name'] ?? '';

    // Téléchargement de l’image
    if ($image && isset($_FILES['image']['tmp_name'])) {
        $target = 'public/img/' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $data = [
        'title' => $title,
        'subtitle' => $subtitle,
        'image' => $image
    ];

    // Ajout des champs spécifiques selon le type
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

    // Enregistrement en base
    $success = $manager->insertProject($type, $data);

    if ($success) {
        $successMessage = "Projet ajouté avec succès.";
    } else {
        $errorMessage = "Erreur lors de l'ajout du projet.";
    }

    require('view/addProjectView.php');
}

// Affiche le formulaire d’édition pour un projet donné
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

// Traite la mise à jour d’un projet existant
function updateProject()
{
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

    // Gestion de l’image : si pas changée, garder l’ancienne
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

// Supprime un projet (admin uniquement)
function deleteProject()
{
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

// Déconnecte l’admin et supprime le cookie de connexion automatique
function logoutAdmin()
{
    session_start();
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/');
        $adminManager = new AdminManager();

        if (isset($_SESSION['admin'])) {
            $admin = $adminManager->getAdminByEmail($_SESSION['admin']);
            if ($admin) {
                $adminManager->storeRememberToken($admin['id'], null);
            }
        }
    }
    session_destroy();
    header('Location: ?page=home');
    exit;
}
