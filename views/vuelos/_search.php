<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\VuelosSearch */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="vuelos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'origen_id') ?>

    <?= $form->field($model, 'destino_id') ?>

    <?= $form->field($model, 'salida') ?>

    <?= $form->field($model, 'llegada') ?>

    <?php // echo $form->field($model, 'plazas') ?>

    <?php // echo $form->field($model, 'precio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
