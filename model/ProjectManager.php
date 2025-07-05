<?php

require_once('Manager.php');

class ProjectManager extends Manager
{
    private array $allowedTables = ['projects', 'wordpress', 'articles'];

    public function getProjectById(int $id, string $type)
    {
        if (!in_array($type, $this->allowedTables)) {
            return false;
        }

        $bdd = $this->connection();
        $requete = $bdd->prepare("SELECT * FROM $type WHERE id = ?");
        $requete->execute([$id]);

        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll(string $type) {
        if (!in_array($type, $this->allowedTables)) return [];
    
        $bdd = $this->connection();
        $requete = $bdd->query("SELECT * FROM $type ORDER BY id DESC");
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

   public function insertProject(string $type, array $data): bool
{
    if (!in_array($type, $this->allowedTables)) {
        return false;
    }

    $bdd = $this->connection();

    $fields = array_keys($data);
    $placeholders = array_map(fn($f) => ':' . $f, $fields);

    $sql = "INSERT INTO $type (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $requete = $bdd->prepare($sql);


    foreach ($data as $key => $value) {
        $requete->bindValue(":$key", $value);
    }

    return $requete->execute();
}

public function updateProject($type, $id, $data)
{
    $fields = [];
    $params = [];

    foreach ($data as $key => $value) {
        $fields[] = "$key = ?";
        $params[] = $value;
    }

    $bdd = $this->connection();
    $params[] = $id; // Pour la clause WHERE

    $sql = "UPDATE $type SET " . implode(', ', $fields) . " WHERE id = ?";

    $requete = $bdd->prepare($sql);
    return $requete->execute($params);
}

    
public function deleteProject(int $id, string $type): bool {
    $bdd = $this->connection();

    // 1. Récupérer l’image
    $requete = $bdd->prepare("SELECT image FROM $type WHERE id = :id");
    $requete->execute(['id' => $id]);
    $image = $requete->fetchColumn();

    // 2. Supprimer le projet
    $requete = $bdd->prepare("DELETE FROM $type WHERE id = :id");
    $success = $requete->execute(['id' => $id]);

    // 3. Supprimer l'image physique
    if ($success && $image) {
        $imagePath = 'public/img/' . $image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    return $success;
}

}
