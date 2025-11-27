<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var int $taskCount */
/** @var int $noteCount */
/** @var string $dbName */

$this->title = 'Database Information';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item"><?= Html::a('Settings', ['setting/index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Database</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">DATABASE INFORMATION</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 mx-auto">
    
    <!-- Connection Info -->
    <div class="card">
      <div class="card-header">
        <h5><i class="ph-duotone ph-database me-2"></i>Connection Details</h5>
      </div>
      <div class="card-body">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td class="text-muted" width="30%">Database Type</td>
              <td><strong>PostgreSQL</strong></td>
            </tr>
            <tr>
              <td class="text-muted">Connection String</td>
              <td><code><?= Html::encode($dbName) ?></code></td>
            </tr>
            <tr>
              <td class="text-muted">Status</td>
              <td><span class="badge bg-light-success">Connected</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Table Stats -->
    <div class="card mt-3">
      <div class="card-header">
        <h5><i class="ph-duotone ph-table me-2"></i>Table Statistics</h5>
      </div>
      <div class="card-body">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th>Table Name</th>
              <th>Records</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <i class="ph-duotone ph-list-checks me-2"></i>
                <strong>tasks</strong>
              </td>
              <td><?= $taskCount ?> rows</td>
              <td><span class="badge bg-light-success">Active</span></td>
            </tr>
            <tr>
              <td>
                <i class="ph-duotone ph-notebook me-2"></i>
                <strong>notes</strong>
              </td>
              <td><?= $noteCount ?> rows</td>
              <td><span class="badge bg-light-success">Active</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>