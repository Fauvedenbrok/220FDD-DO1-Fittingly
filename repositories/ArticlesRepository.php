<?php
// repositories/ArticlesRepository.php
require_once 'models/Articles.php';

class ArticlesRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll($zoekwoord = '', $categorie = '') {
        $sql = "SELECT * FROM articles WHERE 1=1";
        $params = [];

        if ($zoekwoord) {
            $sql .= " AND Name LIKE :zoekwoord";
            $params['zoekwoord'] = "%$zoekwoord%";
        }

        if ($categorie) {
            $sql .= " AND Category = :categorie";
            $params['categorie'] = $categorie;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $artikelen = [];
        while ($row = $stmt->fetch()) {
            $artikelen[] = new Articles($row);
        }

        return $artikelen;
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE ArticleID = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ? new Articles($data) : null;
    }
}
?>
