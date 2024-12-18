<?php

namespace Labs\Lab4\Controller;

class PictureController
{
    public static function getPicturePath($picture)
    {
        return 'resources/' . $picture;
    }
}