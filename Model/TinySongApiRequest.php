<?php
Class TinysongApiRequest extends AppModel {
	public $useTable = false;
	public $validationDomain = 'tinysong_plugin';
	public $validate = [
			'title' =>  [
				'rule'       => ['notEmpty'],
				'message'    => 'Title parameter is required',
				'allowEmpty' => false,
				'required'   => true
			],

			/** Api validation */
			'api_method'         => [
				'validMethods'   => [
					'rule'       => ['inList', ['a', 'b']],
					'message'    => 'This method isnt supported or don\'t exists.. See TinySong API documentation',
					'allowEmpty' => false,
					'required'   => false,
				]
			],
			'api_key' => [
				'rule'       => '/[a-z0-9]{32}/i',
				'message'    => 'API key is required',
				'allowEmpty' => false,
				'required'   => false
			],
	];

}
