<?php
class Migration_users extends CI_Migration {
    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => 'UNIQUE'
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
			),
			'updated_at' => array(
				'type' => 'DATETIME',
			),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }
    public function down() {
        $this->dbforge->drop_table('users');
    }
}
