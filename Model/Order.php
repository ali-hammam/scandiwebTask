<?php
namespace Model;
include ROOT.'/vendor/autoload.php';
use Nesc\DB\Model\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id' , 'orderName' , 'personsId'];

    public function person(){
        return $this->belongsTo('persons');
    }

    public function items(){
        return $this->hasManyThrough('items');
    }
}