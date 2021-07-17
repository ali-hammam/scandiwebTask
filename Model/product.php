<?php
namespace Model;
use Nesc\DB\Model\Model;

class product extends Model
{
  protected $table = "products";

  public function products(){
    return $this->belongsTo('productstype');
  }

}