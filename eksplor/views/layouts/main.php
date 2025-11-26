<?php

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/template-assets/images/favicon.svg')]);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?> | Ruang Yosua</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    <!-- Template CSS -->
    <!-- Template CSS -->
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template-assets/fonts/tabler-icons.min.css" />
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template-assets/fonts/feather.css" />
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template-assets/fonts/fontawesome.css" />
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template-assets/fonts/material.css" />
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template-assets/css/style.css" id="main-style-link" />
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template-assets/css/style-preset.css" />
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/custom-theme.css" />
    
    <?php $this->head() ?>
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-theme="dark" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
<?php $this->beginBody() ?>

<div class="loader-bg">
  <div class="pc-loader">
    <div class="loader-fill"></div>
  </div>
</div>

<?= $this->render('_sidebar') ?>
<?= $this->render('_header') ?>

<div class="pc-container">
  <div class="pc-content">
    
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?= Yii::$app->session->getFlash('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= Yii::$app->session->getFlash('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?= $content ?>
    
  </div>
</div>

<script src="<?= Yii::getAlias('@web') ?>/template-assets/js/plugins/popper.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/template-assets/js/plugins/simplebar.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/template-assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/template-assets/js/fonts/custom-font.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/template-assets/js/pcoded.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/template-assets/js/plugins/feather.min.js"></script>

<script>
  layout_change('light');
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>