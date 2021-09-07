<?php

namespace App\Validation;

class MyRules
{
	public function valid_name($str): bool
	{
		if (!preg_match('/^[a-z .,‘\-\']+$/i', $str) && $str != "") {
			return false;
		}
		return true;
	}
	public function valid_NIK($str): bool
	{
		if ($str === 0 or $str == '' or $str == null) {
			return true;
		}
		if (strlen($str) != 16) {
			return false;
		}
		if (!preg_match('/^[0-9]+$/i', $str)) {
			return false;
		}
		return true;
	}
}
