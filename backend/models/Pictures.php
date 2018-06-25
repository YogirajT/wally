<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pictures".
 *
 * @property integer $id
 * @property string $alt
 * @property integer $media_type
 * @property string $file_name
 * @property string $file_type
 * @property integer $file_size
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property UserProfile[] $userProfiles
 */
class Pictures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pictures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_type', 'file_size', 'created_at', 'updated_at'], 'integer'],
            [['alt', 'file_name', 'file_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alt' => 'Alt',
            'media_type' => 'Media Type',
            'file_name' => 'File Name',
            'file_type' => 'File Type',
            'file_size' => 'File Size',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['profile_pic' => 'id']);
    }
}
