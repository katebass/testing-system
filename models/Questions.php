<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $question
 *
 * @property Answers[] $answers
 * @property User $user
 * @property QuestionsPacksQuestions[] $questionsPacksQuestions
 * @property QuestionsTags[] $questionsTags
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'points'], 'integer'],
            [['name', 'question'], 'required'],
            [['question'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'question' => 'Question',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsPacksQuestions()
    {
        return $this->hasMany(QuestionsPacksQuestions::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsTags()
    {
        return $this->hasMany(QuestionsTags::className(), ['question_id' => 'id']);
    }

    public function getTags() {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])
            ->viaTable('questions_tags', ['question_id' => 'id']);
    }

    public function getQuestionPacks() {
        return $this->hasMany(QuestionsPacks::className(), ['id' => 'question_pack_id'])
            ->viaTable('questions_packs_questions', ['question_id' => 'id']);
    }
}
