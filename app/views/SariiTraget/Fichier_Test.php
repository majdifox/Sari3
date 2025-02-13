<?php

require_once 'Database.php';

$db = Database::getInstance();

if ($db) {
    echo "✅ Connexion réussie à PostgreSQL !";
} else {
    echo "❌ Échec de la connexion.";
}
?>