<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace elephantsGroup\gallery\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 2.0
 */
class AlbumAsset extends AssetBundle
{
    public $sourcePath = '@vendor/elephantsgroup/eg-gallery/assets';
   
    public function init() {
        $this->jsOptions['position'] = View::POS_END;
        parent::init();
    }

	public $css = [
	    'css/isotope-filter.css',
    ];
    public $js = [
		'js/isotope.pkgd.js',
		'js/isotope.filter.js',
	];
    public $depends = [
		'yii\web\JqueryAsset',
    ];
}
