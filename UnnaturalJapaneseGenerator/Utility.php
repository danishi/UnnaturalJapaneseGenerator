<?php
namespace UnnaturalJapaneseGenerator;

require_once dirname ( __FILE__ ) . '/../vendor/autoload.php';

/**
 * @author danishi
 * @license MIT
 * @version 0.0.1
 */
final class Utility{

	/**
	 * Constructor.
	 */
    protected function __construct(){

    }

    /**20190523 153159
     * usage <link rel="stylesheet" href="css/style.css?<?=Utility::cssUnCache()?>">
     * @param  bool
     * @return string
     */
    public static function cssUnCache(bool $localhostOnly=true): string
    {
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );

        if(in_array($_SERVER['REMOTE_ADDR'], $whitelist) && $localhostOnly){
            return '?'.date('YmdHis');
        }else{
            return '';
        }
    }
}
