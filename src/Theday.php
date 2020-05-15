<?php
/**
 * 当日日付.
 */

namespace Kanri;

class Theday extends Aday
{

    /**
     * yyyymm.
     *
     * @var string;
     */
    public $yyyymm;

    /**
     * yyyy年 mm月.
     *
     * @var string;
     */
    public $yyyymm_japanese;

    /**
     * yyyymmdd.
     *
     * @var string;
     */
    public $yyyymmdd;

    /**
     * yyyymm_1月進む.
     *
     * @var string
     */
    public $yyyymm_next_month;

    /**
     * yyyymmdd_1週進む.
     *
     * @var string
     */
    public $yyyymmdd_next_week;

    /**
     * yyyymmdd_1日進む.
     *
     * @var string
     */
    public $yyyymmdd_next_day;

    /**
     * yyyymm_1月戻る.
     *
     * @var string
     */
    public $yyyymm_back_month;

    /**
     * yyyymmdd_1週戻る.
     *
     * @var string
     */
    public $yyyymmdd_back_week;

    /**
     * yyyymmdd_1日戻る.
     *
     * @var string
     */
    public $yyyymmdd_back_day;

    /**
     * コンストラクタ.
     * 
     * @param \Carbon\Carbon $carbon
     */
    public function __construct($carbon = null)
    {
        if (is_null($carbon)) {
            $carbon = \Carbon\Carbon::today();
        }

        parent::__construct($carbon);

        $this->yyyymm = substr($this->yyyy_mm_dd, 0, 4) .
                substr($this->yyyy_mm_dd, 5, 2);

        $this->yyyymmdd = $this->yyyymm . substr($this->yyyy_mm_dd, 8, 2);

        $this->yyyymm_japanese = substr($this->yyyy_mm_dd, 0, 4) .
                '年 ' .
                substr($this->yyyy_mm_dd, 5, 2) . '月';

        $this->yyyymm_next_month = $this->_addMonth(1);

        $this->yyyymmdd_next_week = $this->_addDay(7);

        $this->yyyymmdd_next_day = $this->_addDay(1);

        $this->yyyymm_back_month = $this->_addMonth(-1);

        $this->yyyymmdd_back_week = $this->_addDay(-7);

        $this->yyyymmdd_back_day = $this->_addDay(-1);
    }

    /**
     * 日付移動した文字列.
     * 
     * @param int $days 移動させる日数
     * @return string
     */
    private function _addDay($days)
    {
        $date_string = $this->carbon->copy()
                ->addDay($days)
                ->toDateString();

        return str_replace('-', '', $date_string);
    }

    /**
     * 日付移動した文字列.
     * 
     * @param int $days 移動させる日数
     * @return string
     */
    private function _addMonth($days)
    {
        $date_string = $this->carbon
                ->copy()
                ->addMonthsNoOverflow($days)
                ->toDateString();

        return substr($date_string, 0, 4) . substr($date_string, 5, 2);
    }

}
