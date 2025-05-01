<?php

require('model/HomeManager.php');

function displayHome() {
    $model = new HomeManager();
    $projects = $model->getProjects();
    require('/view/homeView.php');
}

function displayBlog() {
    $model = new HomeManager();
    $articles = $model->getArticles();
    require ('/view/homeView.php');
    
}
