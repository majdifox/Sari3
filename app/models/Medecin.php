<?php
namespace App\Models;

use Core\Database;
use PDO;

class Medecin
{
    public static function all()
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT ID, Nom, Prenom, Email, Telephone FROM utilisateurs WHERE Role = 'Medecin'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
