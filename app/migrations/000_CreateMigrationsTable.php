<?php

class CreateMigrationsTable {

    private $_lava;
    protected $dbforge;

    public function __construct()
    {
        $this->_lava =& lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        // Create migrations table
        $this->_lava->dbforge->add_field(array(
            'migration' => array(
                'type' => 'INT',
                'null' => FALSE
            )
        ));

        $this->_lava->dbforge->create_table('migrations');
    }

    public function down()
    {
        // Drop migrations table
        $this->_lava->dbforge->drop_table('migrations');
    }
}
