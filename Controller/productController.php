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
    $productList = $productType->with('products' , 'productstype_id'); 
    $temp = [];
    $data = [];
    $dataCounter = 0;
    for($i = 0; $i < sizeof($productList); $i++){
      $temp[$i] = $productList[$i]['products'];
      for($j = 0; $j < sizeof($temp[$i]); $j++){
        $data[$dataCounter] = $temp[$i][$j];
        $dataCounter++;
      }
    }
  

    echo json_encode([
      'status' => '200',
      "data" => $data,
    ]);
  }

  public function delete(){
   $object = Request::getData();
   $products = new product();
   $products_id = $object["proudcts_id"];
   $products->massDelete($products_id)->run();

    echo json_encode([
      'status' => '200',
      "data" => Request::getData()
    ]);
  }

  public function add(){
    $id = '';
    $sku = "'".Request::get('sku')."'";
    $name = "'".Request::get('name')."'";
    $price = Request::get('price');
    $productTypeId = Request::get('productTypeId');
    $product = new product();

    $product->insert($this->columns() , [$productTypeId , $sku , $name , $price , $this->formatValue()])->run();
    echo json_encode([
      'status' => '204',
      "data" => Request::getData()
    ]);
  }

  public function isDvd(){
    return array_key_exists('size' , Request::getData());
  }

  public function isBook(){
    return array_key_exists('weight' , Request::getData());
  }

  public function isFurniture(){
    return Request::get('height') != null;
  }

  public function columns(){
    return ['productstype_id', 'sku' , 'name' , 'price' , 'details'];
  }

  private function typeId($type){
    $this->productType = new ProductType();
    $id = $this->productType->select(['id'] , 'productstype')
                ->where("name", "=", "'".$type."'")
                ->runSelect()
                ->get();
    return $id[0]['id'];
  }

  public function formatValue(){
    $obj = Request::getData();
    $json;
    if($this->isDvd()){
      $json['size'] = $obj['size'];   
    }else if($this->isBook()){
      $json['weight'] = $obj['weight'];
    }elseif($this->isFurniture()){
      $json['height'] = $obj['height'];
      $json['width'] = $obj['width'];
      $json['length'] = $obj['length'];
    }

    return "'".json_encode([$json])."'";
  }
}