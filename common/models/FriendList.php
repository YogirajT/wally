<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use \yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "friend_list".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $friend_id
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $confirmation
 *
 * @property User $friends[]
 * @property User $users[]
 */
class FriendList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friend_list';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['friend_id', 'updated_at', 'created_at'], 'integer'],
            [['friend_id'], 'required'],
            [['friend_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['friend_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['confirmation','user_id'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'friend_id' => 'Friend ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'confirmation' => 'Confirmation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriends()
    {
        return $this->hasMany(User::className(), ['friend_id'=>'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_id'=>'id']);
    }

    public static function getUserFriends()
    {
        $data1 = static::find()->where(['confirmation'=>10])->andWhere(['user_id'=>\Yii::$app->user->id])->all();

        $data2 = static::find()->where(['confirmation'=>10])->andWhere(['friend_id'=>\Yii::$app->user->id])->all();
        
        $value1=(count($data1)==0)? []: ArrayHelper::getColumn($data1, 'friend_id');
        
        $value2=(count($data2)==0)? []: ArrayHelper::getColumn($data2, 'user_id');
        
        $value = ArrayHelper::merge($value1,$value2);

        $list = UserProfile::find()->joinWith('profilePic')->joinWith('user')->where(['user_id'=>$value])->all();

        return [$list,$value];
    }

    public static function preinvites($id)
    {
        $data1 = static::find()->where(['user_id'=>\Yii::$app->user->id])->andWhere(['friend_id'=>$id])->all();

        $data2 = static::find()->where(['friend_id'=>\Yii::$app->user->id])->andWhere(['user_id'=>$id])->all();

        $value1=(count($data1)==0)? []: ArrayHelper::getColumn($data1, 'confirmation');
        
        $value2=(count($data2)==0)? []: ArrayHelper::getColumn($data2, 'confirmation');

        $value = ArrayHelper::merge($value1,$value2);

        return $value;

    }

}
