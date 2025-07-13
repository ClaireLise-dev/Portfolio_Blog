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
    
    public function storeRememberToken($adminId, $token) {
    $bdd = $this->getPDO();
    $requete = $bdd->prepare("UPDATE admin SET remember_token = :token WHERE id = :id");
    $requete->execute([
        'token' => $token,
        'id' => $adminId
    ]);
}

    public function getAdminByToken($token) {
    $bdd = $this->getPDO();
    $requete = $bdd->prepare("SELECT * FROM admin WHERE remember_token = :token");
    $requete->execute(['token' => $token]);
    return $requete->fetch();
}

}
