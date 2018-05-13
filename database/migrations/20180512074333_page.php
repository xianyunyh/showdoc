<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Page extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $exists = $this->hasTable('page');
        if($exists) {
            $this->dropTable('page');
        }
        $table = $this->table('page',array('engine'=>'Innodb','id'=>'page_id'));
        $table->addColumn('uid', 'integer',array('limit' => 11,'comment'=>'项目id'))
            ->addColumn('item_id', 'integer',array('limit' => 11,'comment'=>'项目id'))
            ->addColumn('cate_id', 'integer',array('limit' => 11,'default'=>1,'comment'=>'栏目id'))
            ->addColumn('page_title', 'string',array('limit' => 50,'default'=>'','comment'=>'页面标题'))
            ->addColumn('page_content', 'text',array('default'=>'','comment'=>'页面内容'))
            ->addColumn('page_order', 'integer',array('limit' => 11,'default'=>1,'comment'=>'排序'))
            ->addColumn('add_time', 'integer',array('limit' => 11,'comment'=>'添加时间'))
            ->create();

    }
}
