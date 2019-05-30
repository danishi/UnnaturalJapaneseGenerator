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
class index extends controller
{
    private $name = 'index';

	/**
	 * @var string
	 */
	private $naturalJapanease;

	/**
	 * @var string
	 */
	private $unnaturalJapanease;

    public function __construct(){
        date_default_timezone_set('Asia/Tokyo');
    }

    public function index(){

        return $this->view($this->name, [
            'title'     => '不自然な日本語ジェネレーター',
            'post_text' => '',
            'ujg_text'  => '',
        ]);
    }

    public function post(){

        // convert
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $text = str_replace(')', '', str_replace('(', '', $text));

        $this->naturalJapanease = $text;

        $gt = new GoogleTranslate($text, 'ja', 'zh-CN');
        $textChinise = $gt->exec();

        $gt = new GoogleTranslate($text, 'zh-CN', 'ja');
        $unnaturalJapanease = $gt->exec();

        $this->unnaturalJapanease = mb_substr($unnaturalJapanease, 0, mb_strpos($unnaturalJapanease, '('));

        $this->logging('from:[' . $this->naturalJapanease . "]\tto:[" . $this->unnaturalJapanease .']');

        $result = new result();
        $result->insert([
            'before'  => $this->naturalJapanease,
            'after'   => $this->unnaturalJapanease,
            'date'    => date('Y-m-d H:i:s'),
        ]);

        return $this->view($this->name, [
            'title'     => '不自然な日本語ジェネレーター',
            'post_text' => $this->naturalJapanease,
            'ujg_text'  => $this->unnaturalJapanease,
        ]);
    }

    public function __toString():string {
        return $this->name;
    }
}
