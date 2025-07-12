<?php

require_once('Manager.php');

class AdminManager extends Manager
{
    public function __construct()
    {
        $this->connection();
    }
    public function getAdminByEmail(string $email)
    {
        $bdd = $this->getPDO();
        $requete = $bdd->prepare("SELECT * FROM admin WHERE email = ?");
        $requete->execute([$email]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
}
