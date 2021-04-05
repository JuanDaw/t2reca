<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use Yii;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\VuelosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vuelos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vuelos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vuelos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'origen.denominacion',
                // 'format' => 'text', se puede omitir porque es por defecto
                'label' => 'Origen',
            ],
            'destino.denominacion:text:Destino',
            'salida::datetime',
            'llegada::datetime',
            'plazas',
            'precio::currency',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{reservar} {anular}',
                'buttons' => 
                [
                    'reservar' => function ($url, $model, $key) {
                        if (Yii::$app->user->isGuest) {
                            // se pinta
                        } else {
                            // if(no tiene reservas) {
                                // se pinta
                            //}
                        }
                    },
                    'anular' => function ($url, $model, $key) {
                        // return the button HTML code
                    },
                ],
            ],
        ],
    ]); ?>


</div>
