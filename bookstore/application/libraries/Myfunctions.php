<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Myfunctions {
    function replace_title($str){
		if(!$str) return false;
	    $str = trim($str);
		$unicode = array(
			'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ặ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|A|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'd' => 'đ|Đ',
			'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|E|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'i' => 'í|ì|ỉ|ĩ|ị|I|Í|Ì|Ỉ|Ĩ|Ị',
			'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|O|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|U|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Y|Ý|Ỳ|Ỷ|Ỹ|Ỵ',        
		);
		foreach ($unicode as $nonUnicode => $uni)
			$str = preg_replace("/($uni)/i",$nonUnicode,$str);
		$str = strtolower(str_replace(' ','-',$str));           // Replaces all spaces with hyphens.
	    $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);      // Removes special chars.
	    $str = preg_replace('/-+/', '-', $str);               // Replaces multiple hyphens with single one.	
		return $str;
	}

	function charLimit($str, $limit = 150, $strip_tags = true, $end_char = ' &#8230;', $enc = 'utf-8') {
			if (trim($str) == '') {
				return $str;
			}

			if ($strip_tags) {
				$str = strip_tags($str);
			}

			if (strlen($str) > $limit) {
				if (function_exists("mb_substr")) {
					$str = mb_substr($str, 0, $limit, $enc);
				} else {
					$str = substr($str, 0, $limit);
				}
				return rtrim($str) . $end_char;
			} else {
				return $str;
			}
	}

}
?>