<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ItemMember extends Migrator
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
        $exists = $this->hasTable('item_member');
        if($exists) {
            $this->dropTable('item_member');
        }
        $table = $this->table('item_member',array('engine'=>'Innodb','id'=>'item_member_id'));
        $table->addColumn('item_id', 'integer',array('limit' => 11,'comment'=>'项目id'))
            ->addColumn('uid', 'integer',array('limit' => 11,'comment'=>'uid'))
            ->addColumn('add_time', 'integer',array('limit' => 11,'default'=>0,'comment'=>'	项目添加的时间，时间戳'))
            ->create();

    }
}
