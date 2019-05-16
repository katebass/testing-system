<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property int $questions_pack_id
 * @property string $name
 * @property string $start_datetime
 * @property string $end_datetime
 * @property string $state
 * @property double $points
 *
 * @property QuestionsPacks $questionsPack
 * @property RoomsCandidates[] $roomsCandidates
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
            [['questions_pack_id', 'name'], 'required'],
            [['questions_pack_id'], 'integer'],
            [['start_datetime', 'end_datetime'], 'safe'],
            [['points'], 'number'],
            [['name'], 'string', 'max' => 256],
            [['state'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'start_datetime' => 'Start Datetime',
            'end_datetime' => 'End Datetime',
            'state' => 'State',
            'points' => 'Points',
        ];
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
    public function getRoomsCandidates()
    {
        return $this->hasMany(RoomsCandidates::className(), ['room_id' => 'id']);
    }
}
