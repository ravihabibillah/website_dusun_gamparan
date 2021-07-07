<?php
class Migration_sliders extends CI_Migration {
    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
			),
			'news_id' => array(
				'type' => 'INT',
				'constraint' => TRUE,
			),
			'image' => array(
				'type' => 'TEXT',
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
			),	
			'updated_at' => array(
				'type' => 'DATETIME',
			),
        ));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field('CONSTRAINT `fk_news_id` FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE');
        $this->dbforge->create_table('sliders');
    }
    public function down() {
        $this->dbforge->drop_table('sliders');
    }
}
