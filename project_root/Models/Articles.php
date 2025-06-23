<?php
namespace Models;
use CrudModel;

require_once __DIR__ . '/CrudModel.php';

/**
 * Class Articles
 *
 * Represents an article/product and provides methods to interact with the database.
 *
 * @package Models
 */
class Articles
{
    /**
     * @var int The unique ID of the article.
     * @var string The name of the article.
     * @var string The size of the article.
     * @var float The weight of the article.
     * @var string The unit of weight (e.g., kg, g).
     * @var string The color of the article.
     * @var string The description of the article.
     * @var string|null The image path of the article (relative or null).
     * @var string The category of the article.
     * @var string The subcategory of the article.
     * @var string The material of the article.
     * @var string The brand of the article.
     * @var bool Whether the article is available.
     * @var array Associative array containing all article data.
     */
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
    private array $articleInfo;

    /**
     * @var mixed CrudModel instance or null.
     */
    private $crudModel;

    /**
     * Articles constructor.
     *
     * @param int $articleID
     * @param string $articleName
     * @param string $size
     * @param float $weight
     * @param string $weightUnit
     * @param string $color
     * @param string $articleDescription
     * @param string|null $articleImagePath
     * @param string $articleCategory
     * @param string $articleSubCategory
     * @param string $articleMaterial
     * @param string $articleBrand
     * @param bool $articleAvailability
     * @param mixed $crudModel Optional CrudModel instance for database operations.
     */
    public function __construct(int $articleID, string $articleName, string $size, float $weight, string $weightUnit, string $color, string $articleDescription, ?string $articleImagePath, string $articleCategory, string $articleSubCategory, string $articleMaterial, string $articleBrand, bool $articleAvailability, $crudModel = null)
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
        $this->articleInfo = $this->createAssociativeArray();
        $this->crudModel = $crudModel ?? new \Models\CrudModel();
    }
    /**
     * Returns a string representation of the article.
     *
     * @return string
     */
    public function __toString()
    {
        return "$this->articleID, $this->articleName, $this->weight, $this->weightUnit, $this->color, $this->articleDescription, $this->articleImagePath, $this->articleCategory, $this->articleSubCategory, $this->articleMaterial, $this->articleBrand, $this->articleAvailability";
    }

    /**
     * Returns the URL path to the article image.
     *
     * @return string The relative URL to the article image.
     */
    public function getImageUrl(): string 
    {
        // Returns the image path based on article ID.
        return 'Images/productImages/' . $this->articleID . '.jpg';
    }

    /**
     * Checks if the image file exists on the server.
     *
     * @return bool True if the image exists, false otherwise.
     */
    public function imageExists(): bool {
    // Use absolute path on the server (note: path outside public_html)
    $serverPath = __DIR__ . '/../../public_html/Images/productImages/' . $this->articleID . '.jpg';
    if(file_exists($serverPath)){
        return file_exists($serverPath);
    }
    else{
        $serverPath = __DIR__ . '/public_html/Images/productImages/' . $this->articleID . '.jpg';
    }
    return file_exists($serverPath);
    }

    /**
     * Returns all article data as an associative array.
     *
     * @return array Associative array of article properties.
     */
    public function createAssociativeArray(){
        $articlesArray = array(
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
        return $articlesArray;
    }

    /**
     * Saves the article to the database using CrudModel.
     *
     * @return bool True on success, false on failure.
     */
    public function saveArticle(): bool {
        return ($this->crudModel)::createData("Articles", $this->articleInfo);
    }

    /**
     * Updates the article in the database using CrudModel.
     *
     * @return bool True on success, false on failure.
     */
    public function updateArticle(): bool {
        return ($this->crudModel)::updateData("Articles", $this->articleInfo);
    }

    // Getters

    /** @return int The article ID. */
    public function getArticleID() { return $this->articleID; }
    /** @return string The article name. */
    public function getArticleName() { return $this->articleName; }
    /** @return float The article weight. */
    public function getWeight() { return $this->weight; }
    /** @return string The weight unit. */
    public function getWeightUnit() { return $this->weightUnit; }
    /** @return string The article color. */
    public function getColor() { return $this->color; }
    /** @return string The article size. */
    public function getSize() { return $this->size; }
    /** @return string The article description. */
    public function getArticleDescription() { return $this->articleDescription; }
    /** @return string|null The article image path. */
    public function getArticleImagePath() { return $this->articleImagePath; }
    /** @return string The article category. */
    public function getArticleCategory() { return $this->articleCategory; }
    /** @return string The article subcategory. */
    public function getArticleSubCategory() { return $this->articleSubCategory; }
    /** @return string The article material. */
    public function getArticleMaterial() { return $this->articleMaterial; }
    /** @return string The article brand. */
    public function getArticleBrand() { return $this->articleBrand; }
    /** @return bool The article availability. */
    public function getArticleAvailability() { return $this->articleAvailability; }
    /** @return array The article data as an array. */
    public function getArticlesArray() { return $this->articleInfo; }
}
?>