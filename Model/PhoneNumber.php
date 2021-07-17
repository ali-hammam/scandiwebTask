<?php
namespace Model;
include ROOT.'/vendor/autoload.php';
use Nesc\DB\Model\Model;

class PhoneNumber extends Model{

    protected $table = "phonenumbers";
    protected $fillable = ['id' , 'phoneNumber' , 'personsId'];

    public function person(){
        return $this->belongsTo('persons');
    }
}