<?php

namespace elephantsGroup\gallery\models;

use Yii;

/**
 * This is the model class for table "{{%gallery_picture_translation}}".
 *
 * @property integer $picture_id
 * @property string $language
 * @property string $title
 * @property string $description
 *
 * @property Picture $picture
 */
class PictureTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public static $_STATUS_INACTIVE = 0;
	public static $_STATUS_ACTIVE = 1;
	
	public static function getStatus()
	{
		$module = \Yii::$app->getModule('gallery');
		return [
			self::$_STATUS_INACTIVE => $module::t('gallery', 'Inactive'),
			self::$_STATUS_ACTIVE => $module::t('gallery', 'Active'),
		];
	}

    public static function tableName()
    {
        return '{{%eg_gallery_picture_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		$module_base = \Yii::$app->getModule('base');
        return [
            [['picture_id', 'language'], 'required'],
            [['picture_id'], 'integer'],
			[['status'], 'default', 'value' => self::$_STATUS_INACTIVE],
			[['status'], 'in', 'range' => array_keys(self::getStatus())],
            [['language'], 'string', 'max' => 5],
			[['language'], 'default', 'value' => $module_base::$_LANG_FA],
			[['language'], 'in', 'range' => array_keys($module_base->languages)],
            [['title'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 512],
			[['update_time', 'creation_time'], 'date', 'format' => 'php:Y-m-d H:i:s'],
			[['update_time', 'creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
		$module = \Yii::$app->getModule('gallery');
        return [
            'picture_id' => $module::t('gallery', 'Picture ID'),
            'language' => $module::t('gallery', 'Language'),
            'title' => $module::t('gallery', 'Title'),
            'description' => $module::t('gallery', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        return $this->hasOne(Picture::className(), ['id' => 'picture_id']);
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
}
