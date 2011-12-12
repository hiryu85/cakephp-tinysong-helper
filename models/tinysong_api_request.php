<?php
class TinysongApiRequest extends AppModel {
    var $name = 'TinysongApiRequest';
    var $useTable = false;
    
    
    function __construct($table=null, $prefix=null, $ds=null) {
        parent::__construct($table, $prefix, $ds);
        
        $this->validate = array(
            //'artist' => array(),
            //'album' => array(),
            'title' =>  array(
                'rule' => array('notEmpty'),
                'message' => __d('tinysong_plugin', 'Title parameter is required', true),
                'allowEmpty' => false,
                'required' => true
            ),
            
            /** Api validation */
            'api_method' => array(
                'validMethods' => array(
                    'rule' => array('inList', array('a', 'b')),
                    'message' => __d('tinysong_plugin', 'This method isnt supported or don\'t exists.. See TinySong API documentation', true),
                    'allowEmpty' => false,
                    'required' => false,
                )
            ),
            'api_key' => array(
                'rule' => '/[a-z0-9]{32}/i',
                'message' => __d('tinysong_plugin', 'API key is required', true),
                'allowEmpty' => false,
                'required' => false
            ),
        );
    }
    
}
