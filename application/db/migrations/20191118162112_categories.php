<?php
class Migration_categories extends CI_Migration {
    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => 'unique',
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
			),
			'updated_at' => array(
				'type' => 'DATETIME',
			),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('categories');
    }
    public function down() {
        $this->dbforge->drop_table('categories');
    }
}
