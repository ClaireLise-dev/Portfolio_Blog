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
        $stmt = $bdd->prepare("SELECT * FROM $type WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll(string $type) {
        if (!in_array($type, $this->allowedTables)) return [];
    
        $bdd = $this->connection();
        $stmt = $bdd->query("SELECT * FROM $type ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $stmt = $bdd->prepare($sql);


    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
}
    
    public function deleteProject(int $id, string $type) {
        $bdd = $this->connection();
        $stmt = $bdd->prepare("DELETE FROM $type WHERE id = ?");
        $stmt->execute([$id]);
    }
}
