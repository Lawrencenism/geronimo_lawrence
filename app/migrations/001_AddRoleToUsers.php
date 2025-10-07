<?php

class AddRoleToUsers {

    private $_lava;
    protected $dbforge;

    public function __construct()
    {
        $this->_lava =& lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        // Add role column to users table
        $this->_lava->dbforge->add_column('users', array(
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'user'
            )
        ));

        // Insert or update admin user
        $existing = $this->_lava->db->table('users')->where('email', 'admin@gmail.com')->get();
        if ($existing) {
            $this->_lava->db->table('users')->where('email', 'admin@gmail.com')->update(['role' => 'admin']);
        } else {
            $this->_lava->db->table('users')->insert([
                'email' => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin'
            ]);
        }
    }

    public function down()
    {
        // Drop role column from users table
        $this->_lava->dbforge->drop_column('users', 'role');
    }
}
