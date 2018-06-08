<?php

use yii\db\Migration;

class m150816_201706_create_gallery_table extends Migration
{
    public function safeUp()
    {
		$this->createTable('{{%eg_gallery_category}}',[
			'id' => $this->primaryKey(),
			'name' => $this->string(64)->notNull(),
			'logo' => $this->string(32)->notNull()->defaultValue('default.png'),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
		]);
		$this->createTable('{{%eg_gallery_category_translation}}',[
			'category_id' => $this->integer(11)->notNull(),
			'language' => $this->string(5)->notNull(),
			'title' => $this->string(64)->notNull(),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
			'PRIMARY KEY (`category_id`,`language`)',
		]);
		$this->addForeignKey('fk_category_translation_category', '{{%eg_gallery_category_translation}}', 'category_id', '{{%eg_gallery_category}}', 'id', 'RESTRICT', 'CASCADE');
		$this->createTable('{{%eg_gallery_album}}',[
			'id' => $this->primaryKey(),
			'name' => $this->string(64)->notNull(),
			'category_id' => $this->integer(11)->notNull(),
			'logo' => $this->string(32)->notNull()->defaultValue('default.png'),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
		]);
		$this->addForeignKey('fk_gallery_album_category', '{{%eg_gallery_album}}', 'category_id', '{{%eg_gallery_category}}', 'id', 'RESTRICT', 'CASCADE');
		$this->createTable('{{%eg_gallery_album_translation}}',[
			'album_id' => $this->integer(11)->notNull(),
			'language' => $this->string(5)->notNull(),
			'title' => $this->string(64),
			'description' => $this->string(512),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
			'PRIMARY KEY (`album_id`,`language`)',
		]);
		$this->addForeignKey('fk_gallery_album_translation_album', '{{%eg_gallery_album_translation}}', 'album_id', '{{%eg_gallery_album}}', 'id', 'RESTRICT', 'CASCADE');
		$this->createTable('{{%eg_gallery_picture}}',[
			'id' => $this->primaryKey(),
			'album_id' => $this->integer(11)->notNull(),
			'name' => $this->string(64)->notNull(),
 			'picture' => $this->string(64)->notNull(),
 			'thumb' => $this->string(64)->notNull(),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
		]);
		$this->addForeignKey('fk_gallery_picture_album', '{{%eg_gallery_picture}}', 'album_id', '{{%eg_gallery_album}}', 'id', 'RESTRICT', 'CASCADE');
        $this->createTable('{{%eg_gallery_video}}',[
            'id' => $this->primaryKey(),
            'album_id' => $this->integer(11)->notNull(),
            'name' => $this->string(64)->notNull(),
            'video' => $this->string(64)->notNull(),
            'thumb' => $this->string(64)->notNull(),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
        ]);
        $this->addForeignKey('fk_gallery_video_album', '{{%eg_gallery_video}}', 'album_id', '{{%eg_gallery_album}}', 'id', 'RESTRICT', 'CASCADE');

        $this->insert('{{%eg_gallery_category}}', [
			'id' => 1,
            'name' => 'عمومی',
			'status' => 1,
        ]);
        $this->insert('{{%eg_gallery_category_translation}}', [
            'category_id' => 1,
            'language' => 'fa-IR',
            'title' => 'عمومی',
        ]);
        $this->insert('{{%eg_gallery_category_translation}}', [
            'category_id' => 1,
            'language' => 'en-US',
            'title' => 'public',
        ]);
        $this->insert('{{%eg_gallery_album}}', [
			'id' => 1,
            'name' => 'عمومی',
            'category_id' => 1,
            'logo' => 'album-1.png',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_album_translation}}', [
            'album_id' => 1,
            'language' => 'fa-IR',
            'title' => 'پلت فرم eg-cms',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_album_translation}}', [
            'album_id' => 1,
            'language' => 'en-US',
            'title' => 'eg-cms platform',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
			'id' => 1,
            'album_id' => 1,
            'name' => 'eg-cms1',
            'picture' => 'picture1.jpg',
            'thumb' => 'thumb1.jpg',
            'status' => '1',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
			'id' => 2,
            'album_id' => 1,
            'name' => 'eg-cms2',
            'picture' => 'picture2.jpg',
            'thumb' => 'thumb2.jpg',
            'status' => '1',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
			'id' => 3,
            'album_id' => 1,
            'name' => 'eg-cms3',
            'picture' => 'picture3.jpg',
            'thumb' => 'thumb3.jpg',
            'status' => '1',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
			'id' => 4,
            'album_id' => 1,
            'name' => 'eg-cms4',
            'picture' => 'picture4.jpg',
            'thumb' => 'thumb4.jpg',
            'status' => '1',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
			'id' => 5,
            'album_id' => 1,
            'name' => 'eg-cms5',
            'picture' => 'picture5.jpg',
            'thumb' => 'thumb5.jpg',
            'status' => '1',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
			'id' => 6,
            'album_id' => 1,
            'name' => 'eg-cms6',
            'picture' => 'picture6.jpg',
            'thumb' => 'thumb6.jpg',
            'status' => '1',
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_gallery_video_album', '{{%eg_gallery_video}}');
        $this->dropTable('{{%eg_gallery_video}}');
		$this->dropForeignKey('fk_gallery_picture_album', '{{%eg_gallery_picture}}');	
		$this->dropTable('{{%eg_gallery_picture}}');
		$this->dropForeignKey('fk_gallery_album_translation_album', '{{%eg_gallery_album_translation}}');
		$this->dropTable('{{%eg_gallery_album_translation}}');
		$this->dropForeignKey('fk_gallery_album_category', '{{%eg_gallery_album}}');
		$this->dropTable('{{%eg_gallery_album}}');
		$this->dropForeignKey('fk_category_translation_category', '{{%eg_gallery_category_translation}}');
		$this->dropTable('{{%eg_gallery_category_translation}}');
		$this->dropTable('{{%eg_gallery_category}}');
    }
}