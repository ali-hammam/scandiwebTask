<?php
namespace Model;
include ROOT.'/vendor/autoload.php';
use Nesc\DB\Model\Model;

class Person extends Model
{

    protected $table = "persons";
    protected $fillable = ['id' , 'firstName'];

    public function orders(){
        return $this->hasMany('orders');
    }

    public function phoneNumber(){
        return $this->hasOne('phonenumbers' , 'persons_id');
    }
}