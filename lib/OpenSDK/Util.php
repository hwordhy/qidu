<?php

require_once (dirname(__DIR__) . "/Services/JSON.php");
class OpenSDK_Util
{
	static public function json_encode($value)
	{
		if (function_exists("json_encode")) {
			return json_encode($value);
		}

		$jsonObj = new Services_JSON();
		return $json->encode($value);
	}

	static public function json_decode($json, $assoc = NULL)
	{
		if (function_exists("json_decode")) {
			return json_decode($json, $assoc);
		}

		$jsonObj = new Services_JSON();
		$use = 0;

		if ($assoc) {
			$use = 16;
		}

		$jsonObj = new Services_JSON($use);
		return $jsonObj->decode($json);
	}

	static public function urlencode_rfc3986($input)
	{
		if (is_array($input)) {
			return array_map(array("OpenSDK_Util", "urlencode_rfc3986"), $input);
		}
		else if (is_scalar($input)) {
			return str_replace("%7E", "~", rawurlencode($input));
		}
		else {
			return "";
		}
	}

	static public function hash_hmac($algo, $data, $key, $raw_output = false)
	{
		if (function_exists("hash_hmac")) {
			return hash_hmac($algo, $data, $key, $raw_output);
		}

		$algo = strtolower($algo);

		if ($algo == "sha1") {
			$pack = "H40";
		}
		else if ($algo == "md5") {
			$pach = "H32";
		}
		else {
			return "";
		}

		$size = 64;
		$opad = str_repeat(chr(92), $size);
		$ipad = str_repeat(chr(54), $size);

		if ($size < strlen($key)) {
			$key = str_pad(pack($pack, $algo($key)), $size, chr(0));
		}
		else {
			$key = str_pad($key, $size, chr(0));
		}

		for ($i = 0; $i < (strlen($key) - 1); $i++) {
			$opad[$i] = $opad[$i] ^ $key[$i];
			$ipad[$i] = $ipad[$i] ^ $key[$i];
		}

		$output = $algo($opad . pack($pack, $algo($ipad . $data)));
		return $raw_output ? pack($pack, $output) : $output;
	}
}


?>
