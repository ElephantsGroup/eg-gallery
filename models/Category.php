<?php

namespace elephantsGroup\gallery\models;

use Yii;

/**
 * This is the model class for table "{{%gallery_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property integer $sort_order
 * @property integer $status
 * @property string $update_time
 * @property string $creation_time
 *
 * @property Album[] $albums
 * @property CategoryTranslation[] $translations
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $logo_file;	 
    public static $upload_url;
    public static $upload_path;

	public static $_STATUS_INACTIVE = 0;
	public static $_STATUS_ACTIVE = 1;
	
    public function init()
    {
        self::$upload_path = str_replace('/backend', '', Yii::getAlias('@webroot')) . '/uploads/eg-gallery/category/';
        self::$upload_url = str_replace('/backend', '', Yii::getAlias('@web')) . '/uploads/eg-gallery/category/';
        parent::init();
    }

	public static function getStatus()
	{
		$module = \Yii::$app->getModule('base');
		return [
			self::$_STATUS_INACTIVE => $module::t('Inactive'),
			self::$_STATUS_ACTIVE => $module::t('Active'),
		];
	}
	
    public static function tableName()
    {
        return '{{%eg_gallery_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'sort_order'], 'integer'],
            [['status'], 'default', 'value' => self::$_STATUS_INACTIVE],
			[['status'], 'in', 'range' => array_keys(self::getStatus())],
            [['sort_order'], 'default', 'value' => 0],
            [['name'], 'required'],
            [['name', 'logo'], 'trim'],
            [['name'], 'string', 'max' => 64],
            [['logo'], 'string', 'max' => 32],
            [['logo'], 'default', 'value' => 'default.png'],
            [['logo_file'], 'file', 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false],
			[['update_time', 'creation_time'], 'date', 'format' => 'php:Y-m-d H:i:s'],
			[['update_time', 'creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
		$module = \Yii::$app->getModule('base');
        return [
            'id' => $module::t('ID'),
            'name' => $module::t('Name'),
            'status' => $module::t('Status'),
            'logo' => $module::t('Logo'),
			'logo_file' => $module::t('Category Logo'),
            'sort_order' => $module::t('Sort Order'),
            'creation_time' => $module::t('Creation Time'),
            'update_time' => $module::t('Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(CategoryTranslation::className(), ['category_id' => 'id']);
    }

    public function beforeSave($insert)
    {
		$date = new \DateTime();
		$date->setTimestamp(time());
		$date->setTimezone(new \DateTimezone('Iran'));
		$this->update_time = $date->format('Y-m-d H:i:s');
		if($this->isNewRecord)
			$this->creation_time = $date->format('Y-m-d H:i:s');
		return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->logo_file)
		{
			$dir = self::$upload_path . $this->id . '/';
			if(!file_exists($dir))
				mkdir($dir, 0777, true);
			$file_name = 'cat-' . $this->id . '.' . $this->logo_file->extension;
			$this->logo_file->saveAs($dir . $file_name);
			$this->updateAttributes(['logo' => $file_name]);
		}
        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
		foreach($this->translations as $translation)
			$translation->delete();
	
		foreach($this->albums as $album)
			$album->delete();
	
        if($this->logo != 'default.png')
		{
			$file_pah = self::$upload_path . $this->id . '/' . $this->logo;
			if(file_exists($file_pah))
				unlink($file_pah);
        }
		return parent::beforeDelete();
    }
}
