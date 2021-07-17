<?php
namespace stratiges;
require_once 'formQuery.php';
use formQuery;
use \Model\ProductType;


abstract class productSkeleton implements formQuery{
  use cardCreation;

  private $productType;
  protected $category;
  protected $details;
  protected $unit;
  protected $html;

  private function getId(){
    $this->productType = new ProductType();
    $id = $this->productType->select(['id'])
                ->where("name", "=", $this->category)
                ->runSelect()
                ->get();
    
    return $id[0]['id'];
  }

  public function getAllRecords(){
    $id = $this->getId();
    return (($this->productType->find($id , 'productstype')->products()));
  }

  /* public function cardContainer(){
    $this->html = $this->html . '<div class="container mt-4">' .
                                '<div class="row">';
  } */

  public function instantiateCard(){
    $this->html = $this->html. 
                        '<div class="col-lg-3 col-md-6 col-sm-12">'.
                          '<div class="card bg-light mb-3" style="max-width: 18rem;">'.
                            '<div class="card-body">' .
                              '<div class="col-12">' .
                                '<input type="checkbox" class="form-check-input" id="defaultCheck1">' .
                              '</div>' .
                              '<div class="p-3">';
                              
  }

  public abstract function createCard($obj);

  public function loadCards(){
    $objects = $this->getAllRecords();
    $products = $objects['products'];
    //$this->cardContainer(); 
    for($i = 0; $i < sizeof($products); $i++){
      $this->createCard($products[$i]);
    }
    return $this->html;
  }
} 

?>