<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5><i class="ph-duotone ph-<?= $model->isNewRecord ? 'plus-circle' : 'pencil' ?> me-2"></i><?= $model->isNewRecord ? 'Task Information' : 'Edit Task' ?></h5>
      </div>
      <div class="card-body">
        
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'task-form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
            ],
        ]); ?>

        <!-- Task Title -->
        <?= $form->field($model, 'title')->textInput([
            'maxlength' => true,
            'placeholder' => 'What needs to be done?'
        ])->label('Task Title <span class="text-danger">*</span>') ?>

        <!-- Task Description -->
        <?= $form->field($model, 'description')->textarea([
            'rows' => 4,
            'placeholder' => 'Add more details about this task...'
        ]) ?>

        <!-- Row: Priority & Status -->
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'priority')->dropDownList([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ], [
                    'prompt' => 'Select priority...',
                    'class' => 'form-select'
                ])->label('Priority <span class="text-danger">*</span>') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropDownList([
                    'pending' => 'Pending',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                ], ['class' => 'form-select']) ?>
            </div>
        </div>

        <!-- Row: Deadline & Category -->
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'deadline')->input('date', ['class' => 'form-control']) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'category')->dropDownList([
                    'work' => 'Work',
                    'personal' => 'Personal',
                    'study' => 'Study',
                    'shopping' => 'Shopping',
                    'health' => 'Health',
                    'others' => 'Others',
                ], [
                    'prompt' => 'Select category...',
                    'class' => 'form-select'
                ]) ?>
            </div>
        </div>

        <!-- Task Type (Checkboxes) -->
        <div class="mb-3">
            <label class="form-label">Task Type</label>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'is_urgent')->checkbox([
                        'class' => 'form-check-input',
                        'label' => 'Urgent',
                        'template' => '<div class="form-check">{input}{label}</div>',
                        'labelOptions' => ['class' => 'form-check-label'],
                    ])->label(false) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'is_important')->checkbox([
                        'class' => 'form-check-input',
                        'label' => 'Important',
                        'template' => '<div class="form-check">{input}{label}</div>',
                        'labelOptions' => ['class' => 'form-check-label'],
                    ])->label(false) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'is_recurring')->checkbox([
                        'class' => 'form-check-input',
                        'label' => 'Recurring',
                        'template' => '<div class="form-check">{input}{label}</div>',
                        'labelOptions' => ['class' => 'form-check-label'],
                    ])->label(false) ?>
                </div>
            </div>
        </div>

        <!-- Reminder (Radio) -->
        <div class="mb-3">
            <label class="form-label">Reminder</label>
            <?= $form->field($model, 'reminder')->radioList([
                'none' => 'No Reminder',
                '1day' => '1 Day Before',
                '1hour' => '1 Hour Before',
            ], [
                'item' => function($index, $label, $name, $checked, $value) {
                    return '<div class="form-check form-check-inline">' .
                           Html::radio($name, $checked, ['value' => $value, 'class' => 'form-check-input', 'id' => 'reminder-' . $value]) .
                           Html::label($label, 'reminder-' . $value, ['class' => 'form-check-label']) .
                           '</div>';
                }
            ])->label(false) ?>
        </div>

        <!-- Tags -->
        <?= $form->field($model, 'tags')->textInput([
            'maxlength' => true,
            'placeholder' => 'e.g. urgent, meeting, review'
        ])->hint('Comma separated') ?>

        <!-- Assigned To (Switch) -->
        <div class="mb-3">
            <?= $form->field($model, 'assigned_to_me')->checkbox([
                'class' => 'form-check-input',
                'label' => 'Assign to me',
                'template' => '<div class="form-check form-switch">{input}{label}</div>',
                'labelOptions' => ['class' => 'form-check-label'],
            ])->label(false) ?>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end gap-2">
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-light']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton('<i class="ph-duotone ph-' . ($model->isNewRecord ? 'plus' : 'check') . ' me-1"></i>' . ($model->isNewRecord ? 'Add Task' : 'Update Task'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>
    </div>
  </div>
</div>