<?php
// On inclut le fichier Manager.php qui contient la classe mère (gestion PDO)
require_once __DIR__ . '/Manager.php';

class HomeManager extends Manager
{
    // Constructeur : initialise la connexion à la base dès la création de l'objet
    public function __construct()
    {
        $this->connection();
    }

    // Récupère tous les projets (table 'projects') triés du plus récent au plus ancien
    public function getProjects()
    {
        $bdd = $this->getPDO(); // Récupération de l'objet PDO
        $requete = $bdd->query('SELECT * FROM projects ORDER BY id DESC');
        return $requete->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les projets sous forme de tableau associatif
    }

    // Récupère tous les articles (table 'articles'), les plus récents d'abord
    public function getArticles()
    {
        $bdd = $this->getPDO();
        $requete = $bdd->query('SELECT * FROM articles ORDER BY id DESC');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère tous les projets WordPress (table 'wordpress'), les plus récents d'abord
    public function getWordpress()
    {
        $bdd = $this->getPDO();
        $requete = $bdd->query('SELECT * FROM wordpress ORDER BY id DESC');
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}

