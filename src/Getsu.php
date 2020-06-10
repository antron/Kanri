<?php

/**
 * 日付配列.
 */

namespace Antron\Kanri;

class Getsu
{

    /**
     * 当日.
     *
     * @var \Mido\Theday
     */
    public $theday;

    /**
     * Carbon_月初.
     *
     * @var Carbon\Carbon;
     */
    private $carbon_first;

    /**
     * Carbon_月末.
     *
     * @var Carbon\Carbon;
     */
    public $carbon_last;

    /**
     * Between句.
     *
     * @var array
     */
    public $between;

    /**
     * コンストラクタ.
     * 
     * @param string $ymd yyyymm or yyyymmdd 基準日
     */
    public function __construct($ymd = '')
    {
        if (!$ymd) {
            $ymd = date("Ymd");
        }

        $yyyy_mm_dd = substr($ymd, 0, 4) . '-' . substr($ymd, 4, 2);

        if (strlen($ymd) == 8) {
            $yyyy_mm_dd .= '-' . substr($ymd, 6, 2);
        } else {
            $yyyy_mm_dd .= '-01';
        }

        $carbon = new \Carbon\Carbon($yyyy_mm_dd);

        $this->theday = new Theday($carbon);

        $this->carbon_first = $carbon->copy()->firstOfMonth();

        $this->carbon_last = $carbon->copy()->endOfMonth();

        $this->between = [];
    }

    /**
     * 月単位.
     */
    public function setMonth()
    {
        $this->between = [
            $this->theday->yyyy_mm_dd,
            $this->carbon_last->toDateString()
        ];

        $this->_makeDates($this->carbon_first, $this->carbon_last->day);
    }

    /**
     * 週単位.
     */
    public function setWeek()
    {
        $this->between = [
            $this->theday->yyyy_mm_dd,
            $this->theday->carbon->copy()->addDay(6)->toDateString()
        ];

        $this->_makeDates($this->theday->carbon, 7);
    }

    /**
     * 日付配列を取得.
     * 
     * @return array 日付配列
     */
    private function _makeDates($carbon, $max)
    {
        $this->dates = [];

        for ($i = 0; $i < $max; $i++) {
            $carbon_i = $carbon->copy()->addDay($i);

            $this->dates[$carbon_i->toDateString()] = new Aday($carbon_i);
        }
    }

}
