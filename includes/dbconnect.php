<?php
// dbconnect.php
require_once 'config.php';

class Dbconnect {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Gérer l'exception ici. Pour une application en production, vous voudrez peut-être logger cette erreur et afficher un message convivial à l'utilisateur.
            error_log($e->getMessage()); // Logger l'erreur
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Dbconnect();
        }
        return self::$instance->pdo;
    }

    private function __clone() {
        // La fonction est vide pour empêcher le clonage de l'instance de la base de données
    }

    public function __wakeup() {
        // La fonction est vide pour empêcher la désérialisation de l'instance de la base de données
    }
}
?>
