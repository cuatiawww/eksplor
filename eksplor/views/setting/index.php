<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Settings';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Settings</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">SETTINGS</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Settings Menu -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5><i class="ph-duotone ph-gear me-2"></i>Application Settings</h5>
      </div>
      <div class="card-body">
        <div class="list-group list-group-flush">
          
          <!-- Profile -->
          <a href="<?= Url::to(['setting/profile']) ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="avtar avtar-s bg-light-primary">
                <i class="ph-duotone ph-user f-20"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="mb-0">Profile Settings</h6>
              <p class="text-muted mb-0 small">Manage your personal information</p>
            </div>
            <div>
              <i class="ph-duotone ph-caret-right"></i>
            </div>
          </a>

          <!-- Information -->
          <a href="<?= Url::to(['setting/info']) ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="avtar avtar-s bg-light-info">
                <i class="ph-duotone ph-info f-20"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="mb-0">Application Information</h6>
              <p class="text-muted mb-0 small">View app version, stats, and system info</p>
            </div>
            <div>
              <i class="ph-duotone ph-caret-right"></i>
            </div>
          </a>

          <!-- Database -->
          <a href="<?= Url::to(['setting/database']) ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="avtar avtar-s bg-light-success">
                <i class="ph-duotone ph-database f-20"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="mb-0">Database Information</h6>
              <p class="text-muted mb-0 small">View database connection and table stats</p>
            </div>
            <div>
              <i class="ph-duotone ph-caret-right"></i>
            </div>
          </a>

          <!-- Theme -->
          <div class="list-group-item d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="avtar avtar-s bg-light-warning">
                <i class="ph-duotone ph-palette f-20"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="mb-0">Theme Preference</h6>
              <p class="text-muted mb-0 small">Change between light and dark mode</p>
            </div>
            <div>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-light-primary" onclick="layout_change('light')">
                  <i class="ph-duotone ph-sun-dim"></i> Light
                </button>
                <button type="button" class="btn btn-sm btn-light-primary" onclick="layout_change('dark')">
                  <i class="ph-duotone ph-moon"></i> Dark
                </button>
              </div>
            </div>
          </div>

          <!-- About -->
          <div class="list-group-item d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="avtar avtar-s bg-light-secondary">
                <i class="ph-duotone ph-heart f-20"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="mb-0">About</h6>
              <p class="text-muted mb-0 small">Ruang Yosua v1.0.0 - Made with ❤️ by Yosua</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>