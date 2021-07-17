<?php
namespace stratiges;

class listProducts{
  private $html;
  private $productTypes;

  public function __construct(){
    $this->productTypes = ['dvd' , 'book' , 'furniture'];
  }

  public function header(){
    $this->html = '<div class="container mt-5">'.
                    '<div class="row">'.
                      '<div class="col-md col-sm-12">'.
                        '<h4>Product List</h4>'.
                      "</div>" .
                      '<div class="col-md-auto col-sm-12">' .
                        "<a href = 'http://localhost/scandiweb/addProduct' style = 'text-decoration:none'>
                          <button>ADD</button>
                        </a>" .
                        '<button class="ml-md-4">MASS DELETE</button>' .
                      "</div>" .
                    "</div>" .
                    '<hr class="mt-2 mb-3 bg-dark">' .
                  "</div>";
  }

  public function cardContainer(){
    $this->html = $this->html . '<div class="container mt-4">' .
                                '<div class="row">';
  }

  public function run(){
    $this->header();
    $this->cardContainer();
    foreach($this->productTypes as $product){
      $this->html = $this->html . strategyFactory::productFactory($product)->loadCards();
    }
    $this->finish();
    $this->display();
  }

  public function display(){
    echo $this->html;
  }

  public function finish(){
    $this->html .= '</div>' .
                  '<hr class="mt-2 bg-dark">'.
                  '<p class="text-center">scandiweb test assignment</p>'.
                  '</div>';
  }
}
?>

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
</html>