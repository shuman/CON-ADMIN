<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class CustomModule extends AppModel {

	public $primaryKey = 'custom_module_id';
    public $name = 'CustomModule';
    // public $hasMany = array(
    //     'Question' => array(
    //         'className' => 'Question',
    //         'foreignKey' => 'survey_id'
    //     )
    // );

}
