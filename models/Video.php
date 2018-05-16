<?php

namespace elephantsGroup\gallery\models;

use Yii;

/**
 * This is the model class for table "{{%eg_gallery_video}}".
 *
 * @property integer $id
 * @property integer $album_id
 * @property string $name
 * @property string $video
 * @property string $thumb
 * @property integer $sort_order
 * @property integer $status
 * @property string $update_time
 * @property string $creation_time
 *
 * @property Album $album
 */
class Video extends \yii\db\ActiveRecord
{
    public $thumb_file;
    public $video_file;

    public static $_STATUS_INACTIVE = 0;
    public static $_STATUS_ACTIVE = 1;

    public static $upload_url;
    public static $upload_path;


    public function init()
    {
        self::$upload_url = str_replace('/backend', '', Yii::getAlias('@web')) . '/uploads/eg-gallery/video/';
        self::$upload_path = str_replace('/backend', '', Yii::getAlias('@webroot')) . '/uploads/eg-gallery/video/';
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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_gallery_video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id', 'name'], 'required'],
            [['album_id', 'sort_order', 'status'], 'integer'],
            [['name', 'video', 'thumb'], 'trim'],
            [['update_time', 'creation_time'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['name', 'video', 'thumb'], 'string', 'max' => 64],
            [['sort_order'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => self::$_STATUS_INACTIVE],
            [['update_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['status'], 'in', 'range' => array_keys(self::getStatus())],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['thumb_file'], 'file', 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
            [['video_file'], 'file', 'extensions' => 'mp4, avi', 'maxSize' => 2097152, 'checkExtensionByMimeType'=>false], /*The maximum number of bytes required for the uploaded file*/
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
            'video' => $module_gallery::t('gallery', 'Video'),
            'thumb' => $module::t('Thumbnail'),
            'video_file' => $module_gallery::t('gallery', 'Video'),
            'thumb_file' => $module::t('Thumbnail'),
            'sort_order' => $module::t('Sort Order'),
            'status' => $module::t('Status'),
            'update_time' => $module::t('Update Time'),
            'creation_time' => $module::t('Creation Time'),
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
        if($this->video_file)
        {
            $dir = self::$upload_path . $this->id . '/';
            if(!file_exists($dir))
                mkdir($dir, 0777, true);
            $file_name = 'video' . $this->id . '.' . $this->video_file->extension;
            $this->video_file->saveAs($dir . $file_name);
            $this->updateAttributes(['video' => $file_name]);
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
        if($this->video != 'default.mp4')
        {

            $file_pah = self::$upload_path . $this->id . '/' . $this->video;
            if(file_exists($file_pah))
                unlink($file_pah);
        }
        if($this->thumb != 'default.png')
        {

            $file_pah = self::$upload_path . $this->id . '/' . $this->thumb;
            if(file_exists($file_pah))
                unlink($file_pah);
        }
        return parent::beforeDelete();
    }




    /**
     * @inheritdoc
     * @return VideoQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new VideoQuery(get_called_class());
    }*/
}
