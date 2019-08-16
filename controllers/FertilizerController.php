<?php

namespace app\controllers;

use kartik\grid\EditableColumnAction;
use Yii;
use app\models\AvailableFertilizer;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FertilizerController implements the CRUD actions for AvailableFertilizer model.
 */
class FertilizerController extends Controller
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
                    'edit-fertilizer' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionsOld()
    {
        return ArrayHelper::merge(parent::actions(), [
            'edit-fertilizer' => [                                       // identifier for your editable column action
                'class' => EditableColumnAction::class,     // action class name
                'modelClass' => AvailableFertilizer::class,                // the model for the record being edited
                'outputValue' => function ($model, $attribute, $key, $index) {
                    /* @var $model AvailableFertilizer */
                    return $model->price;      // return any custom output value if desired
                },
                'outputMessage' => function ($model, $attribute, $key, $index) {
                    return '';                                  // any custom error to return after model save
                },
                'showModelErrors' => true,                        // show model validation errors after save
                'errorOptions' => ['header' => ''],            // error summary HTML options
                // 'postOnly' => true,
                'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                // 'checkAccess' => function($action, $model) {}
            ]
        ]);
    }

    /**
     * @return false|string
     * @throws NotFoundHttpException
     */
    public function actionEditFertilizer()
    {
        $output = [
            'output' => '',
            'message' => 'Unable to save record'
        ];
        $hasEditable = Yii::$app->request->post('hasEditable', false);
        if ($hasEditable) {
            $pk = Yii::$app->request->post('editableKey', 0);
            $data = Yii::$app->request->post('AvailableFertilizer');
            $model = $this->findModel($pk);
            $model->load(['AvailableFertilizer' => $data[0]]); //use only the first value in the index array

            if ($model->validate()) {
                if ($model->save()) {
                    $output = [
                        'output' => '',
                        'message' => ''
                    ];
                }
            }
        }
        return Json::encode($output);
    }

    /**
     * Lists all AvailableFertilizer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AvailableFertilizer::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AvailableFertilizer model.
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
     * Creates a new AvailableFertilizer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AvailableFertilizer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AvailableFertilizer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            echo '<pre>';
            echo Json::encode(Yii::$app->request->post('AvailableFertilizer'));
            return 8;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AvailableFertilizer model.
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
     * Finds the AvailableFertilizer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AvailableFertilizer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AvailableFertilizer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
