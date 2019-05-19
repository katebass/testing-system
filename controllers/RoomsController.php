<?php

namespace app\controllers;

use app\models\Answers;
use app\models\CandidatesAnswers;
use app\models\Questions;
use app\models\RoomsCandidates;
use Yii;
use app\models\Rooms;
use app\models\RoomsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class RoomsController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'testing'],
                        'allow' => true,
                        'roles' => ['manager', 'admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Rooms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rooms model.
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
     * Creates a new Rooms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rooms();

        if ($model->load(Yii::$app->request->post())) {

            $model->save();

            $newCandidates = Yii::$app->request->post('Rooms')['roomsCandidates']['candidate_id'];

            foreach ($newCandidates as $newCandidate) {
                $newRecord = new RoomsCandidates();
                $newRecord->room_id = $model->id;
                $newRecord->candidate_id = $newCandidate;
                $newRecord->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }



        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rooms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {

            $questions = $model->questionsPack->questions;
            $points = 0;
            foreach ($questions as $question) {
                $points += $question->points;
            }

            $model->points = $points;

            if (isset(Yii::$app->request->post()['Rooms']['start_datetime'])) {
                $start_datetime = Yii::$app->request->post()['Rooms']['start_datetime'];
                $start_datetime = date("Y-m-d H:m:s", strtotime($start_datetime));
                $model->start_datetime = $start_datetime;
            }
            if (isset(Yii::$app->request->post()['Rooms']['end_datetime'])) {
                $end_datetime = Yii::$app->request->post()['Rooms']['end_datetime'];
                $end_datetime = date("Y-m-d H:m:s", strtotime($end_datetime));
                $model->end_datetime = $end_datetime;
            }

            $oldCandidates = $model->roomsCandidates;
            $newCandidates = Yii::$app->request->post('Rooms')['roomsCandidates']['candidate_id'];

            //if old tag is not among new -> delete
            foreach ($oldCandidates as $oldCandidate) {
                if (!in_array($oldCandidate->candidate_id, $newCandidates) ) {
                    $oldCandidate->delete();
                }
            }

            // if new tag is not among old -> create
            foreach ($newCandidates as $newCandidate) {
                $oldCandidate = RoomsCandidates::find()
                                         ->where(['room_id' => $model->id, 'candidate_id' => $newCandidate])->one();
                if(!$oldCandidate) {
                    $newRecord = new RoomsCandidates();
                    $newRecord->room_id = $model->id;
                    $newRecord->candidate_id = $newCandidate;
                    $newRecord->save();
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
     * Deletes an existing Rooms model.
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

    public function actionTesting($id)
    {
        $model = $this->findModel($id);
        $questions = $model->questions;
        $currentQuestion = false;
        //$currentQuestion = $questions[0];

        if (Yii::$app->request->post()) {
            // get candidate answer
            $CandidateAnswerId = 0;
            foreach($_POST as $key => $value) {
                if (strpos($key, 'answer_') === 0) {
                    $CandidateAnswerId = $value;
                }
            }

            // create record about candidate's answer
            $candidateAnswers = new CandidatesAnswers([
                'user_id' => Yii::$app->user->getId(),
                'question_id' => Yii::$app->request->post('questionId'),
                'room_id' => $id,
                'answer_id' => $CandidateAnswerId
            ]);
            $candidateAnswers->save();

            // get question to compare answers
            $question = Questions::findOne(Yii::$app->request->post('questionId'));
            $allAnswers = $question->answers;

            // find the question among the whole list to assign next
            for ($i = 0; $i < sizeof($questions); $i++) {
                if ($questions[$i]->id == $question->id) {
                    foreach ($allAnswers as $answer) {
                        if ($answer->id == $CandidateAnswerId) {
                            // save the overall result
                            $result = RoomsCandidates::find()
                                        ->where([
                                            'candidate_id' => Yii::$app->user->getId(),
                                            'room_id' => $id])
                                        ->one();
                            if(!$result) {
                                $result = new RoomsCandidates([
                                    'room_id' => $id,
                                    'candidate_id' => Yii::$app->user->getId(),
                                    'points' => 0
                                ]);
                            }
                            if ($answer->is_correct) {
                                $result->points += $questions[$i]->points;
                            }
                            $result->save();
                            break;
                        }
                    }
                    $currentQuestion = isset($questions[$i+1]) ? $questions[$i+1] : false;
                    break;
                }
            }

        } else {
            $currentCandidateQuestion = $model->getCurrentCandidateQuestion();

            if ($currentCandidateQuestion) {
                for ($i = 0; $i < sizeof($questions); $i++) {
                    if ($questions[$i]->id == $currentCandidateQuestion->question_id) {
                        $currentQuestion = isset($questions[$i + 1]) ? $questions[$i + 1] : false;
                    }
                }
            } else {
                $currentQuestion = $questions[0];
            }
        }

        if (!$currentQuestion) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }

        return $this->render('testing', [
            'model' => $model,
            'currentQuestion' => $currentQuestion,
        ]);
    }

    /**
     * Finds the Rooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rooms::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
