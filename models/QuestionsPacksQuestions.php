<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions_packs_questions".
 *
 * @property int $id
 * @property int $questions_pack_id
 * @property int $question_id
 *
 * @property Questions $question
 * @property QuestionsPacks $questionsPack
 */
class QuestionsPacksQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions_packs_questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['questions_pack_id', 'question_id'], 'required'],
            [['questions_pack_id', 'question_id'], 'integer'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['questions_pack_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionsPacks::className(), 'targetAttribute' => ['questions_pack_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'questions_pack_id' => 'Questions Pack ID',
            'question_id' => 'Question ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsPack()
    {
        return $this->hasOne(QuestionsPacks::className(), ['id' => 'questions_pack_id']);
    }
}
