<?php 
namespace app\models\enums;

use Yii;
use yii\helpers\Url;

class DirectoryTypes {

    const UPLOADS = 0;

    public static $folderName = [
        self::UPLOADS => 'uploads'
    ];

    public static function getUserDirectory()
    {
        return Url::to(\Yii::getAlias('@web') . DIRECTORY_SEPARATOR. 'uploads' .DIRECTORY_SEPARATOR. 'user' . DIRECTORY_SEPARATOR) ;
    }

    public static function getGalleryDirectory()
    {
        return Url::to(\Yii::getAlias('@web') . DIRECTORY_SEPARATOR. 'uploads' .DIRECTORY_SEPARATOR. 'gallery' . DIRECTORY_SEPARATOR) ;
    }

}

?>