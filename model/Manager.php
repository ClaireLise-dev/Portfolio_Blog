<?php

// Classe mère Manager : gère la connexion PDO à la base de données
class Manager
{
    // Propriété privée qui contiendra l’instance PDO
    private $pdo;

    // Méthode pour établir la connexion à la base de données
    public function connection()
    {
        // Chargement du fichier de configuration contenant les infos d'accès (host, dbname, user, pass)
        $config = require __DIR__ . '/../includes/config.php';

        try {
            // Création de l’objet PDO avec les paramètres récupérés
            $this->pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
                $config['user'],
                $config['pass']
            );

            // Définition du mode d'erreur sur exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // En cas d’échec de connexion, affichage de l’erreur et arrêt du script
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Méthode d’accès à l’objet PDO (pour les classes qui en héritent)
    public function getPDO()
    {
        return $this->pdo;
    }
}

