<?php
namespace stratiges;

class bookStrategy extends productSkeleton{

  public function __construct(){
    $this->category = "'book'";
    $this->details = 'weight';
    $this->unit = 'KG';
  }

  public function createCard($obj){
    $this->instantiateCard();
    $this->cardDetails($obj , $this->details , $this->unit);  
  }
}
?>