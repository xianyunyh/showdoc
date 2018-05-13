<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Catelog extends Migrator
{

    public function change()
    {
        $exists = $this->hasTable('catalog');
        if($exists) {
            $this->dropTable('catalog');
        }
        $table = $this->table('catalog',array('engine'=>'Innodb','id'=>'cat_id'));
        $table->addColumn('cate_name', 'string',array('limit' => 50,'default'=>'','comment'=>'目录名'))
            ->addColumn('cate_item_id', 'integer',array('limit' => 11,'comment'=>'目录所在的项目id'))
            ->addColumn('cate_order', 'integer',array('limit' => 11,'default'=>1,'comment'=>'顺序。数字越小越靠前'))
            ->addColumn('add_time', 'integer',array('limit' => 11,'default'=>0,'comment'=>'	项目添加的时间，时间戳'))
            ->create();

    }
}
