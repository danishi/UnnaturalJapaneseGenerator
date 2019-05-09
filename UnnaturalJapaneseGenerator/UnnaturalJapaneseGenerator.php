<?php
namespace UnnaturalJapaneseGenerator;

require_once dirname ( __FILE__ ) . '/../vendor/autoload.php';

use GoogleTranslate\GoogleTranslate;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * @author danishi
 * @license MIT
 * @version 0.0.1
 */
final class UnnaturalJapaneseGenerator
{

    const VERSION = "0.0.1";

	/**
	 * @var string
	 */
	public $naturalJapanease;

	/**
	 * @var string
	 */
	public $unnaturalJapanease;

	/**
	 * Constructor.
	 *
	 * @param string $text
	 */
	public function __construct(string $text)
	{
        if(empty($text)){
            return;
        }

        // convert
        $this->naturalJapanease = $text;

        $gt = new GoogleTranslate($text, 'ja', 'zh-CN');
        $textChinise = $gt->exec();

        $gt = new GoogleTranslate($text, 'zh-CN', 'ja');
        $unnaturalJapanease = $gt->exec();

        $this->unnaturalJapanease = mb_substr($unnaturalJapanease, 0, mb_strpos($unnaturalJapanease, '('));

        // logging
        $logger = new Logger('logger');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/' . 'UnnaturalJapaneseGenerator.log', Logger::INFO));
        $logger->addInfo('from:[' . $this->naturalJapanease . "]\tto:[" . $this->unnaturalJapanease .']');
    }

    public function __toString() {
        return $this->unnaturalJapanease;
    }
}
