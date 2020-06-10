<?php

/**
 * ライブラリ：削除モーダル.
 */

namespace Antron\Kanri;

/**
 * ライブラリ：削除モーダル.
 */
class DeleteHelper
{

    /**
     * 削除が可能かフラグ.
     *
     * @var boolean
     */
    public $error;

    /**
     * 削除メッセージを表示するPタグ.
     *
     * @var string
     */
    public $parag;

    /**
     * 削除のルーティング.
     *
     * @var string
     */
    public $route;

    /**
     * 削除対象の表示名.
     *
     * @var string
     */
    public $title;

    /**
     * 削除のモデル.
     *
     * @var string
     */
    protected $type;

    /**
     * モデル.
     *
     * @var var
     */
    private $model;

    /**
     * コンストラクタ.
     * 
     * @param Model $model モデル
     */
    public function __construct($model)
    {
        $this->type = $model->getTable();

        $this->model = $model;

        $this->error = false;

        $this->title = '';

        $this->parag = '';

        $this->route = [substr($this->type, 0, -1) . '.destroy', $model->id];
    }

}
