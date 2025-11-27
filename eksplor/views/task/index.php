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

// Register CSS
$this->registerCssFile(Yii::getAlias('@web') . '/template-assets/css/plugins/dataTables.bootstrap5.min.css', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile(Yii::getAlias('@web') . '/template-assets/css/plugins/flatpickr.min.css', ['position' => \yii\web\View::POS_HEAD]);

// Register JS - DataTables and Flatpickr
$this->registerJsFile(Yii::getAlias('@web') . '/template-assets/js/plugins/dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile(Yii::getAlias('@web') . '/template-assets/js/plugins/dataTables.bootstrap5.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile(Yii::getAlias('@web') . '/template-assets/js/plugins/flatpickr.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<!-- Custom Styles for Table -->
<style>
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.02);
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: #ffffff;
}

.table-striped tbody tr:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
}

tfoot input,
tfoot select {
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
}

tfoot select {
    background-color: #fff;
    cursor: pointer;
}

.dataTables_wrapper .dataTables_length select {
    padding: 0.375rem 2rem 0.375rem 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
}

.dataTables_wrapper .dataTables_filter input {
    padding: 0.375rem 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    margin-left: 0.5rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.375rem 0.75rem;
    margin: 0 0.125rem;
    border-radius: 0.375rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: var(--bs-primary) !important;
    color: white !important;
    border-color: var(--bs-primary) !important;
}

/* Column Header Sorting Styles */
#task-table thead th {
    cursor: pointer;
    user-select: none;
    position: relative;
    padding-right: 30px !important;
}

#task-table thead th:first-child {
    cursor: default;
    padding-right: 0.75rem !important;
}

#task-table thead th:last-child {
    cursor: default;
    padding-right: 0.75rem !important;
}

/* DataTables sorting icons */
table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc {
    background-repeat: no-repeat;
    background-position: center right 8px;
}

table.dataTable thead .sorting {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3E%3Cpath fill='%23999' d='M8 3l4 4H4l4-4zm0 10l-4-4h8l-4 4z'/%3E%3C/svg%3E");
}

table.dataTable thead .sorting_asc {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3E%3Cpath fill='%234680ff' d='M8 3l4 4H4l4-4z'/%3E%3Cpath fill='%23ccc' d='M8 13l-4-4h8l-4 4z'/%3E%3C/svg%3E");
}

table.dataTable thead .sorting_desc {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3E%3Cpath fill='%23ccc' d='M8 3l4 4H4l4-4z'/%3E%3Cpath fill='%234680ff' d='M8 13l-4-4h8l-4 4z'/%3E%3C/svg%3E");
}

/* Hover effect for sortable columns */
#task-table thead th:hover:not(:first-child):not(:last-child) {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}

/* Tooltip pointer cursor */
[data-bs-toggle="tooltip"] {
    cursor: help;
}

#task-table thead th[data-bs-toggle="tooltip"] {
    cursor: pointer;
}
</style>

<!-- Breadcrumb -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
          <li class="breadcrumb-item active" aria-current="page">To-Do List</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">MY TASKS</h2>
        </div>
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
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="mb-0">All Tasks</h5>
          <div>
            <?= Html::button('<i class="ph-duotone ph-trash me-2"></i>Delete Selected', [
                'id' => 'delete-selected-btn',
                'class' => 'btn btn-danger me-2',
                'style' => 'display:none;'
            ]) ?>
            <?= Html::a('<i class="ph-duotone ph-plus-circle me-2"></i>Add New Task', ['create'], ['class' => 'btn btn-primary']) ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="task-table" class="table table-hover table-striped">
            <thead>
              <tr>
                <th style="width: 50px;">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="select-all"
                           data-bs-toggle="tooltip"
                           data-bs-placement="top"
                           title="Select all tasks on this page" />
                  </div>
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by task title">
                  TASK TITLE
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by description">
                  DESCRIPTION
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by category">
                  CATEGORY
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by priority level">
                  PRIORITY
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by status">
                  STATUS
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by deadline date">
                  DEADLINE
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by task type">
                  TASK TYPE
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by reminder setting">
                  REMINDER
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by tags">
                  TAGS
                </th>
                <th data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Click to sort by assignment">
                  ASSIGNED
                </th>
                <th style="width: 120px;"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Edit or delete task">
                  ACTIONS
                </th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
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
                  <tr data-task-id="<?= $task->id ?>">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input task-checkbox" type="checkbox" value="<?= $task->id ?>" />
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
                    <td>
                      <span class="badge <?= $task->getCategoryBadge() ?>"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Category: <?= ucfirst($task->category ?: 'None') ?>">
                        <?= ucfirst($task->category ?: 'None') ?>
                      </span>
                    </td>
                    <td>
                      <span class="badge <?= $task->getPriorityBadge() ?>"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Priority Level: <?= ucfirst($task->priority) ?>">
                        <?= ucfirst($task->priority) ?>
                      </span>
                    </td>
                    <td>
                      <span class="badge <?= $task->getStatusBadge() ?>"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Current Status: <?= str_replace('_', ' ', ucwords($task->status, '_')) ?>">
                        <?= str_replace('_', ' ', ucwords($task->status, '_')) ?>
                      </span>
                    </td>
                    <td>
                      <i class="ph-duotone ph-calendar me-1"></i><?= $task->getFormattedDeadline() ?>
                    </td>
                    <td>
                      <?php if ($task->is_urgent): ?>
                        <span class="badge bg-light-danger me-1"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="This task is urgent!">Urgent</span>
                      <?php endif; ?>
                      <?php if ($task->is_important): ?>
                        <span class="badge bg-light-warning me-1"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="This task is important!">Important</span>
                      <?php endif; ?>
                      <?php if ($task->is_recurring): ?>
                        <span class="badge bg-light-info"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="This task repeats regularly">Recurring</span>
                      <?php endif; ?>
                      <?php if (!$task->is_urgent && !$task->is_important && !$task->is_recurring): ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <span class="badge <?= $task->reminder == 'none' ? 'bg-light-secondary' : 'bg-light-primary' ?>"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Reminder: <?= ucfirst(str_replace('_', ' ', $task->reminder)) ?>">
                        <?= ucfirst(str_replace('_', ' ', $task->reminder)) ?>
                      </span>
                    </td>
                    <td>
                      <?php if ($task->tags): ?>
                        <?php foreach (explode(',', $task->tags) as $tag): ?>
                          <span class="badge bg-light-secondary me-1"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Tag: <?= trim($tag) ?>">#<?= trim($tag) ?></span>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($task->assigned_to_me): ?>
                        <i class="ph-duotone ph-check-circle text-success"
                           data-bs-toggle="tooltip"
                           data-bs-placement="top"
                           title="Assigned to you"></i> Me
                      <?php else: ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?= Html::a('<i class="ph-duotone ph-pencil f-18"></i>', ['update', 'id' => $task->id], [
                          'class' => 'avtar avtar-xs btn-link-secondary',
                          'data-bs-toggle' => 'tooltip',
                          'data-bs-placement' => 'top',
                          'title' => 'Edit Task'
                      ]) ?>
                      <?= Html::button('<i class="ph-duotone ph-trash f-18"></i>', [
                          'class' => 'avtar avtar-xs btn-link-danger delete-task',
                          'data-bs-toggle' => 'tooltip',
                          'data-bs-placement' => 'top',
                          'title' => 'Delete Task',
                          'data-task-id' => $task->id
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">
          <i class="ph-duotone ph-warning-circle text-danger me-2"></i>Confirm Delete
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <strong id="delete-count">0</strong> task(s)?</p>
        <p class="text-muted small mb-0">This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm-delete-btn">
          <i class="ph-duotone ph-trash me-2"></i>Delete
        </button>
      </div>
    </div>
  </div>
</div>

<?php
$bulkDeleteUrl = Url::to(['task/bulk-delete']);
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;

$script = <<< JS
// DataTable initialization
var taskTable;
var selectedTasks = [];

$(document).ready(function() {
    console.log('jQuery loaded:', typeof jQuery !== 'undefined');
    console.log('DataTables available:', typeof $.fn.DataTable !== 'undefined');
    console.log('Flatpickr available:', typeof flatpickr !== 'undefined');

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Function to initialize/reinitialize tooltips
    function initTooltips() {
        // Destroy existing tooltips
        $('[data-bs-toggle="tooltip"]').each(function() {
            var tooltip = bootstrap.Tooltip.getInstance(this);
            if (tooltip) {
                tooltip.dispose();
            }
        });

        // Initialize new tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Only initialize DataTable if there are tasks
    if ($('#task-table tbody tr').length > 0 && !$('#task-table tbody tr td[colspan="12"]').length) {
        // Initialize DataTable
        taskTable = $('#task-table').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: [0, 11] },
                { searchable: false, targets: [0, 11] }
            ],
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ tasks",
                infoEmpty: "Showing 0 to 0 of 0 tasks",
                infoFiltered: "(filtered from _MAX_ total tasks)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            drawCallback: function() {
                // Reinitialize tooltips after table redraw
                initTooltips();
            },
            initComplete: function () {
                var api = this.api();

                // Add filters to footer
                api.columns().every(function (index) {
                    var column = this;
                    var footer = $(column.footer());

                    // Skip checkbox and actions columns
                    if (index === 0 || index === 11) {
                        footer.html('');
                        return;
                    }

                    // Title column - text search
                    if (index === 1) {
                        footer.html('<input type="text" class="form-control form-control-sm" placeholder="Search title..." />');
                        $('input', footer).on('keyup change', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    }

                    // Description column - text search
                    else if (index === 2) {
                        footer.html('<input type="text" class="form-control form-control-sm" placeholder="Search description..." />');
                        $('input', footer).on('keyup change', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    }

                    // Category column - dropdown filter
                    else if (index === 3) {
                        var select = $('<select class="form-select form-select-sm"><option value="">All Categories</option></select>');
                        var categories = ['Work', 'Personal', 'Study', 'Health', 'Shopping'];
                        categories.forEach(function(cat) {
                            select.append('<option value="' + cat + '">' + cat + '</option>');
                        });
                        footer.html(select);
                        select.on('change', function () {
                            column.search(this.value).draw();
                        });
                    }

                    // Priority column - dropdown filter
                    else if (index === 4) {
                        var select = $('<select class="form-select form-select-sm"><option value="">All Priorities</option></select>');
                        var priorities = ['Low', 'Medium', 'High'];
                        priorities.forEach(function(pri) {
                            select.append('<option value="' + pri + '">' + pri + '</option>');
                        });
                        footer.html(select);
                        select.on('change', function () {
                            column.search(this.value).draw();
                        });
                    }

                    // Status column - dropdown filter
                    else if (index === 5) {
                        var select = $('<select class="form-select form-select-sm"><option value="">All Status</option></select>');
                        var statuses = ['Pending', 'In Progress', 'Completed', 'On Hold'];
                        statuses.forEach(function(status) {
                            select.append('<option value="' + status + '">' + status + '</option>');
                        });
                        footer.html(select);
                        select.on('change', function () {
                            column.search(this.value).draw();
                        });
                    }

                    // Deadline column - date picker
                    else if (index === 6) {
                        footer.html('<input type="text" class="form-control form-control-sm flatpickr-date" placeholder="Filter by date..." />');
                        var dateInput = $('.flatpickr-date', footer)[0];
                        if (dateInput && typeof flatpickr !== 'undefined') {
                            flatpickr(dateInput, {
                                dateFormat: "M d",
                                onChange: function(selectedDates, dateStr, instance) {
                                    column.search(dateStr).draw();
                                }
                            });
                        }
                    }

                    // Task Type column - dropdown filter
                    else if (index === 7) {
                        var select = $('<select class="form-select form-select-sm"><option value="">All Types</option></select>');
                        var types = ['Urgent', 'Important', 'Recurring'];
                        types.forEach(function(type) {
                            select.append('<option value="' + type + '">' + type + '</option>');
                        });
                        footer.html(select);
                        select.on('change', function () {
                            column.search(this.value).draw();
                        });
                    }

                    // Reminder column - dropdown filter
                    else if (index === 8) {
                        var select = $('<select class="form-select form-select-sm"><option value="">All Reminders</option></select>');
                        var reminders = ['None', '15 Minutes Before', '1 Hour Before', '1 Day Before'];
                        reminders.forEach(function(rem) {
                            select.append('<option value="' + rem + '">' + rem + '</option>');
                        });
                        footer.html(select);
                        select.on('change', function () {
                            column.search(this.value).draw();
                        });
                    }

                    // Tags column - text search
                    else if (index === 9) {
                        footer.html('<input type="text" class="form-control form-control-sm" placeholder="Search tags..." />');
                        $('input', footer).on('keyup change', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    }

                    // Assigned column
                    else if (index === 10) {
                        footer.html('');
                    }
                });
            }
        });

        // Select all checkbox
        $('#select-all').on('click', function() {
            var isChecked = $(this).prop('checked');
            $('.task-checkbox:visible').prop('checked', isChecked);
            updateSelectedTasks();
        });

        // Individual checkbox
        $(document).on('change', '.task-checkbox', function() {
            updateSelectedTasks();

            // Update select all checkbox
            var totalVisible = $('.task-checkbox:visible').length;
            var totalChecked = $('.task-checkbox:visible:checked').length;
            $('#select-all').prop('checked', totalVisible > 0 && totalVisible === totalChecked);
        });
    }

    // Update selected tasks array
    function updateSelectedTasks() {
        selectedTasks = [];
        $('.task-checkbox:checked').each(function() {
            selectedTasks.push($(this).val());
        });

        // Show/hide delete button
        if (selectedTasks.length > 0) {
            $('#delete-selected-btn').show();
        } else {
            $('#delete-selected-btn').hide();
        }
    }

    // Delete selected button
    $('#delete-selected-btn').on('click', function() {
        if (selectedTasks.length > 0) {
            $('#delete-count').text(selectedTasks.length);
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    });

    // Single task delete
    $(document).on('click', '.delete-task', function(e) {
        e.preventDefault();
        var taskId = $(this).data('task-id');
        selectedTasks = [taskId];
        $('#delete-count').text(1);
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    });

    // Confirm delete
    $('#confirm-delete-btn').on('click', function() {
        if (selectedTasks.length > 0) {
            // Send AJAX request to delete tasks
            $.ajax({
                url: '$bulkDeleteUrl',
                type: 'POST',
                data: {
                    ids: selectedTasks,
                    '$csrfParam': '$csrfToken'
                },
                success: function(response) {
                    // Close modal
                    var modalElement = document.getElementById('deleteModal');
                    var modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }

                    // Reload page
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('Error deleting tasks. Please try again.');
                }
            });
        }
    });
});
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
?>
