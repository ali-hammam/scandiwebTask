<?php 
namespace stratiges;

class strategyFactory{ 
  public static function productFactory($productType){
    if($productType === 'dvd'){
      return new dvdStrategy();
    }else if($productType === 'book'){
      return new bookStrategy();
    }else if($productType === 'furniture'){
      return new furnitureStrategy();
    }
  }
}

?>