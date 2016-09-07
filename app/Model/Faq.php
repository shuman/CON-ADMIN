<?php
App::uses('AppModel', 'Model');
/**
 * Faq Model
 *
 */
class Faq extends AppModel {

	public $primaryKey = 'faq_id';
    public $name = 'Faq';
    // public $hasMany = array(
    //     'Question' => array(
    //         'className' => 'Question',
    //         'foreignKey' => 'survey_id'
    //     )
    // );

}
