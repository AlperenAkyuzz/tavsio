<?php namespace App\Tavsio;

/****
 * Class Tavsio
 * @package App\Tavsio
 */
class Tavsio
{
    const POST_ADVICE = 1;
    const POST_COMMENT = 2;

    const HOME_POSTS_TAKE = 20;

    const USER_FOLLOW_APPROVE_REQUIRED = false;


    static public function getRank($point): string
    {
        if($point < 100) $rank = "Yeni Üye";
        if($point > 100) $rank = "Üye";
        if($point > 150) $rank = "Azimli";
        if($point > 200) $rank = "Deneyimli";
        if($point > 300) $rank = "Uzman";

        return $rank;

    }
}
