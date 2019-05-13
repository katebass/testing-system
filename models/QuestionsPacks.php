<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions_packs".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 *
 * @property User $user
 * @property QuestionsPacksQuestions[] $questionsPacksQuestions
 * @property Rooms[] $rooms
 */
class QuestionsPacks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions_packs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 191],
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
            'description' => 'Description',
        ];
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
        return $this->hasMany(QuestionsPacksQuestions::className(), ['questions_pack_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['questions_pack_id' => 'id']);
    }

    public function getQuestions() {
        return $this->hasMany(Questions::className(), ['id' => 'question_id'])
            ->viaTable('questions_packs_questions', ['question_pack_id' => 'id']);
    }
}
