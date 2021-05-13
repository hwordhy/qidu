<?php

require_once ("OpenSDK/OAuth/Client.php");
require_once ("OpenSDK/OAuth/Interface.php");
class OpenSDK_163_Weibo extends OpenSDK_OAuth_Interface
{
	const OAUTH_TOKEN = "163_oauth_token";
	const OAUTH_TOKEN_SECRET = "163_oauth_token_secret";
	const ACCESS_TOKEN = "163_access_token";

	/**
     * app key
     * @var string
     */
	static 	protected $_appkey = "";
	/**
     * app secret
     * @var string
     */
	static 	protected $_appsecret = "";
	/**
     * OAuth 对象
     * @var OpenSDK_OAuth_Client
     */
	static 	private $oauth;
	/**
     * OAuth 版本
     * @var string
     */
	static 	protected $version = "1.0";
	static 	private $accessTokenURL = "http://api.t.163.com/oauth/access_token";
	static 	private $authorizeURL = "http://api.t.163.com/oauth/authenticate";
	static 	private $requestTokenURL = "http://api.t.163.com/oauth/request_token";
	static 	protected $_debug = false;

	static public function init($appkey, $appsecret)
	{
		self::$_appkey = $appkey;
		self::$_appsecret = $appsecret;
	}

	static public function getRequestToken($callback = NULL)
	{
		self::getOAuth()->setTokenSecret("");
		$param = ($callback ? array("oauth_callback" => $callback) : array());
		$response = self::request(self::$requestTokenURL, "GET", $param);
		parse_str($response, $rt);
		if ($rt["oauth_token"] && $rt["oauth_token_secret"]) {
			self::getOAuth()->setTokenSecret($rt["oauth_token_secret"]);
			self::setParam(self::OAUTH_TOKEN, $rt["oauth_token"]);
			self::setParam(self::OAUTH_TOKEN_SECRET, $rt["oauth_token_secret"]);
			return $rt;
		}
		else {
			return false;
		}
	}

	static public function getAuthorizeURL($token, $callback = NULL)
	{
		if (is_array($token)) {
			$token = $token["oauth_token"];
		}

		return self::$authorizeURL . "?oauth_token=" . $token . ($callback ? "&oauth_callback=" . urlencode($callback) : "");
	}

	static public function getAccessToken($oauth_verifier = false)
	{
		$param = array("oauth_token" => self::getParam(self::OAUTH_TOKEN));
		$oauth_verifier && ($param["oauth_verifier"] = $oauth_verifier);
		$response = self::request(self::$accessTokenURL, "GET", $param);
		parse_str($response, $rt);
		if ($rt["oauth_token"] && $rt["oauth_token_secret"]) {
			self::getOAuth()->setTokenSecret($rt["oauth_token_secret"]);
			self::setParam(self::ACCESS_TOKEN, $rt["oauth_token"]);
			self::setParam(self::OAUTH_TOKEN_SECRET, $rt["oauth_token_secret"]);
			return $rt;
		}

		return false;
	}

	static public function call($command, $params = array(), $method = "GET", $multi = false, $decode = true, $format = "json")
	{
		if ($format == self::RETURN_XML) {
		}
		else {
			$format == self::RETURN_JSON;
		}

		foreach ($params as $key => $val ) {
			if (strlen($val) == 0) {
				unset($params[$key]);
			}
		}

		$params["oauth_token"] = self::getParam(self::ACCESS_TOKEN);
		$response = self::request("http://api.t.163.com/" . ltrim($command, "/") . "." . $format, $method, $params, $multi);

		if ($decode) {
			if ($format == self::RETURN_JSON) {
				return OpenSDK_Util::json_decode($response, true);
			}
			else {
				return $response;
			}
		}
		else {
			return $response;
		}
	}

	static public function clearOauth()
	{
		self::$oauth = NULL;
	}

	static public function debug($debug = false)
	{
		self::$_debug = $debug;
	}

	static protected function getOAuth()
	{
		if (NULL === self::$oauth) {
			self::$oauth = new OpenSDK_OAuth_Client(self::$_appsecret, self::$_debug);
			$secret = self::getParam(self::OAUTH_TOKEN_SECRET);

			if ($secret) {
				self::$oauth->setTokenSecret($secret);
			}
		}

		return self::$oauth;
	}

	static protected function request($url, $method, $params, $multi = false)
	{
		if (!self::$_appkey || !self::$_appsecret) {
			exit("app key or app secret not init");
		}

		$params["oauth_nonce"] = md5(mt_rand(1, 100000) . microtime(true));
		$params["oauth_consumer_key"] = self::$_appkey;
		$params["oauth_signature_method"] = "HMAC-SHA1";
		$params["oauth_version"] = self::$version;
		$params["oauth_timestamp"] = self::getTimestamp();
		return self::getOAuth()->request($url, $method, $params, $multi);
	}
}


?>
