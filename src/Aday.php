<?php
/**
 * 「一日」を表現するクラス.
 */

namespace Kanri;

use Carbon\Carbon;

class Aday
{

    /**
     * Carbon.
     *
     * @var Carbon\Carbon;
     */
    public $carbon;

    /**
     * スタイルシートのクラス.
     *
     * @var string
     */
    public $class;

    /**
     * yyyy年 mm月dd日（曜日）祝日.
     *
     * @var string;
     */
    public $japanese;

    /**
     * yyyy-mm-dd.
     *
     * @var string;
     */
    public $yyyy_mm_dd;

    /**
     * スタイルシートのclass配列.
     *
     * @var array
     */
    private static $classes = [
        0 => 'cal_holiday',
        1 => 'cal_weekday',
        2 => 'cal_weekday',
        3 => 'cal_weekday',
        4 => 'cal_weekday',
        5 => 'cal_weekday',
        6 => 'cal_saturday',
    ];

    /**
     * コンストラクタ.
     * 
     * @param \Carbon\Carbon $carbon
     */
    public function __construct($carbon)
    {
        $this->carbon = $carbon;

        $this->yyyy_mm_dd = $carbon->toDateString();

        $this->japanese = self::getJapaneseDate($carbon);

        $this->class = self::$classes[$carbon->dayOfWeek];

        if (isset(config('holidays')[$this->yyyy_mm_dd])) {
            $this->class = 'cal_holiday';

            $this->japanese .= config('holidays')[$this->yyyy_mm_dd];
        }
    }

    /**
     * yyyy-mm-ddを日本語表記に変換.
     * 
     * @param string $string
     * @return string
     */
    public static function toJapaneseDate($string)
    {
        if (!$string) {
            return '';
        }

        return self::getJapaneseDate(new \Carbon\Carbon($string));
    }

    /**
     * Carbon日付を日本語表記に変換.
     * 
     * @param \Carbon\Carbon $carbon
     * @return string
     */
    private static function getJapaneseDate($carbon)
    {
        $weekday = ['日', '月', '火', '水', '木', '金', '土'];

        $date_string = $carbon->toDateString();

        $data = [
            substr($date_string, 0, 4),
            '年 ',
            substr($date_string, 5, 2),
            '月',
            substr($date_string, 8, 2),
            '日（',
            $weekday[$carbon->dayOfWeek],
            '）',
        ];

        return implode('', $data);
    }

}
