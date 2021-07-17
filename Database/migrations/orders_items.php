<?php


namespace Database\migrations;
use DB\Table\Facades\ColumnPropertyFacade;
use DB\Table\Facades\Table;
use DB\Table\Migrations\migration;

/*require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/nesc/DB/Table/Migrations/migration.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/nesc/DB/Table/Facades/Table.php');*/
include_once 'config.php';
require_once (ROOT.'/nesc/DB/Table/Migrations/migration.php');
require_once (ROOT.'/nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once (ROOT.'/nesc/DB/Table/Facades/Table.php');

class orders_items extends migration
{

    public function up(){
        Table::create($this->className , function (){

            $id = ColumnPropertyFacade::SetColumnBase('id')
                ->Number()
                ->primaryKey()
                ->getColumnProperty();

            $ordersId = ColumnPropertyFacade::SetColumnBase('ordersId')
                ->Number()
                ->unsigned()
                ->getColumnProperty();

            $itemId = ColumnPropertyFacade::SetColumnBase('itemsId')
                ->Number()
                ->unsigned()
                ->getColumnProperty();

            $ordersIdConstraint = ColumnPropertyFacade::foreignKey('ordersId')
                ->getColumnProperty();

            $itemIdConstraint = ColumnPropertyFacade::foreignKey('itemsId')
                ->getColumnProperty();

            return [$id , $ordersId , $itemId , $ordersIdConstraint , $itemIdConstraint];

        });
    }

    public function down(){
        Table::drop($this->className);
    }
}