<?php
include ROOT.'/vendor/autoload.php';
use \Model\Person;
use \Model\Order;
use \Model\PhoneNumber;
use \Model\Item;
use Nesc\Router\Request;

class example{
    public function hi(){
        $item = new Item();
        print_r(json_encode($item->find(2)->orders()));
    }

    public function display(){
        $person = new Person();
        $obj = $person->with('orders' , 'persons_id');
        print_r(json_encode($obj));
    }

    public function displayPhones(){
        $phone = new PhoneNumber();
        /* $obj = $person->find(2)->phoneNumber();
        print_r(json_encode($obj)); */
        $phone->insert(['phoneNumber' , 'persons_id'], ['01648912315',3])->run();

    }

    public function testManyToMany(){
        $order = new Order();
        $obj = $order->find(5)->items();
        print_r(json_encode($obj));
    }

    public function insertPerson(){
       $fname = Request::get('fname');
       $lname = Request::get('lname');
       $age = Request::get('age');
       echo $fname;
    }
}