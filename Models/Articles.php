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
}

