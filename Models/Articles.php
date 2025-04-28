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


// Voeg eventueel getters toe als je de eigenschappen los wilt opvragen!
public function getArticleID() { return $this->articleID; }
public function getArticleName() { return $this->articleName; }
public function getWeight() { return $this->weight; }
public function getWeightUnit() { return $this->weightUnit; }
public function getColor() { return $this->color; }
public function getArticleDescription() { return $this->articleDescription; }
public function getArticleImagePath() { return $this->articleImagePath; }
public function getArticleCategory() { return $this->articleCategory; }
public function getArticleSubCategory() { return $this->articleSubCategory; }
public function getArticleMaterial() { return $this->articleMaterial; }
public function getArticleBrand() { return $this->articleBrand; }
public function getArticleAvailability() { return $this->articleAvailability; }
}
?>