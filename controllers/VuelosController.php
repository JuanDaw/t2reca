<?php

namespace app\controllers;

use Yii;
use app\models\Vuelos;
use app\controllers\VuelosSearch;
use app\models\Reservas;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VuelosController implements the CRUD actions for Vuelos model.
 */
class VuelosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            // comprueba si al hacer delete se hace mediante post
            'access' => [
                'class' => AccessControl::class,
                'only' => ['reservar', 'anular'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['reservar', 'anular'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            // esto significa que solo va a poder entrar en reservar o anular cuando se este logueado
        ];
    }

    /**
     * Lists all Vuelos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VuelosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReservar($id)
    {
        $vuelo = $this->findModel($id);
        $reservas = new Reservas();
        $reservas->vuelo_id = $id;
        $reservas->usuario_id = Yii::$app->user->id;

        if ($reservas->load(Yii::$app->request->post()) && $reservas->save()) {
            return $this->redirect(['vuelos/index']);
        }

        return $this->render('reservar', [
            'vuelo' => $vuelo,
            'reservas' => $reservas,
        ]);
    }

    public function actionAnular($id)
    {
        $reserva = $this->findReserva($id);

        if(Yii::$app->request->isPost) {
            Reservas::findOne($id)->delete();
            return $this->redirect(['vuelos/index']);
        }

        return $this->render('anular', [
            'reserva' => $reserva,
        ]);
    }

    /**
     * Displays a single Vuelos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vuelos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vuelos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vuelos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vuelos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vuelos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vuelos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vuelos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findReserva($id)
    {
        if (($model = Reservas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
