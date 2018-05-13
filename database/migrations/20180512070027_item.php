<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Item extends Migrator
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
        $exists = $this->hasTable('item');
        if($exists) {
            $this->dropTable('item');
        }
        $table = $this->table('item',array('engine'=>'Innodb','id'=>'item_id'));
        $table->addColumn('item_name', 'string',array('limit' => 50,'default'=>'','comment'=>'项目名'))
            ->addColumn('item_description', 'string',array('limit' => 255,'default'=>'','comment'=>'项目描述'))
            ->addColumn('uid', 'integer',array('limit' => 11,'comment'=>'创建人uid'))
            ->addColumn('password', 'string',array('limit' => 255,'default'=>0,'comment'=>'项目密码。可为空。空表示可以公开访问的项目'))
            ->addColumn('add_time', 'integer',array('limit' => 11,'default'=>0,'comment'=>'	项目添加的时间，时间戳'))
            ->addColumn('last_update_time', 'integer',array('comment'=>'项目最后更新时间，时间戳'))
            ->create();
    }
}
