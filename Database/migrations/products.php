<?php
namespace Database\migrations;
use DB\Table\Facades\ColumnPropertyFacade;
use DB\Table\Facades\Table;
use DB\Table\Migrations\migration;

include_once 'config.php';
require_once (ROOT.'/nesc/DB/Table/Migrations/migration.php');
require_once (ROOT.'/nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once (ROOT.'/nesc/DB/Table/Facades/Table.php');

class products extends migration
{
    public function up(){
        Table::create($this->className , function (){
            $id = ColumnPropertyFacade::SetColumnBase('id')
                ->Number()
                ->primaryKey()
                ->getColumnProperty();

            $productstype_id = ColumnPropertyFacade::SetColumnBase('productstype_id')
                ->Number()
                ->unsigned()
                ->NotNUll()
                ->getColumnProperty();

            $sku = ColumnPropertyFacade::SetColumnBase('sku')
                ->String(50)
                ->NotNUll()
                ->getColumnProperty();

            $name = ColumnPropertyFacade::SetColumnBase('name')
                ->String(50)
                ->NotNUll()
                ->getColumnProperty();

            $price = ColumnPropertyFacade::SetColumnBase('price')
                ->Float()
                ->NotNUll()
                ->getColumnProperty();

            $details = ColumnPropertyFacade::SetColumnBase('details')
                ->Json(50)
                ->NotNUll()
                ->getColumnProperty();

            $foreignKey = ColumnPropertyFacade::foreignKey('productstype_id' , 'productstype' , 'id')
                ->getColumnProperty();

            return [$id, $productstype_id , $sku , $name , $price , $details , $foreignKey];
        });
    }

    public function down(){
        Table::drop($this->className);
    }
}