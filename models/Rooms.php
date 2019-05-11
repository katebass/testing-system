<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property int $user_id
 * @property int $questions_pack_id
 * @property string $name
 * @property string $start_datetime
 * @property string $end_datetime
 *
 * @property Results[] $results
 * @property QuestionsPacks $questionsPack
 * @property User $user
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'questions_pack_id', 'name', 'start_datetime'], 'required'],
            [['user_id', 'questions_pack_id'], 'integer'],
            [['start_datetime', 'end_datetime'], 'safe'],
            [['name'], 'string', 'max' => 256],
            [['questions_pack_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionsPacks::className(), 'targetAttribute' => ['questions_pack_id' => 'id']],
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
            'questions_pack_id' => 'Questions Pack ID',
            'name' => 'Name',
            'start_datetime' => 'Start Datetime',
            'end_datetime' => 'End Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsPack()
    {
        return $this->hasOne(QuestionsPacks::className(), ['id' => 'questions_pack_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
