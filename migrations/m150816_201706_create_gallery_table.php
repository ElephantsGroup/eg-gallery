<?php

use yii\db\Schema;
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
            'name' => 'عمومی',
        ]);
        $this->insert('{{%eg_gallery_category_translation}}', [
            'category_id' => 1,
            'language' => 'fa-IR',
            'title' => 'عمومی',
        ]);
        $this->insert('{{%eg_gallery_album}}', [
            'name' => 'عمومی',
            'category_id' => 1,
            'logo' => 'album-1.png',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);
        $this->insert('{{%eg_gallery_album_translation}}', [
            'album_id' => 1,
            'language' => 'fa-IR',
            'title' => 'پروژه پلت فرم',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
            'album_id' => 1,
            'name' => 'پلت فرم کلید 1',
            'picture' => 'picture1.jpg',
            'thumb' => 'thumb1.jpg',
            'status' => '1',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
            'album_id' => 1,
            'name' => 'پلت فرم کلید 2',
            'picture' => 'picture2.jpg',
            'thumb' => 'thumb2.jpg',
            'status' => '1',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
            'album_id' => 1,
            'name' => 'پلت فرم کلید 3',
            'picture' => 'picture3.jpg',
            'thumb' => 'thumb3.jpg',
            'status' => '1',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
            'album_id' => 1,
            'name' => 'پلت فرم کلید 4',
            'picture' => 'picture4.jpg',
            'thumb' => 'thumb4.jpg',
            'status' => '1',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
            'album_id' => 1,
            'name' => 'پلت فرم کلید 5',
            'picture' => 'picture5.jpg',
            'thumb' => 'thumb5.jpg',
            'status' => '1',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);
        $this->insert('{{%eg_gallery_picture}}', [
            'album_id' => 1,
            'name' => 'پلت فرم کلید 6',
            'picture' => 'picture6.jpg',
            'thumb' => 'thumb6.jpg',
            'status' => '1',
            'update_time' => 1467629406,
            'creation_time' => 1467629406,
        ]);

        $this->insert('{{%auth_item}}', [
			'name' => '/gallery/category/*',
			'type' => 2,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item}}', [
			'name' => '/gallery/category-translation/*',
			'type' => 2,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item}}', [
			'name' => '/gallery/album/*',
			'type' => 2,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item}}', [
			'name' => '/gallery/album-translation/*',
			'type' => 2,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item}}', [
			'name' => '/gallery/picture/*',
			'type' => 2,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item}}', [
			'name' => '/gallery/video/*',
			'type' => 2,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item}}', [
			'name' => 'gallery_management',
			'type' => 2,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/category/*',
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/category-translation/*',
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/album/*',
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/album-translation/*',
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/picture/*',
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/video/*',
		]);
		$this->insert('{{%auth_item}}', [
			'name' => 'gallery_manager',
			'type' => 1,
			'created_at' => 1467629406,
			'updated_at' => 1467629406
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'gallery_manager',
			'child' => 'gallery_management',
		]);
		$this->insert('{{%auth_item_child}}', [
			'parent' => 'super_admin',
			'child' => 'gallery_manager',
		]);
    }

    public function safeDown()
    {
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'super_admin',
			'child' => 'gallery_manager',
		]);
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'gallery_manager',
			'child' => 'gallery_management',
		]);
		$this->delete('{{%auth_item}}', [
			'name' => 'gallery_manager',
			'type' => 1,
		]);
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/video/*',
		]);
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/picture/*',
		]);
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/album-translation/*',
		]);
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/album/*',
		]);
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/category-translation/*',
		]);
		$this->delete('{{%auth_item_child}}', [
			'parent' => 'gallery_management',
			'child' => '/gallery/category/*',
		]);
		$this->delete('{{%auth_item}}', [
			'name' => 'gallery_management',
			'type' => 2,
		]);
		$this->delete('{{%auth_item}}', [
			'name' => '/gallery/video/*',
			'type' => 2,
		]);
		$this->delete('{{%auth_item}}', [
			'name' => '/gallery/picture/*',
			'type' => 2,
		]);
		$this->delete('{{%auth_item}}', [
			'name' => '/gallery/album-translation/*',
			'type' => 2,
		]);
		$this->delete('{{%auth_item}}', [
			'name' => '/gallery/album/*',
			'type' => 2,
		]);
		$this->delete('{{%auth_item}}', [
			'name' => '/gallery/category-translation/*',
			'type' => 2,
		]);
		$this->delete('{{%auth_item}}', [
			'name' => '/gallery/category/*',
			'type' => 2,
		]);

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