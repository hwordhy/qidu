<?php

require_once (dirname(__DIR__) . "/Util.php");
class OpenSDK_OAuth2_Client
{
	/**
     * 上一次请求返回的Httpcode
     * @var number
     */
	protected $_http_code;
	/**
     * 是否debug
     * @var bool
     */
	protected $_debug = false;
	protected $_http_header = array();
	protected $_useragent = "JIEQICMS-OAuth2.0";
	protected $_http_info = array();
	public $connecttimeout = 3;
	public $timeout = 3;
	public $ssl_verifypeer = false;

	public function __construct($debug = false)
	{
		$this->_debug = $debug;
	}

	public function request($url, $method, $params, $multi = false, $extheaders = array())
	{
		return $this->http($url, $params, $method, $multi, $extheaders);
	}

	protected function http($url, $params, $method = "GET", $multi = false, $extheaders = array())
	{
		return $this->curl_http($url, $params, $method, $multi, $extheaders);
	}

	protected function curl_http($url, $params, $method = "GET", $multi = false, $extheaders = array())
	{
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_USERAGENT, $this->_useragent);
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
		curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
		curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, "getHeader"));
		curl_setopt($ci, CURLOPT_HEADER, false);
		$headers = (array) $extheaders;

		switch ($method) {
		case "POST":
			curl_setopt($ci, CURLOPT_POST, true);

			if (!empty($params)) {
				if ($multi) {
					foreach ($multi as $key => $file ) {
						$params[$key] = "@" . $file;
					}

					curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
					$headers[] = "Expect: ";
				}
				else {
					curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($params));
				}
			}

			break;

		case "DELETE":
		case "GET":
			($method == "DELETE") && curl_setopt($ci, CURLOPT_CUSTOMREQUEST, "DELETE");

			if (!empty($params)) {
				$url = $url . (strpos($url, "?") ? "&" : "?") . (is_array($params) ? http_build_query($params) : $params);
			}

			break;
		}

		curl_setopt($ci, CURLINFO_HEADER_OUT, true);
		curl_setopt($ci, CURLOPT_URL, $url);

		if ($headers) {
			curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
		}

		$response = curl_exec($ci);
		$this->_http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
		$this->_http_info = array_merge($this->_http_info, curl_getinfo($ci));

		if ($this->_debug) {
			echo "Http Code ";
			echo $this->_http_code;
			echo "\r\n";

			foreach ((array) $this->_http_info as $k => $v ) {
				echo $k;
				echo ": ";
				echo $v;
				echo "\r\n";
			}

			echo "\r\n";
			echo $response;
			echo "\r\n";
		}

		curl_close($ci);
		return $response;
	}

	public function getHeader($ch, $header)
	{
		$i = strpos($header, ":");

		if (!empty($i)) {
			$key = str_replace("-", "_", strtolower(substr($header, 0, $i)));
			$value = trim(substr($header, $i + 2));
			$this->_http_header[$key] = $value;
		}

		return strlen($header);
	}

	public function getHttpCode()
	{
		return $this->_http_code;
	}
}


?>
