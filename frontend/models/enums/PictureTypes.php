<?php

namespace app\models\enums;

class PictureTypes {
    const PROFILE_PICURE = 1;
    const BACKGROUND_PICTURE = 2;
    const GALLERY_PICTURE = 3;

    public static $constants = [
        'Profile Picture' => self::PROFILE_PICURE,
        'Backgroud Picture' => self::BACKGROUND_PICTURE,
        'Gallery Image' => self::GALLERY_PICTURE
    ];

}