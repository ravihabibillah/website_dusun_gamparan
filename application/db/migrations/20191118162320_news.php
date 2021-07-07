<?php
class Migration_news extends CI_Migration {
    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
			),
			'category_id' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => 'UNIQUE',	
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'content' => array(
				'type' => 'TEXT',
			),
			'image' => array(
				'type' => 'TEXT',
			),
			'attachments' => array(
				'type' => 'TEXT',
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => 1,
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
			),
			'updated_at' => array(
				'type' => 'DATETIME'
			),
		));
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field('CONSTRAINT `fk_category_id` FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE');
        $this->dbforge->create_table('news');
    }
    public function down() {
        $this->dbforge->drop_table('news');
    }
}
