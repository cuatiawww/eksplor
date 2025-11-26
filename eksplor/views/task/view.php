<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Task $model */

$this->title = $model->title;
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center justify-content-between">
      <div class="col-sm-auto">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item"><?= Html::a('To-Do List', ['index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Task Detail</li>
        </ul>
        <div class="page-header-title">
          <h2 class="mb-0">TASK DETAIL</h2>
        </div>
      </div>
      <div class="col-sm-auto">
        <?= Html::a('<i class="ph-duotone ph-pencil me-2"></i>Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="ph-duotone ph-trash me-2"></i>Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this task?',
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
      <div class="card-header">
        <h5><?= Html::encode($model->title) ?></h5>
      </div>
      <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-striped table-bordered detail-view'],
            'attributes' => [
                'id',
                'title',
                'description:ntext',
                [
                    'attribute' => 'priority',
                    'format' => 'raw',
                    'value' => function($model) {
                        return '<span class="badge ' . $model->getPriorityBadge() . '">' . ucfirst($model->priority) . '</span>';
                    }
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function($model) {
                        return '<span class="badge ' . $model->getStatusBadge() . '">' . ucfirst(str_replace('_', ' ', $model->status)) . '</span>';
                    }
                ],
                [
                    'attribute' => 'deadline',
                    'value' => function($model) {
                        return $model->deadline ? date('d M Y', strtotime($model->deadline)) : '-';
                    }
                ],
                [
                    'attribute' => 'category',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->category ? '<span class="badge ' . $model->getCategoryBadge() . '">' . ucfirst($model->category) . '</span>' : '-';
                    }
                ],
                'tags',
                [
                    'attribute' => 'is_urgent',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->is_urgent ? '<span class="badge bg-light-danger">Yes</span>' : '<span class="badge bg-light-secondary">No</span>';
                    }
                ],
                [
                    'attribute' => 'is_important',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->is_important ? '<span class="badge bg-light-warning">Yes</span>' : '<span class="badge bg-light-secondary">No</span>';
                    }
                ],
                [
                    'attribute' => 'is_recurring',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->is_recurring ? '<span class="badge bg-light-info">Yes</span>' : '<span class="badge bg-light-secondary">No</span>';
                    }
                ],
                'reminder',
                [
                    'attribute' => 'assigned_to_me',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->assigned_to_me ? '<i class="ph-duotone ph-check-circle text-success"></i> Me' : '-';
                    }
                ],
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
      </div>
    </div>
  </div>
</div>