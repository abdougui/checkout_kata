<?php

class Item{
    private $sku;
    private $price;
    public $specialPrice;

    public function __construct($sku, $price, $specialPrice = null) {
        $this->sku = $sku;
        $this->price = $price;
        $this->specialPrice = $specialPrice;
    }
    function getPrice(){
        return $this->price;
    } 
    function setPrice($price){
        $this->price = $price; 
    }
    function getName(){
        return $this->sku;
    }
    function setName($name){ 
        $this->sku = $name;
    }
}