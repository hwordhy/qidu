<?php

class OpenSDK_OAuth_Interface
{
	const RETURN_JSON = "json";
	const RETURN_XML = "xml";

	static 	protected $timestampFunc;
	static 	protected $getParamFunc;
	static 	protected $setParamFunc;
	static 	protected $remot_ip;

	static public function getTimestamp()
	{
		if ((NULL !== self::$timestampFunc) && is_callable(self::$timestampFunc)) {
			return call_user_func(self::$timestampFunc);
		}

		return time();
	}

	static public function timestamp_set_save_handler($func)
	{
		self::$timestampFunc = $func;
	}

	static public function getParam($key)
	{
		if ((NULL !== self::$getParamFunc) && is_callable(self::$getParamFunc)) {
			return call_user_func(self::$getParamFunc, $key);
		}

		return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
	}

	static public function param_set_save_handler($get, $set)
	{
		self::$getParamFunc = $get;
		self::$setParamFunc = $set;
	}

	static public function setParam($key, $val = NULL)
	{
		if ((NULL !== self::$setParamFunc) && is_callable(self::$setParamFunc)) {
			return call_user_func(self::$setParamFunc, $key, $val);
		}

		if (NULL === $val) {
			unset($_SESSION[$key]);
			return NULL;
		}

		$_SESSION[$key] = $val;
	}

	static public function set_remote_ip($ip)
	{
		self::$remot_ip = $ip;
	}

	static protected function getRemoteIp()
	{
		return self::$remot_ip ? self::$remot_ip : $_SERVER["REMOTE_ADDR"];
	}
}


?>
