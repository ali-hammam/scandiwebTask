<?php
namespace stratiges;
error_reporting(0);


class furnitureStrategy extends productSkeleton{

  public function __construct(){
    $this->category = "'furniture'";
    $this->details = ['height' , 'width' , 'length'];
  }
  
  public function createCard($obj){
    $this->instantiateCard();
    $this->cardDetails($obj , $this->details , $this->unit);       
  }
}
?>