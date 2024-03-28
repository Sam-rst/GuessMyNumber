<?php
class ScoreManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertScore($pseudo, $score) {
        $stmt = $this->pdo->prepare("INSERT INTO guessmynumber (pseudo, score) VALUES (:pseudo, :score)");
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':score', $score, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getScores() {
        $stmt = $this->pdo->prepare("SELECT * FROM guessmynumber WHERE score != 0 GROUP BY pseudo ORDER BY score DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
