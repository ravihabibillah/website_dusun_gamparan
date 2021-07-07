<?php
class Migration_announcements extends CI_Migration {
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
			'content' => array(
				'type' => 'TEXT'
			),
			'image' => array(
				'type' => 'TEXT',
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'attachment' => array(
				'type' => 'TEXT',
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
			),
			'updated_at' => array(
				'type' => 'datetime',
			),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('announcements');
    }
    public function down() {
        $this->dbforge->drop_table('announcements');
    }
}
