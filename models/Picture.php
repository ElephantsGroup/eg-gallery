<?php

namespace elephantsGroup\gallery\models;

use Yii;
use Grafika\Grafika;

/**
 * This is the model class for table "{{%eg_gallery_picture}}".
 *
 * @property integer $id
 * @property integer $album_id
 * @property string $name
 * @property integer $sort_order
 * @property integer $status
 * @property string $update_time
 * @property string $creation_time
 *
 * @property Album $album
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $picture_file;
	public $thumb_file;
    public static $upload_url;
    public static $upload_path;

	public static $_STATUS_INACTIVE = 0;
	public static $_STATUS_ACTIVE = 1;

	public $picture_size = [];

    public function init()
    {
		$module = \Yii::$app->getModule('gallery');
        self::$upload_path = str_replace('/admin', '', Yii::getAlias('@webroot')) . '/uploads/eg-gallery/picture/';
        self::$upload_url = str_replace('/admin', '', Yii::getAlias('@web')) . '/uploads/eg-gallery/picture/';

		if(!isset($module->pictureSize))
		{
			$this->picture_size = [
				'icon' => [
					'name' => $module->pictureIconName,
					'width' => $module->pictureIconWidth,
					'height' => $module->pictureIconHeight
				],
				'larg' => [
					'name' => $module->pictureLargName,
					'width' => $module->pictureLargWidth,
					'height' => $module->pictureLargHeight
				],
				'medium' => [
					'name' => $module->pictureMediumName,
					'width' => $module->pictureMediumWidth,
					'height' => $module->pictureMediumHeight
				],
			];
		}
		else
		{
			$this->picture_size = $module->pictureSize;

			if(!isset($this->picture_size['icon']))
			{
				$this->picture_size['icon'] = [
					'name' => $module->pictureIconName,
					'width' => $module->pictureIconWidth,
					'height' => $module->pictureIconHeight
				];
			}
			else
			{
				if(!isset($this->picture_size['icon']['name']))
					$this->picture_size['icon']['name'] = $module->pictureIconName;

				if(!isset($this->picture_size['icon']['width']))
					$this->picture_size['icon']['width'] = $module->pictureIconWidth;

				if(!isset($this->picture_size['icon']['height']))
					$this->picture_size['icon']['height'] = $module->pictureIconHeight;
			}

			if(!isset($this->picture_size['larg']))
			{
				$this->picture_size['larg'] = [
					'name' => $module->pictureLargName,
					'width' => $module->pictureLargWidth,
					'height' => $module->pictureLargHeight
				];
			}
			else
			{
				if(!isset($this->picture_size['larg']['name']))
					$this->picture_size['larg']['name'] = $module->pictureLargName;

				if(!isset($this->picture_size['larg']['width']))
					$this->picture_size['larg']['width'] = $module->pictureLargWidth;

				if(!isset($this->picture_size['larg']['height']))
					$this->picture_size['larg']['height'] = $module->pictureLargHeight;
			}

			if(!isset($this->picture_size['medium']))
			{
				$this->picture_size['medium'] = [
					'name' => $module->pictureMediumName,
					'width' => $module->pictureMediumWidth,
					'height' => $module->pictureMediumHeight
				];
			}
			else
			{
				if(!isset($this->picture_size['medium']['name']))
					$this->picture_size['medium']['name'] = $module->pictureMediumName;

				if(!isset($this->picture_size['medium']['width']))
					$this->picture_size['medium']['width'] = $module->pictureMediumWidth;

				if(!isset($this->picture_size['medium']['height']))
					$this->picture_size['medium']['height'] = $module->pictureMediumHeight;
			}
		}
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
        return '{{%eg_gallery_picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id'], 'required'],
            [['album_id', 'status', 'sort_order'], 'integer'],
            [['status'], 'default', 'value' => self::$_STATUS_INACTIVE],
			[['status'], 'in', 'range' => array_keys(self::getStatus())],
            [['sort_order'], 'default', 'value' => 0],
			[['thumb'], 'default', 'value'=>'default.png'],
			[['picture'], 'default', 'value'=>'default.png'],
            [['picture_file', 'thumb_file'], 'file', 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
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
		$module_gallery = \Yii::$app->getModule('gallery');
        return [
            'id' => $module::t('ID'),
            'album_id' => $module_gallery::t('gallery', 'Album ID'),
            'name' => $module::t('Name'),
            'status' => $module::t('Status'),
            'sort_order' => $module::t('Sort Order'),
			'creation_time' => $module::t('Creation Time'),
			'update_time' => $module::t('Update Time'),
			'thumb' => $module::t('Thumbnail'),
			'picture' => $module::t('Picture'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
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
        if($this->picture_file)
		{
			$dir = self::$upload_path . $this->id . '/';
			if(!file_exists($dir))
				mkdir($dir, 0777, true);
			$file_name = 'picture' . $this->id . '.' . $this->picture_file->extension;
			$this->picture_file->saveAs($dir . $file_name);
			$this->updateAttributes(['picture' => $file_name]);

			$editor = Grafika::createEditor();
			$editor->open( $image, self::$upload_path . $this->id . '/' . $this->picture);
			$backup = clone $image;
			$image_center = clone $image;

			$width = $image->getWidth();
			$height = $image->getHeight();

			$size = $width > $height ? $height : $width;

			$editor->crop( $image_center, $size, $size, 'center' );
			$editor->save( $image_center, self::$upload_path . $this->id . '/cropped-center.jpg' ); // Cropped version
			$image = [];

			foreach ($this->picture_size as $key => $value)
			{
				$image[$key] = clone $image_center;
				$editor->resizeExact( $image[$key], $value['width'], $value['height'] );
				$editor->save( $image[$key], self::$upload_path . $this->id . '/' . $value['name']);

			}

			$editor->save( $backup, self::$upload_path . $this->id . '/original.jpg' ); // Unaffected by crop version
		}

        if($this->thumb_file)
		{
			$dir = self::$upload_path . $this->id . '/';
			if(!file_exists($dir))
				mkdir($dir, 0777, true);
			$file_name = 'thumb' . $this->id . '.' . $this->thumb_file->extension;
			$this->thumb_file->saveAs($dir . $file_name);
			$this->updateAttributes(['thumb' => $file_name]);
		}
        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
		if($this->picture != 'default.png')
		{

			$file_pah = self::$upload_path . $this->id . '/' . $this->picture;
			if(file_exists($file_pah))
				unlink($file_pah);

			$file_path_center = self::$upload_path . $this->id . '/cropped-center.jpg';
			if(file_exists($file_path_center))
				unlink($file_path_center);

			$file_path_original = self::$upload_path . $this->id . '/original.jpg';
			if(file_exists($file_path_original))
			unlink($file_path_original);

			foreach ($this->picture_size as $key => $value)
			{
				$thumb_path = self::$upload_path . $this->id . '/'. $value['name'];
				if(file_exists($thumb_path))
					unlink($thumb_path);
			}
		}
		if($this->thumb != 'default.png')
		{

			$file_pah = self::$upload_path . $this->id . '/' . $this->thumb;
			if(file_exists($file_pah))
				unlink($file_pah);
		}
		return parent::beforeDelete();
    }
}
