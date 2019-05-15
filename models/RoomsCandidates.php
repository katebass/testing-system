<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms_candidates".
 *
 * @property int $id
 * @property int $room_id
 * @property int $candidate_id
 * @property double $points
 * @property string $conclusion
 *
 * @property Rooms $room
 * @property User $candidate
 */
class RoomsCandidates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms_candidates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'candidate_id'], 'required'],
            [['room_id', 'candidate_id'], 'integer'],
            [['points'], 'number'],
            [['conclusion'], 'string'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
            [['candidate_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['candidate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room ID',
            'candidate_id' => 'Candidate ID',
            'points' => 'Points',
            'conclusion' => 'Conclusion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidate()
    {
        return $this->hasOne(User::className(), ['id' => 'candidate_id']);
    }
}
