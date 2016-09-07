<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class Survey extends AppModel {

	public $primaryKey = 'survey_id';
    public $name = 'Survey';
    public $hasMany = array(
        'Question' => array(
            'className' => 'Question',
            'foreignKey' => 'survey_id',
            'order' => [
            	'show_order' => 'ASC'
            ]
        )
    );

}
