<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Task[] $tasks */
/** @var int $totalTasks */
/** @var int $pendingTasks */
/** @var int $completedTasks */
/** @var int $highPriorityTasks */

$this->title = 'To-Do List';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center justify-content-between">
      <div class="col-sm-auto">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">To-Do List</li>
        </ul>
        <div class="page-header-title">
          <h2 class="mb-0">MY TASKS</h2>
        </div>
      </div>
      <div class="col-sm-auto">
        <?= Html::a('<i class="ph-duotone ph-plus-circle me-2"></i>Add New Task', ['create'], ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div class="row mb-3">
  <div class="col-md-3 col-sm-6">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <div class="avtar avtar-s bg-light-primary">
              <i class="ph-duotone ph-list-checks f-20"></i>
            </div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="mb-0">Total Tasks</h6>
            <h4 class="mb-0"><?= $totalTasks ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <div class="avtar avtar-s bg-light-warning">
              <i class="ph-duotone ph-clock f-20"></i>
            </div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="mb-0">Pending</h6>
            <h4 class="mb-0"><?= $pendingTasks ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <div class="avtar avtar-s bg-light-success">
              <i class="ph-duotone ph-check-circle f-20"></i>
            </div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="mb-0">Completed</h6>
            <h4 class="mb-0"><?= $completedTasks ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <div class="avtar avtar-s bg-light-danger">
              <i class="ph-duotone ph-fire f-20"></i>
            </div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="mb-0">High Priority</h6>
            <h4 class="mb-0"><?= $highPriorityTasks ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tasks Table -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>All Tasks</h5>
      </div>
      <div class="card-body table-border-style">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width: 50px;">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" />
                  </div>
                </th>
                <th>Task Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Task Type</th>
                <th>Reminder</th>
                <th>Tags</th>
                <th>Assigned</th>
                <th style="width: 120px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($tasks)): ?>
                <tr>
                  <td colspan="12" class="text-center text-muted py-5">
                    <i class="ph-duotone ph-list-dashes f-40 mb-2"></i>
                    <p class="mb-0">Belum ada task. Klik "Add New Task" untuk menambahkan.</p>
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($tasks as $task): ?>
                  <tr class="<?= $task->status == 'completed' ? 'table-active' : '' ?>">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input <?= $task->status == 'completed' ? 'input-success' : 'input-primary' ?>" 
                               type="checkbox" <?= $task->status == 'completed' ? 'checked' : '' ?> />
                      </div>
                    </td>
                    <td>
                      <h6 class="mb-0 <?= $task->status == 'completed' ? 'text-decoration-line-through text-muted' : '' ?>">
                        <?= Html::encode($task->title) ?>
                      </h6>
                    </td>
                    <td>
                      <p class="text-muted mb-0 small <?= $task->status == 'completed' ? 'text-decoration-line-through' : '' ?>">
                        <?= Html::encode($task->description ?: '-') ?>
                      </p>
                    </td>
                    <td><span class="badge <?= $task->getCategoryBadge() ?>"><?= ucfirst($task->category ?: 'None') ?></span></td>
                    <td><span class="badge <?= $task->getPriorityBadge() ?>"><?= ucfirst($task->priority) ?></span></td>
                    <td><span class="badge <?= $task->getStatusBadge() ?>"><?= str_replace('_', ' ', ucwords($task->status, '_')) ?></span></td>
                    <td><i class="ph-duotone ph-calendar me-1"></i><?= $task->getFormattedDeadline() ?></td>
                    <td>
                      <?php if ($task->is_urgent): ?>
                        <span class="badge bg-light-danger me-1">Urgent</span>
                      <?php endif; ?>
                      <?php if ($task->is_important): ?>
                        <span class="badge bg-light-warning me-1">Important</span>
                      <?php endif; ?>
                      <?php if ($task->is_recurring): ?>
                        <span class="badge bg-light-info">Recurring</span>
                      <?php endif; ?>
                      <?php if (!$task->is_urgent && !$task->is_important && !$task->is_recurring): ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <span class="badge <?= $task->reminder == 'none' ? 'bg-light-secondary' : 'bg-light-primary' ?>">
                        <?= ucfirst(str_replace('_', ' ', $task->reminder)) ?>
                      </span>
                    </td>
                    <td>
                      <?php if ($task->tags): ?>
                        <?php foreach (explode(',', $task->tags) as $tag): ?>
                          <span class="badge bg-light-secondary me-1">#<?= trim($tag) ?></span>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($task->assigned_to_me): ?>
                        <i class="ph-duotone ph-check-circle text-success"></i> Me
                      <?php else: ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?= Html::a('<i class="ph-duotone ph-pencil f-18"></i>', ['update', 'id' => $task->id], [
                          'class' => 'avtar avtar-xs btn-link-secondary',
                          'title' => 'Update'
                      ]) ?>
                      <?= Html::a('<i class="ph-duotone ph-trash f-18"></i>', ['delete', 'id' => $task->id], [
                          'class' => 'avtar avtar-xs btn-link-danger',
                          'data' => [
                              'confirm' => 'Are you sure you want to delete this task?',
                              'method' => 'post',
                          ],
                          'title' => 'Delete'
                      ]) ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
