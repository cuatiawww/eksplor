<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Note $model */

$this->title = 'Update Note';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item"><?= Html::a('Daily Notes', ['index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Update Note</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">UPDATE NOTE</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>