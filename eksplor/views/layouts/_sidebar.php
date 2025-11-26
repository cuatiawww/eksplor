<?php
use yii\helpers\Url;
?>
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">

    <div class="card pc-user-card">
      <div class="card-body">
        <div class="nav-user-image">
          <a data-bs-toggle="collapse" href="#navuserlink">
            <img src="<?= Url::to('@web/assets/images/user/avatar-1.jpg') ?>" alt="user-image" class="user-avtar rounded-circle" />
          </a>
        </div>
        <div class="pc-user-collpsed collapse" id="navuserlink">
          <h4 class="mb-0">Yosua</h4>
          <span>Personal Space</span>
          <ul>
            <li>
              <a class="pc-user-links">
                <i class="ph-duotone ph-user"></i>
                <span>My Account</span>
              </a>
            </li>
            <li>
              <a class="pc-user-links">
                <i class="ph-duotone ph-gear"></i>
                <span>Settings</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Navigation</label>
          <i class="ph-duotone ph-gauge"></i>
          <span>Main Menu</span>
        </li>
        
        <!-- Dashboard -->
        <li class="pc-item <?= Yii::$app->controller->id == 'site' ? 'active' : '' ?>">
          <a href="<?= Url::to(['site/index']) ?>" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-gauge"></i>
            </span>
            <span class="pc-mtext">DASHBOARD</span>
          </a>
        </li>
        
        <!-- TO-DO LIST dengan Dropdown -->
        <li class="pc-item pc-hasmenu <?= Yii::$app->controller->id == 'task' ? 'active pc-trigger' : '' ?>">
          <a href="#!" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-list-checks"></i>
            </span>
            <span class="pc-mtext">TO-DO LIST</span>
            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
          </a>
          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="<?= Url::to(['task/index']) ?>">All Tasks</a></li>
            <li class="pc-item"><a class="pc-link" href="<?= Url::to(['task/create']) ?>">Add Task</a></li>
            <li class="pc-item"><a class="pc-link" href="<?= Url::to(['task/index', 'status' => 'pending']) ?>">Pending</a></li>
            <li class="pc-item"><a class="pc-link" href="<?= Url::to(['task/index', 'status' => 'completed']) ?>">Completed</a></li>
          </ul>
        </li>

        <!-- Section baru: More -->
        <li class="pc-item pc-caption">
          <label>More</label>
          <i class="ph-duotone ph-folder-open"></i>
          <span>Additional Features</span>
        </li>

        <!-- Settings -->
        <li class="pc-item">
          <a href="#!" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-gear"></i>
            </span>
            <span class="pc-mtext">SETTINGS</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->