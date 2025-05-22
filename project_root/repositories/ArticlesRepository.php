<?php

namespace Repositories;

use Models\Articles;
use PDO;
use PDOException;

require_once __DIR__ . '/../Models/Articles.php';

class ArticlesRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(string $zoekwoord = '', string $categorie = ''): array
    {
        $sql = "SELECT * FROM articles WHERE 1=1";
        $params = [];

        if ($zoekwoord) {
            $sql .= " AND Name LIKE :zoekwoord";
            $params['zoekwoord'] = '%' . $zoekwoord . '%';
        }

        if ($categorie) {
            $sql .= " AND Category = :categorie";
            $params['categorie'] = $categorie;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $artikelen = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $artikelen[] = new Articles(
                $row['ArticleID'],
                $row['Name'],
                $row['Size'], // Zorg dat je database deze kolom bevat
                (float) $row['Weight'],
                $row['WeightUnit'],
                $row['Color'],
                $row['Description'],
                $row['Image'],
                $row['Category'],
                $row['SubCategory'],
                $row['Material'],
                $row['Brand'],
                (bool) $row['Availability']
            );
        }

        return $artikelen;
    }

    public function findById(int $id): ?Articles
    {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE ArticleID = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Articles(
                $row['ArticleID'],
                $row['Name'],
                $row['Size'], // Let op: ook hier moet 'Size' in je DB-tabel zitten
                (float) $row['Weight'],
                $row['WeightUnit'],
                $row['Color'],
                $row['Description'],
                $row['Image'],
                $row['Category'],
                $row['SubCategory'],
                $row['Material'],
                $row['Brand'],
                (bool) $row['Availability']
            );
        }

        return null;
    }
}
