<?php
namespace App\Models;

use Core\Database;

class Utilisateur
{
    public static function findByEmail($email)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public static function create($nom, $prenom, $telephone, $email, $password, $role)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO utilisateurs (Nom, Prenom, Telephone, Email, Mot_de_passe, Role, Etat) VALUES (:nom, :prenom, :telephone, :email, :password, :role, 'Normal')");
        return $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'telephone' => $telephone, 'email' => $email, 'password' => $password, 'role' => $role]);
    }
}
?>