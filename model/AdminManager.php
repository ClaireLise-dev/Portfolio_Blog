<?php

// On inclut la classe parente Manager (connexion à la BDD)
require_once('Manager.php');

class AdminManager extends Manager
{
    // Constructeur : lance la connexion à la base dès l’instanciation
    public function __construct()
    {
        $this->connection();
    }

    // Récupère un admin via son adresse email (pour connexion)
    public function getAdminByEmail(string $email)
    {
        $bdd = $this->getPDO(); // Connexion à la base
        $requete = $bdd->prepare("SELECT * FROM admin WHERE email = ?");
        $requete->execute([$email]); // Exécution avec l’email fourni
        return $requete->fetch(PDO::FETCH_ASSOC); // Retourne l’admin trouvé ou false
    }

    // Enregistre un token (remember me) pour un admin donné
    public function storeRememberToken($adminId, $token)
    {
        $bdd = $this->getPDO();
        $requete = $bdd->prepare("UPDATE admin SET remember_token = :token WHERE id = :id");
        $requete->execute([
            'token' => $token,
            'id' => $adminId
        ]);
    }

    // Récupère un admin à partir d’un token (utilisé pour connexion automatique)
    public function getAdminByToken($token)
    {
        $bdd = $this->getPDO();
        $requete = $bdd->prepare("SELECT * FROM admin WHERE remember_token = :token");
        $requete->execute(['token' => $token]);
        return $requete->fetch(); // Retourne l’admin correspondant ou false
    }
}

