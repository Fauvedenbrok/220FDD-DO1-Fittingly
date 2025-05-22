<?php
use Models\Articles;

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
        //$sql .= " " join stock
           // . "LEFT JOIN stock ON articles.ArticleID = stock.ArticleID "//
            //. "WHERE stock.Availability = 1";//

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $artikelen = [];

        while ($row = $stmt->fetch()) {
            $artikelen[] = new Articles(
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
                // columns from stock table
            );
        }

        return $artikelen;
    }

    public function findById(int $id): ?Articles
    {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE ArticleID = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
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
?>
