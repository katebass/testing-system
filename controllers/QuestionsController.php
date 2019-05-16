<?php

namespace app\controllers;

use app\models\Answers;
use app\models\QuestionsTags;
use app\models\Tags;
use Yii;
use app\models\Questions;
use app\models\QuestionsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionsController implements the CRUD actions for Questions model.
 */
class QuestionsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['manager', 'admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Questions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Questions model.
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
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Questions();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->save();

            if (isset(Yii::$app->request->post('Questions')['questionsTags']['tag_id'])) {
                $newTags = Yii::$app->request->post('Questions')['questionsTags']['tag_id'];

                foreach ($newTags as $newTag) {
                    $newRecord = new QuestionsTags();
                    $newRecord->question_id = $model->id;
                    $newRecord->tag_id = $newTag;
                    $newRecord->save();
                }
            }

            $newAnswers = Yii::$app->request->post('Questions')['answers'];

            foreach ($newAnswers as $newAnswer) {
                $newRecord = new Answers();
                $newRecord->question_id = $model->id;
                $newRecord->answer = $newAnswer['answer'];
                $newRecord->is_correct = $newAnswer['is_correct'];
                $newRecord->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $oldTags = $model->questionsTags;

            if (isset(Yii::$app->request->post('Questions')['questionsTags']['tag_id'])) {
                $newTags = Yii::$app->request->post('Questions')['questionsTags']['tag_id'];

                //if old tag is not among new -> delete
                foreach ($oldTags as $oldTag) {
                    if (!in_array($oldTag->tag_id, $newTags) ) {
                        $oldTag->delete();
                    }
                }

                // if new tag is not among old -> create
                foreach ($newTags as $newTag) {
                    $oldTag = QuestionsTags::find()->where(['question_id' => $model->id, 'tag_id' => $newTag])->one();
                    if(!$oldTag) {
                        $newRecord = new QuestionsTags();
                        $newRecord->question_id = $model->id;
                        $newRecord->tag_id = $newTag;
                        $newRecord->save();
                    }
                }
            } else {
                foreach ($oldTags as $oldTag) {
                    $oldTag->delete();
                }
            }

            $oldAnswers = $model->answers;
            $newAnswers = Yii::$app->request->post('Questions')['answers'];
            $newAnswersValues = array_column($newAnswers, 'answer');

            //if old answer is not among new -> delete
            foreach ($oldAnswers as $oldAnswer) {
                if (!in_array($oldAnswer->answer, $newAnswersValues) ) {
                    $oldAnswer->delete();
                }
            }

            // if new answer is not among old -> create
            foreach ($newAnswers as $newAnswer) {
                $oldAnswer = Answers::find()->where(['question_id' => $model->id, 'answer' => $newAnswer['answer']])->one();
                if(!$oldAnswer) {
                    $newRecord = new Answers();
                    $newRecord->question_id = $model->id;
                    $newRecord->answer = $newAnswer['answer'];
                    $newRecord->is_correct = $newAnswer['is_correct'];
                    $newRecord->save();
                } else if ($oldAnswer->is_correct != $newAnswer['is_correct']) {
                    $oldAnswer->is_correct = $newAnswer['is_correct'];
                    $oldAnswer->save();
                }
            }


            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Questions model.
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
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
