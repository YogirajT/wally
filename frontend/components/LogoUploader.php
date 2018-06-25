<?php

namespace app\components;

use app\models\enums\PictureTypes;
use frontend\models\enums\UserTypes;
use Yii;
use yii\base\Component;
use \common\models\Pictures;
use yii\web\UploadedFile;
use app\models\enums\DirectoryTypes;

class LogoUploader extends Component
{
    public static function LogoUpload(UploadedFile $upFile,$image)
    {
        $media_model = new Pictures();
        $media_model->alt = $upFile->name;
        $itemName = md5(uniqid()) . '.' . $upFile->getExtension();  // unique_name+extension
        $media_model->file_name = $itemName;
        $media_model->file_size = $upFile->size;
        $media_model->file_type = $upFile->type;
        $media_model->media_type = $image;
        $media_model->save();
            
        if($image == PictureTypes::PROFILE_PICURE) {
            $upFile->saveAs(DirectoryTypes::getUserDirectory() . $itemName);
        }
        return $media_model->id;
        
	}
}
 