<?php

class CreateUsersTable {

    private $_lava;
    protected $dbforge;

    public function __construct()
    {
        $this->_lava =& lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        // Create users table
        $this->_lava->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
                'null' => FALSE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            )
        ));

        $this->_lava->dbforge->add_key('id', TRUE);
        $this->_lava->dbforge->create_table('users');
    }

    public function down()
    {
        // Drop users table
        $this->_lava->dbforge->drop_table('users');
    }
}
