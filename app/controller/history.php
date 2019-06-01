<?php
namespace app\controller;

require_once 'controller.php';

require_once dirname ( __FILE__ ) . '/../model/result.php';

use app\model\result;
use GoogleTranslate\GoogleTranslate;

/**
 * index controller
 *
 * @author danishi
 */
class history extends controller
{
    private $name = 'history';

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $result = new result();

        return $this->view($this->name, [
            'title'        => '不自然な日本語ジェネレーター（変換履歴）',
            'history_list' => $result->getAll(),
        ]);
    }

    public function __toString():string {
        return $this->name;
    }
}
