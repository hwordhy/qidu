<?php

require_once ("OpenSDK/OAuth/Client.php");
require_once ("OpenSDK/OAuth/Interface.php");
class OpenSDK_Douban_Open extends OpenSDK_OAuth_Interface
{
	const OAUTH_TOKEN = "douban_oauth_token";
	const OAUTH_TOKEN_SECRET = "douban_oauth_token_secret";
	const ACCESS_TOKEN = "douban_access_token";
	const OAUTH_UID = "douban_oauth_uid";

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
	static 	private $accessTokenURL = "http://www.douban.com/service/auth/access_token";
	static 	private $authorizeURL = "http://www.douban.com/service/auth/authorize";
	static 	private $requestTokenURL = "http://www.douban.com/service/auth/request_token";
	/**
     * OAuth 对象
     * @var OpenSDK_OAuth_Client
     */
	static 	protected $oauth;
	/**
     * OAuth 版本
     * @var string
     */
	static 	protected $version = "1.0";
	static 	protected $_debug = false;

	static public function init($appkey, $appsecret)
	{
		self::$_appkey = $appkey;
		self::$_appsecret = $appsecret;
	}

	static public function getRequestToken()
	{
		self::getOAuth()->setTokenSecret("");
		$response = self::request(self::$requestTokenURL, "GET", array());
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

	static public function getAuthorizeURL($token, $callback)
	{
		if (is_array($token)) {
			$token = $token["oauth_token"];
		}

		return self::$authorizeURL . "?oauth_token=" . $token . "&oauth_callback=" . urlencode($callback);
	}

	static public function getAccessToken()
	{
		$response = self::request(self::$accessTokenURL, "GET", array("oauth_token" => self::getParam(self::OAUTH_TOKEN)));
		parse_str($response, $rt);
		if ($rt["oauth_token"] && $rt["oauth_token_secret"]) {
			self::getOAuth()->setTokenSecret($rt["oauth_token_secret"]);
			self::setParam(self::ACCESS_TOKEN, $rt["oauth_token"]);
			self::setParam(self::OAUTH_TOKEN_SECRET, $rt["oauth_token_secret"]);
			self::setParam(self::OAUTH_UID, $rt["douban_user_id"]);
			return $rt;
		}

		return false;
	}

	static public function call($command, $params = array(), $method = "GET", $multi = false, $decode = true, $format = self::RETURN_JSON)
	{
		if ($format == self::RETURN_XML) {
		}
		else {
			$format == self::RETURN_JSON;
		}

		$params["alt"] = $format;

		foreach ($params as $key => $val ) {
			if (strlen($val) == 0) {
				unset($params[$key]);
			}
		}

		$params["oauth_token"] = self::getParam(self::ACCESS_TOKEN);
		$response = self::request("http://api.douban.com/" . ltrim($command, "/"), $method, $params, $multi);

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
