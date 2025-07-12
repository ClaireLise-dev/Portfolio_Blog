<?php

require_once('model/Manager.php');

class ContactManager extends Manager
{
    public function __construct()
    {
        $this->connection();
    }
    public function saveMessage($name, $email, $message)
    {
        $bdd = $this->getPDO();
        $requete = $bdd->prepare('INSERT INTO messages (name, email, message, creation_date) VALUES (?, ?, ?, NOW())');
        return $requete->execute([$name, $email, $message]);
    }
}
