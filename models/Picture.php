<?php

namespace elephantsGroup\gallery\models;

use Yii;
use Grafika\Grafika;
use Grafika\Color;

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
 * @property PictureTranslation[] $translations
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

		if (isset($module->pictureSize))
		{
			$this->picture_size = $module->pictureSize;

			if (!isset($this->picture_size['original']) || !isset($this->picture_size['original']['name']))
				$this->picture_size['original']['name'] = $module->pictureOriginalName;

			if (!isset($this->picture_size['icon']))
			{
				$this->picture_size['icon'] = [
					'name' => $module->pictureIconName,
					'width' => $module->pictureIconWidth,
					'height' => $module->pictureIconHeight,
					'watermark' => $module->pictureIconWatermark === 'inherit' ? $module->watermark : $module->pictureIconWatermark,
					'crosslines' => $module->pictureIconCrosslines === 'inherit' ? $module->crosslines : $module->pictureIconCrosslines,
					'text' => $module->pictureIconText === 'inherit' ? $module->text : $module->pictureIconText
				];
			}
			else
			{
				if (!isset($this->picture_size['icon']['name']))
					$this->picture_size['icon']['name'] = $module->pictureIconName;

				if (!isset($this->picture_size['icon']['width']))
					$this->picture_size['icon']['width'] = $module->pictureIconWidth;

				if (!isset($this->picture_size['icon']['height']))
					$this->picture_size['icon']['height'] = $module->pictureIconHeight;

				if (!isset($this->picture_size['icon']['watermark']))
					$this->picture_size['icon']['watermark'] = $module->pictureIconWatermark;

				if (!isset($this->picture_size['icon']['crosslines']))
					$this->picture_size['icon']['crosslines'] = $module->pictureIconCrosslines;

				if (!isset($this->picture_size['icon']['text']))
					$this->picture_size['icon']['text'] = $module->pictureIconText === 'inherit' ? $module->text : $module->pictureIconText;
			}

			if (!isset($this->picture_size['thumb']))
			{
				$this->picture_size['thumb'] = [
					'name' => $module->pictureThumbName,
					'width' => $module->pictureThumbWidth,
					'height' => $module->pictureThumbHeight,
					'watermark' => $module->pictureThumbWatermark === 'inherit' ? $module->watermark : $module->pictureThumbWatermark,
					'crosslines' => $module->pictureThumbCrosslines === 'inherit' ? $module->crosslines : $module->pictureThumbCrosslines,
					'text' => $module->pictureThumbText === 'inherit' ? $module->text : $module->pictureThumbText
				];
			}
			else
			{
				if (!isset($this->picture_size['thumb']['name']))
					$this->picture_size['thumb']['name'] = $module->pictureThumbName;

				if (!isset($this->picture_size['thumb']['width']))
					$this->picture_size['thumb']['width'] = $module->pictureThumbWidth;

				if (!isset($this->picture_size['thumb']['height']))
					$this->picture_size['thumb']['height'] = $module->pictureThumbHeight;

				if (!isset($this->picture_size['thumb']['watermark']))
					$this->picture_size['thumb']['watermark'] = $module->pictureThumbWatermark;

				if (!isset($this->picture_size['thumb']['crosslines']))
					$this->picture_size['thumb']['crosslines'] = $module->pictureThumbCrosslines;

				if (!isset($this->picture_size['thumb']['text']))
					$this->picture_size['thumb']['text'] = $module->pictureThumbText === 'inherit' ? $module->text : $module->pictureThumbText;
			}

			if (!isset($this->picture_size['small']))
			{
				$this->picture_size['small'] = [
					'name' => $module->pictureSmallName,
					'width' => $module->pictureSmallWidth,
					'height' => $module->pictureSmallHeight,
					'watermark' => $module->pictureSmallWatermark === 'inherit' ? $module->watermark : $module->pictureSmallWatermark,
					'crosslines' => $module->pictureSmallCrosslines === 'inherit' ? $module->crosslines : $module->pictureSmallCrosslines,
					'text' => $module->pictureSmallText === 'inherit' ? $module->text : $module->pictureSmallText
				];
			}
			else
			{
				if (!isset($this->picture_size['small']['name']))
					$this->picture_size['small']['name'] = $module->pictureSmallName;

				if (!isset($this->picture_size['small']['width']))
					$this->picture_size['small']['width'] = $module->pictureSmallWidth;

				if (!isset($this->picture_size['small']['height']))
					$this->picture_size['small']['height'] = $module->pictureSmallHeight;

				if (!isset($this->picture_size['small']['watermark']))
					$this->picture_size['small']['watermark'] = $module->pictureSmallWatermark;

				if (!isset($this->picture_size['small']['crosslines']))
					$this->picture_size['small']['crosslines'] = $module->pictureSmallCrosslines;

				if (!isset($this->picture_size['small']['text']))
					$this->picture_size['small']['text'] = $module->pictureSmallText === 'inherit' ? $module->text : $module->pictureSmallText;
			}

			if(!isset($this->picture_size['medium']))
			{
				$this->picture_size['medium'] = [
					'name' => $module->pictureMediumName,
					'width' => $module->pictureMediumWidth,
					'height' => $module->pictureMediumHeight,
					'watermark' => $module->pictureMediumWatermark === 'inherit' ? $module->watermark : $module->pictureMediumWatermark,
					'crosslines' => $module->pictureMediumCrosslines === 'inherit' ? $module->crosslines : $module->pictureMediumCrosslines,
					'text' => $module->pictureMediumText === 'inherit' ? $module->text : $module->pictureMediumText
				];
			}
			else
			{
				if (!isset($this->picture_size['medium']['name']))
					$this->picture_size['medium']['name'] = $module->pictureMediumName;

				if (!isset($this->picture_size['medium']['width']))
					$this->picture_size['medium']['width'] = $module->pictureMediumWidth;

				if (!isset($this->picture_size['medium']['height']))
					$this->picture_size['medium']['height'] = $module->pictureMediumHeight;

				if (!isset($this->picture_size['medium']['watermark']))
					$this->picture_size['medium']['watermark'] = $module->pictureMediumWatermark;

				if (!isset($this->picture_size['medium']['crosslines']))
					$this->picture_size['medium']['crosslines'] = $module->pictureMediumCrosslines;

				if (!isset($this->picture_size['medium']['text']))
					$this->picture_size['medium']['text'] = $module->pictureMediumText === 'inherit' ? $module->text : $module->pictureMediumText;
			}

			if (!isset($this->picture_size['large']))
			{
				$this->picture_size['large'] = [
					'name' => $module->pictureLargeName,
					'width' => $module->pictureLargeWidth,
					'height' => $module->pictureLargeHeight,
					'watermark' => $module->pictureLargeWatermark === 'inherit' ? $module->watermark : $module->pictureLargeWatermark,
					'crosslines' => $module->pictureLargeCrosslines === 'inherit' ? $module->crosslines : $module->pictureLargeCrosslines,
					'text' => $module->pictureLargeText === 'inherit' ? $module->text : $module->pictureLargeText
				];
			}
			else
			{
				if (!isset($this->picture_size['large']['name']))
					$this->picture_size['large']['name'] = $module->pictureLargeName;

				if (!isset($this->picture_size['large']['width']))
					$this->picture_size['large']['width'] = $module->pictureLargeWidth;

				if (!isset($this->picture_size['large']['height']))
					$this->picture_size['large']['height'] = $module->pictureLargeHeight;

				if (!isset($this->picture_size['large']['watermark']))
					$this->picture_size['large']['watermark'] = $module->pictureLargeWatermark;

				if (!isset($this->picture_size['large']['crosslines']))
					$this->picture_size['large']['crosslines'] = $module->pictureLargeCrosslines;

				if (!isset($this->picture_size['large']['text']))
					$this->picture_size['large']['text'] = $module->pictureLargeText === 'inherit' ? $module->text : $module->pictureLargeText;
			}
		}
		else
		{
			$this->picture_size = [
				'original' => [
					'name' => $module->pictureOriginalName,
				],
				'icon' => [
					'name' => $module->pictureIconName,
					'width' => $module->pictureIconWidth,
					'height' => $module->pictureIconHeight,
					'watermark' => $module->pictureIconWatermark,
					'crosslines' => $module->pictureIconCrosslines,
					'text' => $module->pictureIconText
				],
				'thumb' => [
					'name' => $module->pictureThumbName,
					'width' => $module->pictureThumbWidth,
					'height' => $module->pictureThumbHeight,
					'watermark' => $module->pictureThumbWatermark,
					'crosslines' => $module->pictureThumbCrosslines,
					'text' => $module->pictureThumbText
				],
				'smalll' => [
					'name' => $module->pictureSmallName,
					'width' => $module->pictureSmallWidth,
					'height' => $module->pictureSmallHeight,
					'watermark' => $module->pictureSmallWatermark,
					'crosslines' => $module->pictureSmallCrosslines,
					'text' => $module->pictureSmallText
				],
				'medium' => [
					'name' => $module->pictureMediumName,
					'width' => $module->pictureMediumWidth,
					'height' => $module->pictureMediumHeight,
					'watermark' => $module->pictureMediumWatermark,
					'crosslines' => $module->pictureMediumCrosslines,
					'text' => $module->pictureMediumText
				],
				'large' => [
					'name' => $module->pictureLargeName,
					'width' => $module->pictureLargeWidth,
					'height' => $module->pictureLargeHeight,
					'watermark' => $module->pictureLargeWatermark,
					'crosslines' => $module->pictureLargeCrosslines,
					'text' => $module->pictureLargeText
				],
			];
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
            [['name'], 'string'],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(PictureTranslation::className(), ['picture_id' => 'id']);
    }

	public function getTitle()
	{
		$translate = PictureTranslation::findOne(['picture_id'=>$this->id, 'language'=>Yii::$app->language]);
		if($translate)
			return $translate->title;
		return null;
	}

	public function getDescription()
	{
		$translate = PictureTranslation::findOne(['picture_id'=>$this->id, 'language'=>Yii::$app->language]);
		if($translate)
			return $translate->description;
		return null;
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

	public function generateImages()
	{
		$module = Yii::$app->getModule('gallery');

		$editor = Grafika::createEditor();
		$editor->open( $image, self::$upload_path . $this->id . '/' . $this->picture );
		if (isset($module->watermark) && !empty($module->watermark))
			$editor->open( $watermark, Yii::getAlias('@webroot') . $module->watermark ) ;
		$backup = clone $image;
		$image_center = clone $image;

		$width = $image->getWidth();
		$height = $image->getHeight();
		$size = $width > $height ? $height : $width;
		$editor->crop( $image_center, $size, $size, 'center' );

		$image_center_watermark = clone $image_center;
		if (isset($module->crosslines) && $module->crosslines)
		{
			$editor->draw( $image_center_watermark, Grafika::createDrawingObject('Line', array(0, 0), array($size, $size), 1, new Color('#FF0000')));
			$editor->draw( $image_center_watermark, Grafika::createDrawingObject('Line', array(0, $size), array($size, 0), 1, new Color('#FF0000')));
		}
		if (isset($module->watermark) && !empty($module->watermark))
		{
			$editor->resizeExact( $watermark, intval($size / 7), intval($size / 7) );
			$editor->blend( $image_center_watermark,  $watermark, 'multiply', 0.3, 'top-right' );
		}
		if (isset($module->text) && !empty($module->text))
		{
			$editor->text( $image_center_watermark, $module->text, 12, 5, 5 );
		}
		$editor->save( $image_center_watermark, self::$upload_path . $this->id . '/cropped-center.jpg' ); // Cropped version

		$image = [];
		foreach ($this->picture_size as $key => $value)
		{
			if ($key === 'original')
				continue;
			else if ($key === 'icon' || $key === 'thumb')
				$image[$key] = clone $image_center;
			else
				$image[$key] = clone $backup;
			$editor->resizeExact($image[$key], $value['width'], $value['height']);
			$size = $value['width'] > $value['height'] ? $value['height'] : $value['width'];
			if ($value['crosslines'])
			{
				$editor->draw( $image[$key], Grafika::createDrawingObject('Line', array(0, 0), array($value['width'], $value['height']), 1, new Color('#FF0000')));
				$editor->draw( $image[$key], Grafika::createDrawingObject('Line', array(0, $value['height']), array($value['width'], 0), 1, new Color('#FF0000')));
			}
			if (!empty($value['text']))
			{
				$editor->text( $image[$key], $value['text'], 12, 5, 5 );
			}
			if ($value['watermark'])
			{
				$editor->resizeExact($watermark, intval($size / 7), intval($size / 7));
				$editor->blend( $image[$key],  $watermark, 'multiply', 0.3, 'top-right' );
			}
			$editor->save($image[$key], self::$upload_path . $this->id . '/' . $value['name']);
		}

		$editor->save($backup, self::$upload_path . $this->id . '/' . $this->picture_size['original']['name']); // Unaffected by crop version
	}

	public function afterSave($insert, $changedAttributes)
    {
		if ($this->picture_file)
		{
			$dir = self::$upload_path . $this->id . '/';
			if(!file_exists($dir))
				mkdir($dir, 0777, true);
			$file_name = 'picture' . $this->id . '.' . $this->picture_file->extension;
			$this->picture_file->saveAs($dir . $file_name);
			$this->updateAttributes(['picture' => $file_name]);
			$this->generateImages();
		}

        if ($this->thumb_file)
		{
			$dir = self::$upload_path . $this->id . '/';
			if(!file_exists($dir))
				mkdir($dir, 0777, true);
			$file_name = 'thumb' . $this->id . '.' . $this->thumb_file->extension;
			$this->thumb_file->saveAs($dir . $file_name);
			$this->updateAttributes(['thumb' => $file_name]);
		}
		else
		{
			$dir = self::$upload_path . $this->id . '/';
			if(!file_exists($dir))
				mkdir($dir, 0777, true);
			$file_name = $this->picture_size['thumb']['name'];
			$this->updateAttributes(['thumb' => $file_name]);
		}

		return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
		foreach($this->translations as $translation)
			$translation->delete();

		if ($this->picture != 'default.png')
		{
			$file_path = self::$upload_path . $this->id . '/' . $this->picture;
			if(file_exists($file_path))
				unlink($file_path);

			$file_path_center = self::$upload_path . $this->id . '/cropped-center.jpg';
			if(file_exists($file_path_center))
				unlink($file_path_center);

			$file_path_original = self::$upload_path . $this->id . $this->picture_size['original']['name'];
			if(file_exists($file_path_original))
				unlink($file_path_original);

			foreach ($this->picture_size as $key => $value)
			{
				$thumb_path = self::$upload_path . $this->id . '/'. $value['name'];
				if(file_exists($thumb_path))
					unlink($thumb_path);
			}
		}
		if ($this->thumb != 'default.png')
		{

			$file_pah = self::$upload_path . $this->id . '/' . $this->thumb;
			if(file_exists($file_pah))
				unlink($file_pah);
		}

		// TODO; delete folder

		return parent::beforeDelete();
    }
}
