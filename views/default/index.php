<?php

use elephantsGroup\gallery\assets\AlbumAsset;

AlbumAsset::register($this);
?>
<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1 id="homeHeading"><?= Yii::t('app', 'Albums List')?></h1>
            <hr>
        </div>
    </div>
</header>

<section>
    <div class="cat-album">
        <div class="albumm-area">
            <div class="cat-menu">
                <div class="button-group filters-button-group">
                    <button class="button is-checked" data-filter="*">show all</button>
                    <?php foreach($gallery as $cat => $val): ?>
                        <button class="button" data-filter=".<?= $cat ?>"><?= $val['title'] ?></button>
                    <?php endforeach;?>
                </div>
            </div>
            <div id="mixit-container" class="album-container">
                <div class="grid">
                    <?php foreach($gallery as $cat => $val): ?>
                        <?php foreach($val['albums'] as $al => $pic): ?>
                            <div class="element-item  <?= $cat ?> " data-category=" <?= $cat ?>">
                                <div class="single-item">
                                    <img src="<?= $val['albums'][$al]['logo'] ?>" alt="img">
                                    <div class="single-item-content">
                                        <div class="name">
                                            <h4>
                                                <?= $al ?>
                                            </h4>
                                            <span><a href="<?= Yii::getAlias('@web') ?>/gallery/default/view?id=<?= $val['albums'][$al]['id']?>&lang=<?= isset(Yii::$app->controller->language) ? Yii::$app->controller->language : 'fa-IR' ?>"><?= $al ?></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>