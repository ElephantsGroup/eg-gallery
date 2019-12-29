<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m180608_173014_add_gallery_management
 */
class m180608_173014_add_gallery_management extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$db = \Yii::$app->db;
		$query = new Query();
        if ($db->schema->getTableSchema("{{%auth_item}}", true) !== null)
		{
			if (!$query->from('{{%auth_item}}')->where(['name' => '/gallery/album/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/gallery/album/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/gallery/category/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/gallery/category/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/gallery/album-translation/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/gallery/album-translation/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/gallery/category-translation/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/gallery/category-translation/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/gallery/picture/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/gallery/picture/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/gallery/video/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/gallery/video/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'gallery_management'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'gallery_management',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'gallery_manager'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'gallery_manager',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'administrator'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'administrator',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_item_child}}", true) !== null)
		{
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'gallery_management', 'child' => '/gallery/album/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'gallery_management',
					'child'		=> '/gallery/album/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'gallery_management', 'child' => '/gallery/category/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'gallery_management',
					'child'		=> '/gallery/category/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'gallery_management', 'child' => '/gallery/album-translation/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'gallery_management',
					'child'		=> '/gallery/album-translation/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'gallery_management', 'child' => '/gallery/category-translation/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'gallery_management',
					'child'		=> '/gallery/category-translation/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'gallery_management', 'child' => '/gallery/picture/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'gallery_management',
					'child'		=> '/gallery/picture/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'gallery_management', 'child' => '/gallery/video/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'gallery_management',
					'child'		=> '/gallery/video/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'gallery_manager', 'child' => 'gallery_management'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'gallery_manager',
					'child'		=> 'gallery_management'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'administrator', 'child' => 'gallery_manager'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'administrator',
					'child'		=> 'gallery_manager'
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_assignment}}", true) !== null)
		{
			if (!$query->from('{{%auth_assignment}}')->where(['item_name' => 'administrator', 'user_id' => 1])->exists())
				$this->insert('{{%auth_assignment}}', [
					'item_name'	=> 'administrator',
					'user_id'	=> 1,
					'created_at' => time()
				]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		// it's not safe to remove auth data in migration down
    }
}
