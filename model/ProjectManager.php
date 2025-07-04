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
    
    public function deleteProject(int $id, string $type) {
        $bdd = $this->connection();
        $requete = $bdd->prepare("DELETE FROM $type WHERE id = ?");
        $requete->execute([$id]);
    }
}
