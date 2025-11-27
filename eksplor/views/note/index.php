<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Note[] $notes */
/** @var int $totalNotes */
/** @var int $thisWeekNotes */
/** @var int $thisMonthNotes */

$this->title = 'Daily Notes';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center justify-content-between">
      <div class="col-sm-auto">
        <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Daily Notes</li>
        </ul>
        </div>
        <div class="page-header-title">
          <h2 class="mb-0">MY DAILY NOTES</h2>
        </div>
      </div>
      <div class="col-sm-auto">
        <?= Html::a('<i class="ph-duotone ph-note-pencil me-2"></i>Write New Note', ['create'], ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div class="row mb-3">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <div class="avtar avtar-s bg-light-primary">
              <i class="ph-duotone ph-notebook f-20"></i>
            </div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="mb-0">Total Notes</h6>
            <h4 class="mb-0"><?= $totalNotes ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <div class="avtar avtar-s bg-light-success">
              <i class="ph-duotone ph-calendar f-20"></i>
            </div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="mb-0">This Week</h6>
            <h4 class="mb-0"><?= $thisWeekNotes ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <div class="avtar avtar-s bg-light-info">
              <i class="ph-duotone ph-clock f-20"></i>
            </div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="mb-0">This Month</h6>
            <h4 class="mb-0"><?= $thisMonthNotes ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notes Grid -->
<div class="row">
  <?php if (empty($notes)): ?>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="ph-duotone ph-notebook f-40 text-muted mb-3"></i>
          <h5 class="text-muted">Belum ada catatan</h5>
          <p class="text-muted mb-3">Mulai tulis cerita harian kamu hari ini!</p>
          <?= Html::a('<i class="ph-duotone ph-note-pencil me-2"></i>Write First Note', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
      </div>
    </div>
  <?php else: ?>
    <?php foreach ($notes as $note): ?>
      <div class="col-md-6 col-xl-4 mb-3">
        <div class="card border h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <div>
                <h6 class="mb-1"><?= Html::encode($note->title ?: 'Untitled') ?></h6>
                <p class="text-muted mb-0">
                  <small><i class="ph-duotone ph-calendar"></i> <?= $note->getFormattedDate() ?></small>
                </p>
              </div>
              <span class="badge <?= $note->getMoodBadge() ?>" style="font-size: 1.2rem;">
                <?= $note->getMoodEmoji() ?>
              </span>
            </div>
            <p class="mb-2"><?= nl2br(Html::encode($note->getContentPreview())) ?></p>
            <?php if ($note->tags): ?>
              <div class="mb-2">
                <?php foreach ($note->getTagsArray() as $tag): ?>
                  <span class="badge bg-light-secondary me-1">#<?= Html::encode($tag) ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <div class="d-flex justify-content-end gap-1">
              <?= Html::a('<i class="ph-duotone ph-eye"></i>', ['view', 'id' => $note->id], [
                  'class' => 'btn btn-sm btn-light-info',
                  'title' => 'View'
              ]) ?>
              <?= Html::a('<i class="ph-duotone ph-pencil"></i>', ['update', 'id' => $note->id], [
                  'class' => 'btn btn-sm btn-light-primary',
                  'title' => 'Edit'
              ]) ?>
              <?= Html::a('<i class="ph-duotone ph-trash"></i>', ['delete', 'id' => $note->id], [
                  'class' => 'btn btn-sm btn-light-danger',
                  'data' => [
                      'confirm' => 'Are you sure you want to delete this note?',
                      'method' => 'post',
                  ],
                  'title' => 'Delete'
              ]) ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>