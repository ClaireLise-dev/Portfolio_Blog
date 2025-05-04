<?php 

require('controller/Controller.php');

try{
    if(isset($_GET['page'])){
        if($_GET['page'] == 'home'){
            displayHome();
        }elseif($_GET['page'] == 'blog'){
            displayBlog();
        }else{
            throw new Exception('Page introuvable');
        }
    }
    
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

