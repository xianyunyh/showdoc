<?php

use think\migration\Migrator;
use think\migration\db\Column;

class User extends Migrator
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
        // create the table
        $exists = $this->hasTable('user');
        if($exists) {
            $this->dropTable('user');
        }
        $table = $this->table('user',array('engine'=>'Innodb','id'=>'uid'));
        $table->addColumn('username', 'string',array('limit' => 15,'default'=>'','comment'=>'用户名，登陆使用'))
            ->addColumn('password', 'string',array('limit' => 255,'default'=>'','comment'=>'用户密码'))
            ->addColumn('groupid', 'integer',array('limit' => 4,'default'=>2,'comment'=>'登陆状态'))
            ->addColumn('cookie_token', 'string',array('limit' => 50,'default'=>0,'comment'=>'排他性登陆标识'))
            ->addColumn('cookie_token_expire', 'integer',array('limit' => 11,'default'=>0,'comment'=>'cookie有效期'))
            ->addColumn('avatar', 'string',array('default'=>'','comment'=>'头像'))
            ->addColumn('email', 'string',array('limit' => 50,'default'=>'','comment'=>'email'))
            ->addColumn('name', 'string',array('limit' => 20,'default'=>'','comment'=>'昵称'))
            ->addColumn('reg_time', 'integer',array('limit' => 11,'comment'=>'注册时间'))
            ->addColumn('last_login_time','integer',array('limit'=>11,'comment'=>"最后登录时间"))
            ->create();
    }
}
