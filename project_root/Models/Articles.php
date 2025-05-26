<?php
namespace Models;

require_once __DIR__ . '/CrudModel.php';

class Articles extends CrudModel
{
    private int $articleID;
    private string $articleName;
    private string $size;
    private float $weight;
    private string $weightUnit;
    private string $color;
    private string $articleDescription;
    private ?string $articleImagePath;
    private string $articleCategory;
    private string $articleSubCategory;
    private string $articleMaterial;
    private string $articleBrand;
    private bool $articleAvailability;
    private array $articlesArray;

    public function __construct(int $articleID, string $articleName, string $size, float $weight, string $weightUnit, string $color, string $articleDescription, ?string $articleImagePath, string $articleCategory, string $articleSubCategory, string $articleMaterial, string $articleBrand, bool $articleAvailability)
    {
        $this->articleID = $articleID;
        $this->articleName = $articleName;
        $this->size = $size;
        $this->weight = $weight;
        $this->weightUnit = $weightUnit;
        $this->color = $color;
        $this->articleDescription = $articleDescription;
        $this->articleImagePath = $articleImagePath;
        $this->articleCategory = $articleCategory;
        $this->articleSubCategory = $articleSubCategory;
        $this->articleMaterial = $articleMaterial;
        $this->articleBrand = $articleBrand;
        $this->articleAvailability = $articleAvailability;
        // array met alle properties voor CRUD
        $this->articlesArray = array(
            'ArticleID' => $this->articleID,
            'Name' => $this->articleName,
            'Size' => $this->size,
            'Weight' => $this->weight,
            'WeightUnit' => $this->weightUnit,
            'Color' => $this->color,
            'Description' => $this->articleDescription,
            'Image' => $this->articleImagePath,
            'Category' => $this->articleCategory,
            'SubCategory' => $this->articleSubCategory,
            'Material' => $this->articleMaterial,
            'Brand' => $this->articleBrand,
            'Availability' => $this->articleAvailability
        );
    }
    public function __toString()
    {
        return "$this->articleID, $this->articleName, $this->weight, $this->weightUnit, $this->color, $this->articleDescription, $this->articleImagePath, $this->articleCategory, $this->articleSubCategory, $this->articleMaterial, $this->articleBrand, $this->articleAvailability";
    }

    // prepared statement nog voor het toevoegen van een artikel

    public function addArticle($conn)
    {
        $sql = "INSERT INTO articles (articleID, articleName, weight, weightUnit, color, articleDescription, articleImagePath, articleCategory, articleSubCategory, articleMaterial, articleBrand, articleAvailability) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // s = string, i = integer, d = double, b = blob
        $stmt->bindValue("isdssbbssssi", $this->articleID, $this->articleName, $this->weight, $this->weightUnit, $this->color, $this->articleDescription, $this->articleImagePath, $this->articleCategory, $this->articleSubCategory, $this->articleMaterial, $this->articleBrand, $this->articleAvailability);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Geeft het URL-pad naar de afbeelding (voor <img src=...>)
    public function getImageUrl(): string 
    {
    // Als je databasepad NIET wilt gebruiken maar bestand op basis van ID
            return 'Images/productImages/' . $this->articleID . '.jpg';
    }

    public function imageExists(): bool {
    // Gebruik absoluut pad op de server (let op: pad buiten public_html)
    $serverPath = __DIR__ . '/../../public_html/Images/productImages/' . $this->articleID . '.jpg';
    return file_exists($serverPath);
}

// Voeg eventueel getters toe als je de eigenschappen los wilt opvragen!
public function getArticleID() { return $this->articleID; }
public function getArticleName() { return $this->articleName; }
public function getWeight() { return $this->weight; }
public function getWeightUnit() { return $this->weightUnit; }
public function getColor() { return $this->color; }
public function getSize() { return $this->size; }
public function getArticleDescription() { return $this->articleDescription; }
public function getArticleImagePath() { return $this->articleImagePath; }
public function getArticleCategory() { return $this->articleCategory; }
public function getArticleSubCategory() { return $this->articleSubCategory; }
public function getArticleMaterial() { return $this->articleMaterial; }
public function getArticleBrand() { return $this->articleBrand; }
public function getArticleAvailability() { return $this->articleAvailability; }
public function getArticlesArray() { return $this->articlesArray; }
}
?>