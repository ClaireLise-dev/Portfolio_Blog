<?php

require_once('Manager.php');

class AdminManager extends Manager
{
    public function getAdminByEmail(string $email)
    {
        $bdd = $this->connection();
        $stmt = $bdd->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}