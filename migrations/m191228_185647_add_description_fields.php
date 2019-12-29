<?php

use yii\db\Migration;

/**
 * Class m191228_185647_add_description_fields
 */
class m191228_185647_add_description_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('{{%eg_gallery_picture_translation}}',[
			'picture_id' => $this->integer(11)->notNull(),
			'language' => $this->string(5)->notNull(),
			'title' => $this->string(64),
			'description' => $this->string(512),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
			'PRIMARY KEY (`picture_id`,`language`)',
		]);
		$this->addForeignKey('fk_picture_translation_picture', '{{%eg_gallery_picture_translation}}', 'picture_id', '{{%eg_gallery_picture}}', 'id', 'RESTRICT', 'CASCADE');
		$this->createTable('{{%eg_gallery_video_translation}}',[
			'video_id' => $this->integer(11)->notNull(),
			'language' => $this->string(5)->notNull(),
			'title' => $this->string(64),
			'description' => $this->string(512),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
			'PRIMARY KEY (`video_id`,`language`)',
		]);
		$this->addForeignKey('fk_video_translation_video', '{{%eg_gallery_video_translation}}', 'video_id', '{{%eg_gallery_video}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_video_translation_video', '{{%eg_gallery_video_translation}}');
        $this->dropTable('{{%eg_gallery_video_translation}}');
        $this->dropForeignKey('fk_picture_translation_picture', '{{%eg_gallery_picture_translation}}');
        $this->dropTable('{{%eg_gallery_picture_translation}}');
    }
}
