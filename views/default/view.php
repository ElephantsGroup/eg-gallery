<?php
use yii\web\View;
use elephantsGroup\gallery\assets\PicAsset;

PicAsset::register($this);

$this->registerJs("jQuery(document).ready(function() { $(\".fancybox\").fancybox(); });", View::POS_END);
?>
<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a href="<?= Yii::getAlias('@web') ?>/gallery/default/index" style="color: white"><h1 id="homeHeading"><?= Yii::t('app', 'Album')?></h1></a>
            <hr>
            <p><?php if($album->title) echo '<h3 class="active">' . $album->title . '</h3>'; ?></p>
        </div>
    </div>
</header>

<!-- Start portfolio -->
<section>
    <div class="album-area">
        <!-- Portfolio container -->
        <div id="mixit-container" class="album-container">
            <?php foreach($picture as $pic):?>
                    <div class="single-portfolio  mix album<?= $album->album_id ?>">
                        <div class="single-item">
                            <img src="<?= $pic['thumb'] ?>" alt="img">
                            <div class="single-item-content">
                                <a class="fancybox view-icon" data-fancybox-group="gallery" href="<?= $pic['picture'] ?>"><i class="fa fa-search-plus"></i></a>
                                <div class="portfolio-title">
                                    <h4><?= $album->title ?></h4>
                                    <span><?= $album->title ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach;?>
        </div>
    </div>
</section>
<!-- End portfolio -->
