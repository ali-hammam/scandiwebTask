<?php


namespace DB\Table\Facades;
include_once 'config.php';
require_once (ROOT.'/Nesc/DB/Table/ColumnProperty.php');
require_once (ROOT.'/Nesc/Facade/Facade.php');

/*require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Nesc/DB/Table/ColumnProperty.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Nesc/Facade/Facade.php');*/
use DB\Table\ColumnProperty;
use Nesc\Facade\Facade;


class ColumnPropertyFacade extends Facade{

    // i want to route any functions in ColumnProperty()
    public static function setFacadeAccessor(){
        return new ColumnProperty();
    }
}