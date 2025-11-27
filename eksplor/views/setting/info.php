<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $appInfo */
/** @var int $totalTasks */
/** @var int $totalNotes */
/** @var int $completedTasks */
/** @var int $pendingTasks */

$this->title = 'Application Information';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item"><?= Html::a('Settings', ['setting/index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Information</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">APPLICATION INFORMATION</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  
  <!-- App Info Card -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5><i class="ph-duotone ph-info me-2"></i>Application Details</h5>
      </div>
      <div class="card-body">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td class="text-muted" width="40%">Application Name</td>
              <td><strong><?= Html::encode($appInfo['name']) ?></strong></td>
            </tr>
            <tr>
              <td class="text-muted">Version</td>
              <td><span class="badge bg-light-primary"><?= Html::encode($appInfo['version']) ?></span></td>
            </tr>
            <tr>
              <td class="text-muted">Description</td>
              <td><?= Html::encode($appInfo['description']) ?></td>
            </tr>
            <tr>
              <td class="text-muted">Author</td>
              <td><?= Html::encode($appInfo['author']) ?></td>
            </tr>
            <tr>
              <td class="text-muted">Framework</td>
              <td>Yii2 <?= Html::encode($appInfo['yii_version']) ?></td>
            </tr>
            <tr>
              <td class="text-muted">PHP Version</td>
              <td><?= Html::encode($appInfo['php_version']) ?></td>
            </tr>
            <tr>
              <td class="text-muted">Database</td>
              <td><?= Html::encode($appInfo['database']) ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Statistics Card -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5><i class="ph-duotone ph-chart-bar me-2"></i>Usage Statistics</h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-6">
            <div class="text-center p-3 border rounded">
              <h2 class="mb-1 text-primary"><?= $totalTasks ?></h2>
              <p class="text-muted mb-0 small">Total Tasks</p>
            </div>
          </div>
          <div class="col-6">
            <div class="text-center p-3 border rounded">
              <h2 class="mb-1 text-warning"><?= $totalNotes ?></h2>
              <p class="text-muted mb-0 small">Total Notes</p>
            </div>
          </div>
          <div class="col-6">
            <div class="text-center p-3 border rounded">
              <h2 class="mb-1 text-success"><?= $completedTasks ?></h2>
              <p class="text-muted mb-0 small">Completed Tasks</p>
            </div>
          </div>
          <div class="col-6">
            <div class="text-center p-3 border rounded">
              <h2 class="mb-1 text-secondary"><?= $pendingTasks ?></h2>
              <p class="text-muted mb-0 small">Pending Tasks</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Features Card -->
    <div class="card mt-3">
      <div class="card-header">
        <h5><i class="ph-duotone ph-check-square me-2"></i>Features</h5>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li class="mb-2">
            <i class="ph-duotone ph-check-circle text-success me-2"></i>
            Task Management with Priority & Status
          </li>
          <li class="mb-2">
            <i class="ph-duotone ph-check-circle text-success me-2"></i>
            Daily Notes with Mood Tracking
          </li>
          <li class="mb-2">
            <i class="ph-duotone ph-check-circle text-success me-2"></i>
            Dashboard with Statistics
          </li>
          <li class="mb-2">
            <i class="ph-duotone ph-check-circle text-success me-2"></i>
            Dark/Light Theme Switcher
          </li>
          <li class="mb-0">
            <i class="ph-duotone ph-check-circle text-success me-2"></i>
            Responsive Design
          </li>
        </ul>
      </div>
    </div>
  </div>

</div>