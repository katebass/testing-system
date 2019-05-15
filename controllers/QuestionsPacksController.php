<?php

namespace app\controllers;

use app\models\QuestionsPacksQuestions;
use app\models\QuestionsTags;
use Yii;
use app\models\QuestionsPacks;
use app\models\QuestionsPacksSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionsPacksController implements the CRUD actions for QuestionsPacks model.
 */
class QuestionsPacksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['manager'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all QuestionsPacks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionsPacksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestionsPacks model.
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
     * Creates a new QuestionsPacks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuestionsPacks();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->save();

            if (isset(Yii::$app->request->post('QuestionsPacks')['questionsPacksQuestions']['question_id'])) {
                $newQuestions = Yii::$app->request->post('QuestionsPacks')['questionsPacksQuestions']['question_id'];

                foreach ($newQuestions as $newQuestion) {
                    $newRecord = new QuestionsPacksQuestions();
                    $newRecord->questions_pack_id = $model->id;
                    $newRecord->question_id = $newQuestion;
                    $newRecord->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing QuestionsPacks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $oldQuestions = $model->questionsPacksQuestions;
            if (isset(Yii::$app->request->post('QuestionsPacks')['questionsPacksQuestions']['question_id'])) {
                $newQuestions = Yii::$app->request->post('QuestionsPacks')['questionsPacksQuestions']['question_id'];

                //if old question is not among new -> delete
                foreach ($oldQuestions as $oldQuestion) {
                    if (!in_array($oldQuestion->question_id, $newQuestions) ) {
                        $oldQuestion->delete();
                    }
                }

                // if new question is not amont old -> create
                foreach ($newQuestions as $newQuestion) {
                    $oldQuestion = QuestionsPacksQuestions::find()->where(['questions_pack_id' => $model->id, 'question_id' => $newQuestion])->one();
                    if(!$oldQuestion) {
                        $newRecord = new QuestionsPacksQuestions();
                        $newRecord->questions_pack_id = $model->id;
                        $newRecord->question_id = $newQuestion;
                        $newRecord->save();
                    }
                }
            } else {
                foreach ($oldQuestions as $newQuestion) {
                    $newQuestion->delete();
                }
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing QuestionsPacks model.
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
     * Finds the QuestionsPacks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionsPacks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionsPacks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
