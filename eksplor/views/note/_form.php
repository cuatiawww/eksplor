<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Note $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>
          <i class="ph-duotone ph-<?= $model->isNewRecord ? 'note-pencil' : 'pencil' ?> me-2"></i>
          <?= $model->isNewRecord ? "Write Today's Note" : 'Edit Note' ?>
        </h5>
      </div>
      <div class="card-body">
        
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'note-form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
            ],
        ]); ?>

        <!-- Note Title -->
        <?= $form->field($model, 'title')->textInput([
            'maxlength' => true,
            'placeholder' => 'Judul catatan hari ini...'
        ])->hint('Optional') ?>

        <!-- Row: Date & Mood -->
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'note_date')->input('date', ['class' => 'form-control']) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'mood')->dropDownList([
                    'very-happy' => '😄 Sangat Senang',
                    'happy' => '😊 Senang',
                    'neutral' => '😐 Biasa Aja',
                    'sad' => '😢 Sedih',
                    'stressed' => '😫 Stress',
                    'excited' => '🤩 Excited',
                    'tired' => '😴 Capek',
                ], [
                    'prompt' => 'Pilih mood...',
                    'class' => 'form-select'
                ])->label('Mood Hari Ini') ?>
            </div>
        </div>

        <!-- Note Content -->
        <?= $form->field($model, 'content')->textarea([
            'rows' => 10,
            'placeholder' => "Tulis cerita, refleksi, atau hal menarik yang terjadi hari ini...\n\nContoh:\n- Apa yang membuatmu bahagia hari ini?\n- Apa yang kamu pelajari?\n- Ada tantangan apa yang kamu hadapi?\n- Apa yang ingin kamu capai besok?"
        ])->label('Cerita Hari Ini <span class="text-danger">*</span>') ?>

        <!-- Tags -->
        <?= $form->field($model, 'tags')->textInput([
            'maxlength' => true,
            'placeholder' => 'diary, reflection, idea, goals, grateful'
        ])->hint('Pisahkan dengan koma. Contoh: diary, pekerjaan, keluarga, belajar') ?>

        <!-- Buttons -->
        <div class="d-flex justify-content-end gap-2">
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-light']) ?>
            <?= Html::resetButton('Clear', ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(
                '<i class="ph-duotone ph-floppy-disk me-1"></i>' . ($model->isNewRecord ? 'Save Note' : 'Update Note'), 
                ['class' => 'btn btn-primary']
            ) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>
    </div>
  </div>
</div>