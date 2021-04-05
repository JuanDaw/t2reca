<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vuelos */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="vuelos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'origen_id')->textInput() ?>

    <?= $form->field($model, 'destino_id')->textInput() ?>

    <?= $form->field($model, 'salida')->textInput() ?>

    <?= $form->field($model, 'llegada')->textInput() ?>

    <?= $form->field($model, 'plazas')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
