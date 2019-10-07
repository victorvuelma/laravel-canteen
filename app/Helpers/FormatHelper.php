<?php

namespace App\Helpers;

use Symfony\Component\Console\Helper\Helper;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class FormatHelper extends Helper {

    private static $dateFormat = 'd/m/Y h:i:s';
    private static $moneyFormat = '%.2n';

    public static function formatMoney($money){
        return money_format(self::$moneyFormat, $money);
    }

    public static function formatDate($date){
        return Carbon::parse($date)->format(self::$dateFormat);
    }

    public function getName(){
        return 'Format';
    }

}
