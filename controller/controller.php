<?php

require('model/HomeManager.php');
require('model/ContactManager.php');

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