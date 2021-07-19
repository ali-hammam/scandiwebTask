<?php
error_reporting(0);
use \stratiges\listProducts;
use \Nesc\Router\Request;
use \Model\ProductType;
use \Model\product;

class productController {
  
  private $productType;

  public function display(){
    $productType = new productType;
    $productTypesWithProducts = $productType->with('products' , 'productstype_id'); 
    
    $products = array_map(function ($productType) {
      return $productType['products'];
    }, $productTypesWithProducts);

    echo json_encode([
      'status' => '200',
      "data" => array_merge(...array_filter($products)), //array_filter to remove null and empty arrays
    ]);
  }

  public function delete(){
   $products_id = Request::get("proudcts_id");
   $product = new product();
   $product->massDelete($products_id)->run();

    echo json_encode([
      'status' => '200',
      "data" => Request::getData()
    ]);
  }

  public function add(){
    $sku = $this->stringify(Request::get('sku'));
    $name =$this->stringify(Request::get('name'));
    $price = Request::get('price');
    $productTypeId = Request::get('productTypeId');
    $details = $this->getProductDetailsFromRequest();
    
    $product = new product();
    $product->insert($product->fillable, [$productTypeId, $sku, $name, $price, $details])
      ->run();
    
    echo json_encode([
      'status' => '204',
      "data" => Request::getData()
    ]);
  }

  private function getProductDetailsFromRequest() {
    $requestDetails = Request::get('details');
    return $this->stringify(json_encode([$requestDetails]));
  }

  private function stringify($val){
    return "'".$val."'";
  }
}