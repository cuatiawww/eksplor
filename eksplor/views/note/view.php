<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Note $model */

$this->title = $model->title ?: 'Note Detail';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center justify-content-between">
      <div class="col-sm-auto">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item"><?= Html::a('Daily Notes', ['index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Note Detail</li>
        </ul>
        <div class="page-header-title">
          <h2 class="mb-0">NOTE DETAIL</h2>
        </div>
      </div>
      <div class="col-sm-auto">
        <?= Html::a('<i class="ph-duotone ph-pencil me-2"></i>Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="ph-duotone ph-trash me-2"></i>Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this note?',
                'method' => 'post',
            ],
        ]) ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><?= Html::encode($model->title ?: 'Untitled') ?></h5>
        <span class="badge <?= $model->getMoodBadge() ?>" style="font-size: 1.5rem;">
          <?= $model->getMoodEmoji() ?>
        </span>
      </div>
      <div class="card-body">
        
        <!-- Date & Mood -->
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="text-muted small">Date</label>
            <p class="mb-0">
              <i class="ph-duotone ph-calendar me-1"></i>
              <?= $model->getFormattedDate() ?>
            </p>
          </div>
          <div class="col-md-6">
            <label class="text-muted small">Mood</label>
            <p class="mb-0">
              <?= $model->getMoodEmoji() ?> <?= $model->getMoodText() ?>
            </p>
          </div>
        </div>

        <hr />

        <!-- Content -->
        <div class="mb-3">
          <label class="text-muted small">Content</label>
          <div class="mt-2" style="white-space: pre-wrap;">
            <?= nl2br(Html::encode($model->content)) ?>
          </div>
        </div>

        <!-- Tags -->
        <?php if ($model->tags): ?>
          <div class="mb-3">
            <label class="text-muted small">Tags</label>
            <div class="mt-2">
              <?php foreach ($model->getTagsArray() as $tag): ?>
                <span class="badge bg-light-secondary me-1">#<?= Html::encode($tag) ?></span>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <hr />

        <!-- Timestamps -->
        <div class="row">
          <div class="col-md-6">
            <label class="text-muted small">Created At</label>
            <p class="mb-0"><?= date('d M Y H:i', strtotime($model->created_at)) ?></p>
          </div>
          <div class="col-md-6">
            <label class="text-muted small">Updated At</label>
            <p class="mb-0"><?= date('d M Y H:i', strtotime($model->updated_at)) ?></p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>