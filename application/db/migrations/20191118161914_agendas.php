<?php
class Migration_agendas extends CI_Migration {
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
			),
			'start_at' => array(
				'type' => 'DATETIME',
			),
			'end_at' => array(
				'type' => 'DATETIME',
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
			),
			'updated_at' => array(
				'type' => 'DATETIME',
			),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('agendas');
    }
    public function down() {
        $this->dbforge->drop_table('agendas');
    }
}
