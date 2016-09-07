<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class AnswerResult extends AppModel {

	public $primaryKey = 'answer_result_id';
    public $name = 'AnswerResult';
    // public $hasMany = array(
    //     'Question' => array(
    //         'className' => 'Question',
    //         'foreignKey' => 'survey_id'
    //     )
    // );

}
