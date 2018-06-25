<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $profile_pic
 * @property string $personal_details
 * @property string $interests
 * @property integer $gallery
 * @property string $contact
 *
 * @property User $user
 * @property Pictures $profilePic
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'profile_pic', 'gallery'], 'integer'],
            [['personal_details', 'interests'], 'string'],
            [['contact'], 'string', 'max' => 11],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['profile_pic'], 'exist', 'skipOnError' => true, 'targetClass' => Pictures::className(), 'targetAttribute' => ['profile_pic' => 'id']],
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
            'profile_pic' => 'Profile Pic',
            'personal_details' => 'Personal Details',
            'interests' => 'Interests',
            'gallery' => 'Gallery',
            'contact' => 'Contact',
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
    public function getProfilePic()
    {
        return $this->hasOne(Pictures::className(), ['id' => 'profile_pic']);
    }
}
