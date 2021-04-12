<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
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

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($reservas, 'asiento')->dropdownList($vuelo->asientosLibres()) ?>

    <div class="form-group">
        <?= Html::submitButton('Reservar', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>