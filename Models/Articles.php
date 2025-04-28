<?php

class Articles
{
    private $articleID;
    private $articleName;
    private $weight;
    private $weightUnit;
    private $color;
    private $articleDescription;
    private $articleImagePath;
    private $articleCategory;
    private $articleSubCategory;
    private $articleMaterial;
    private $articleBrand;
    private $articleAvailability;

    public function __construct(int $articleID, string $articleName, float $weight, string $weightUnit, string $color, string $articleDescription, string $articleImagePath, string $articleCategory, string $articleSubCategory, string $articleMaterial, string $articleBrand, bool $articleAvailability)
    {
        $this->articleID = $articleID;
        $this->articleName = $articleName;
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
        // issssssssssi moet nog veranderd worden naar de juiste types
        // s = string, i = integer, d = double, b = blob
        $stmt->bind_param("issssssssssi", $this->articleID, $this->articleName, $this->weight, $this->weightUnit, $this->color, $this->articleDescription, $this->articleImagePath, $this->articleCategory, $this->articleSubCategory, $this->articleMaterial, $this->articleBrand, $this->articleAvailability);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

