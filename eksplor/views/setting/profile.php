<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Profile Settings';
?>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item"><?= Html::a('Settings', ['setting/index']) ?></li>
          <li class="breadcrumb-item" aria-current="page">Profile</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">PROFILE SETTINGS</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header">
        <h5><i class="ph-duotone ph-user me-2"></i>Personal Information</h5>
      </div>
      <div class="card-body">
        
        <!-- Avatar -->
        <div class="text-center mb-4">
          <img src="<?= Yii::getAlias('@web/template-assets/images/user/avatar-1.jpg') ?>" alt="user" class="img-thumbnail rounded-circle" style="width: 120px; height: 120px;" />
          <h5 class="mt-3 mb-0">Yosua</h5>
          <p class="text-muted">Personal Space</p>
        </div>

        <hr />

        <!-- Profile Form (Static for now) -->
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" value="Yosua" />
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="yosua@example.com" />
          </div>

          <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" rows="3">Passionate learner and productivity enthusiast. Building Ruang Yosua to manage tasks and track daily reflections.</textarea>
          </div>

          <div class="alert alert-info" role="alert">
            <i class="ph-duotone ph-info me-2"></i>
            <strong>Note:</strong> Profile editing is coming soon! This is a preview of the settings page.
          </div>

          <div class="d-flex justify-content-end gap-2">
            <?= Html::a('Back to Settings', ['setting/index'], ['class' => 'btn btn-light']) ?>
            <button type="button" class="btn btn-primary" disabled>
              <i class="ph-duotone ph-floppy-disk me-1"></i>Save Changes (Coming Soon)
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>