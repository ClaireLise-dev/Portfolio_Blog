<?php

require_once('model/Manager.php');

class ContactManager extends Manager
{
    public function saveMessage($name, $email, $message)
    {
        $bdd = $this->connection();
        $requete = $bdd->prepare('INSERT INTO messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())');
        return $requete->execute([$name, $email, $message]);
    }
}