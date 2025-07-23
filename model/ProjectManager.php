<?php

// Inclusion de la classe Manager (connexion à la base)
require_once('Manager.php');

// Classe ProjectManager : gère les projets (web, wordpress, articles)
class ProjectManager extends Manager
{
    // Constructeur : initialise la connexion à la base dès l’instanciation
    public function __construct()
    {
        $this->connection();
    }

    // Liste blanche des tables autorisées à être manipulées
    private array $allowedTables = ['projects', 'wordpress', 'articles'];

    // Récupère un projet par son ID et son type
    public function getProjectById(int $id, string $type)
    {
        // Vérifie que la table est autorisée
        if (!in_array($type, $this->allowedTables)) {
            return false;
        }

        $bdd = $this->getPDO();
        $requete = $bdd->prepare("SELECT * FROM $type WHERE id = ?");
        $requete->execute([$id]);

        return $requete->fetch(PDO::FETCH_ASSOC); // Retourne le projet trouvé ou false
    }

    // Récupère tous les projets d’un type donné, triés par ID décroissant
    public function getAll(string $type)
    {
        if (!in_array($type, $this->allowedTables)) return [];

        $bdd = $this->getPDO();
        $requete = $bdd->query("SELECT * FROM $type ORDER BY id DESC");
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insère un nouveau projet dans la base (selon type et données associées)
    public function insertProject(string $type, array $data): bool
    {
        if (!in_array($type, $this->allowedTables)) {
            return false;
        }

        $bdd = $this->getPDO();

        // Préparation dynamique des colonnes et valeurs
        $fields = array_keys($data); // ex : ['title', 'subtitle', 'image']
        $placeholders = array_map(fn($f) => ':' . $f, $fields); // ex : [':title', ':subtitle', ':image']

        // Construction de la requête SQL
        $sql = "INSERT INTO $type (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
        $requete = $bdd->prepare($sql);

        // Lier les valeurs aux marqueurs nommés
        foreach ($data as $key => $value) {
            $requete->bindValue(":$key", $value);
        }

        return $requete->execute(); // Exécution de la requête
    }

    // Met à jour un projet existant (selon type et ID)
    public function updateProject($type, $id, $data)
    {
        $fields = [];
        $params = [];

        // Construction de la requête SET (ex: title = ?, subtitle = ?)
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $params[] = $value;
        }

        $bdd = $this->getPDO();
        $params[] = $id; // Ajout de l'ID à la fin pour le WHERE

        $sql = "UPDATE $type SET " . implode(', ', $fields) . " WHERE id = ?";

        $requete = $bdd->prepare($sql);
        return $requete->execute($params);
    }

    // Supprime un projet (et son image associée si présente)
    public function deleteProject(int $id, string $type): bool
    {
        $bdd = $this->getPDO();

        // 1. Récupérer le nom de l’image liée au projet
        $requete = $bdd->prepare("SELECT image FROM $type WHERE id = :id");
        $requete->execute(['id' => $id]);
        $image = $requete->fetchColumn();

        // 2. Supprimer la ligne du projet dans la base
        $requete = $bdd->prepare("DELETE FROM $type WHERE id = :id");
        $success = $requete->execute(['id' => $id]);

        // 3. Supprimer le fichier image correspondant dans le dossier /public/img/
        if ($success && $image) {
            $imagePath = 'public/img/' . $image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        return $success;
    }
}

