<?php
namespace Database\migrations;

use DB\Table\Facades\ColumnPropertyFacade;
use DB\Table\Facades\Table;
use DB\Table\Migrations\migration;
require_once 'config.php';
/*require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/nesc/DB/Table/Migrations/migration.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/nesc/DB/Table/Facades/Table.php');*/
require_once (ROOT.'/nesc/DB/Table/Migrations/migration.php');
require_once (ROOT.'/nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once (ROOT.'/nesc/DB/Table/Facades/Table.php');

class orders extends migration
{
    public function up(){
        Table::create($this->className , function (){
            $id = ColumnPropertyFacade::SetColumnBase('id')
                ->Number()
                ->primaryKey()
                ->getColumnProperty();

            $orderName = ColumnPropertyFacade::SetColumnBase('orderName')
                ->String(10)
                ->getColumnProperty();

            $personsId = ColumnPropertyFacade::SetColumnBase('personsId')
                ->Number()
                ->unsigned()
                ->getColumnProperty();

            $foreignKey = ColumnPropertyFacade::foreignKey('personsId' , 'persons' , 'id')
                ->getColumnProperty();

            return [$id, $orderName , $personsId , $foreignKey];
        });
    }

    public function down(){
        Table::drop($this->className);
    }
}