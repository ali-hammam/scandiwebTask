<?php
namespace stratiges;

class dvdStrategy extends productSkeleton{
  
  public function __construct(){
    $this->category = "'dvd'";
    $this->details = 'size';
    $this->unit = 'MB';
  }

  public function createCard($obj){
    $this->instantiateCard();
    $this->cardDetails($obj , $this->details , $this->unit);
  }
}

?>