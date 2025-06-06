<?php

namespace Repositories;
use Models\Articles;
use PDO;
use PDOException;

require_once __DIR__ . '/../Models/Articles.php';

/**
 * Class ArticlesRepository
 *
 * Repository for accessing articles in the database.
 */
class ArticlesRepository
{
    /** @var PDO $pdo The PDO database connection. */
    private $pdo;

    /**
     * ArticlesRepository constructor.
     *
     * @param PDO $pdo The PDO database connection.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Finds all articles, optionally filtered by search word and/or category.
     *
     * @param string $zoekwoord Optional search word to filter article names.
     * @param string $categorie Optional category to filter articles.
     * @return Articles[] Array of Articles objects.
     */
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
            // Use argument unpacking to pass all row values to the Articles constructor.
            $artikelen[] = new Articles(...array_values($row));
        }

        return $artikelen;
    }

    /**
     * Finds a single article by its ID.
     *
     * @param int $id The ArticleID to search for.
     * @return Articles|null The found Articles object, or null if not found.
     */
    public function findById(int $id): ?Articles
    {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE ArticleID = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // door ...array_values($row) tussen de haakjes bij Articles(); te zetten stopt die alle variabelen op volgorde van de database kollommen in de constructor.
            return new Articles(
                $row['ArticleID'],
                $row['Name'],
                $row['Size'],
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
