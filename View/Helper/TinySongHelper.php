<?php
class TinySongHelper extends AppHelper {
	var $helpers = array('Html');

	/** Helper default options */
	var $_defaultOptions = array(
		'api_key' => null
	);


	/** Allowed API query */
	var $_allowedQueryStrings = array('artist', 'album', 'title');

	/** API url */
	const API_URL = 'http://tinysong.com/%s/%s?format=json&key=%s';


   /**
	* Helper constructor
	*
	* @param    array   TinySongHelper options
	*/
	function __construct(View $View, $options = array()) {
		parent::__construct($View, $options);
		$this->settings = array_merge($this->_defaultOptions, $options);
	}

   /**
	*  Print link (With HtmlHelper::link) for listening track
	*
	*   @param  array   API request
	*   @param  string  Link title
	*   @param  mixed   Link's HTML attributes (@see HtmlHelper::link method)
	*   @return string
	*/
	function link($apiMethods, $title=null, $htmlAttributes=array()) {
		$apiMethods['api_method'] = 'a';
		if ($response = ($this->_request($apiMethods))) {
			return $this->output( $this->Html->link($title, $response, $htmlAttributes) );
		}
	}

   /**
	* Return all meta tags for the song requested (in JSON format)
	*
	* @param  array   API request
	* @return array   API response (in json)
	*/
	function info($apiMethods) {
		$apiMethods['api_method'] = 'b';
		if ($response = ($this->_request($apiMethods)))
			return $this->output( json_encode($response) );
		else return null;
	}

   /**
	*  Set up API request and return response
	*
	*  @param   array   API values
	*  @see     http://tinysong.com/api
	*/
	private function _request($args) {
		// Setting "api_key" only for this request
		if (!isset($args['api_key'])) {
			$args['api_key'] = $this->settings['api_key'];
		}

		// Check if $args has valid keys=>values
		$Api = ClassRegistry::init('TinySong.TinysongApiRequest', 'Model');
		$Api->set($args);
		$_isValidRequest = $Api->validates();
		if (!$_isValidRequest) {
			trigger_error(
				sprintf(__d('tinysong_plugin', "No valid api request.. \n %s \n", true), json_encode( $Api->invalidFields())),
				E_USER_NOTICE
			);
			return null;
		}

		App::uses('HttpSocket', 'Network/Http');
		$HttpSocket = new HttpSocket();

		// Join all valid query parameters
		foreach($this->_getAllValidQueryKeys($args) as $key => $value) {
			$query[] = $key. ':'. $value;
		}
		$url = sprintf($this::API_URL, $args['api_method'], implode('+', $query), $args['api_key']);
		$response = $HttpSocket->get($url, array('format' => 'json'));

		$response = json_decode($response, true);
		if (is_array($response) && isset($response['error'])) {
			$errmsg = sprintf(__d('tinysong_plugin', 'API Error: %s', true), $response['error']);
			$this->log($errmsg, 'TinysongPlugin');
			trigger_error($errmsg, E_USER_WARNING);
			return null;
		}
		return $response;
	}


   /**
	* Check if $arg is in _allowedQueryStrings
	*
	* @return bool
	*/
	private function _isValidQueryAttribute($arg) {
		return in_array($arg, array_values($this->_allowedQueryStrings) );
	}

   /**
	* Return all valid queries string
	*
	* @return array
	*/
	private function _getAllValidQueryKeys($args) {
		$_valids = array_filter(array_keys($args), array($this, '_isValidQueryAttribute'));
		$query = array();
		foreach($_valids as $key) {
			$query[$key] = $args[$key];
		}
		return $query;
	}


}
