<?php
namespace Model;
include ROOT.'/vendor/autoload.php';
use Nesc\DB\Model\Model;

class Item extends Model
{
    protected $table = 'items';

    public function orders(){
        return $this->belongsToMany('orders');
    }
}