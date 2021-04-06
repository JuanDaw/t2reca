<?php

use yii\bootstrap4\ActiveForm;
use yii\widgets\DetailView;

$this->title = 'Reservar';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $vuelo,
    'attributes' => [
        'origen.denominacion:text:Origen',
        'destino.denominacion:text:Destino',
        'salida::datetime',
        'llegada::datetime',
        'plazas',
        'precio::currency',
        'plazasLibres',
    ],
]) ?>

<?= ActiveForm::begin() ?>
    <?= $form->field($reservasForm, 'asiento')->dropdownList() ?>