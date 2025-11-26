<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Dashboard';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">Dashboard</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">DASHBOARD</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Search Bar -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="input-group">
          <span class="input-group-text"><i class="ph-duotone ph-magnifying-glass"></i></span>
          <input type="text" class="form-control" placeholder="Search tasks, notes, or anything..." />
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="row">
  <!-- Welcome Card -->
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h3>Selamat Datang di Rumah! 👋</h3>
            <p class="text-muted mb-0">
              Tempat untuk mengatur to-do list dan mencatat cerita harian kamu.
              Kelola task, tulis jurnal, dan pantau produktivitas kamu disini.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Info Cards -->
  <div class="col-md-6 col-xl-3">
    <div class="card bg-primary-dark dashnum-card text-white overflow-hidden">
      <span class="round small"></span>
      <span class="round big"></span>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="avtar avtar-lg">
              <i class="ph-duotone ph-list-checks text-white f-26"></i>
            </div>
          </div>
          <div class="col-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">Total Tasks</li>
            </ul>
          </div>
        </div>
        <span class="d-block f-34 f-w-500 my-2">
          <?= \app\models\Task::find()->count() ?>
        </span>
        <p class="mb-0 opacity-50">
          <span class="text-white"><?= \app\models\Task::find()->where(['status' => 'pending'])->count() ?> pending</span> today
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="card bg-success-dark dashnum-card text-white overflow-hidden">
      <span class="round small"></span>
      <span class="round big"></span>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="avtar avtar-lg">
              <i class="ph-duotone ph-check-circle text-white f-26"></i>
            </div>
          </div>
          <div class="col-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">Completed</li>
            </ul>
          </div>
        </div>
        <span class="d-block f-34 f-w-500 my-2">
          <?= \app\models\Task::find()->where(['status' => 'completed'])->count() ?>
        </span>
        <p class="mb-0 opacity-50">
          <span class="text-white">
            <?php
            $total = \app\models\Task::find()->count();
            $completed = \app\models\Task::find()->where(['status' => 'completed'])->count();
            echo $total > 0 ? round(($completed / $total) * 100) : 0;
            ?>%
          </span> completion rate
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="card bg-warning-dark dashnum-card text-white overflow-hidden">
      <span class="round small"></span>
      <span class="round big"></span>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="avtar avtar-lg">
              <i class="ph-duotone ph-notebook text-white f-26"></i>
            </div>
          </div>
          <div class="col-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">Notes</li>
            </ul>
          </div>
        </div>
        <span class="d-block f-34 f-w-500 my-2">0</span>
        <p class="mb-0 opacity-50">
          <span class="text-white">Coming soon</span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="card bg-danger-dark dashnum-card text-white overflow-hidden">
      <span class="round small"></span>
      <span class="round big"></span>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="avtar avtar-lg">
              <i class="ph-duotone ph-fire text-white f-26"></i>
            </div>
          </div>
          <div class="col-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">High Priority</li>
            </ul>
          </div>
        </div>
        <span class="d-block f-34 f-w-500 my-2">
          <?= \app\models\Task::find()->where(['priority' => 'high'])->count() ?>
        </span>
        <p class="mb-0 opacity-50">
          <span class="text-white">Tasks</span>
        </p>
      </div>
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Quick Actions</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?= Html::a('<i class="ph-duotone ph-plus-circle me-2"></i>Add New Task', ['task/create'], ['class' => 'btn btn-primary w-100 mb-2']) ?>
          </div>
          <div class="col-md-4">
            <?= Html::a('<i class="ph-duotone ph-list-checks me-2"></i>View All Tasks', ['task/index'], ['class' => 'btn btn-success w-100 mb-2']) ?>
          </div>
          <div class="col-md-4">
            <a href="#!" class="btn btn-secondary w-100 mb-2">
              <i class="ph-duotone ph-calendar me-2"></i>View Calendar
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
