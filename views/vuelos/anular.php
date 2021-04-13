<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

$this->title = 'Anular';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $reserva,
    'attributes' => [
        'vuelo.origen.denominacion:text:Origen',
        'vuelo.destino.denominacion:text:Destino',
        'vuelo.salida::datetime',
        'vuelo.llegada::datetime',
        'vuelo.precio::currency',
        'asiento',
        'usuario.nombre:text:Usuario que reservó',
    ],
]) ?>

<?php
/*
<?= Html::beginForm() ?>
    <?= Html::submitButton('Confirmar anulación', [
        'class' => 'btn btn-danger'
    ]) ?>
<?= Html::endForm() ?>

<?= Html::submitButton('Cancelar', [
        'class' => 'btn btn-info'
]) ?>
*/?>

<?= Html::a('Confirmar anulación', '', [
        'class' => 'btn btn-danger',
        'data-method' => 'post',
]) ?>

<?= Html::a('Cancelar', '', [
        'class' => 'btn btn-warning',
]) ?>