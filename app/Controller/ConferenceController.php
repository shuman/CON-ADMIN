<?php
App::uses('AppController', 'Controller');
/**
 * Conferences Controller
 *
 * @property Conference $Conference
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ConferenceController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	public $helpers = array('Csv'); 

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$conference = ClassRegistry::init('Conference')->find('first');
		$this->set('conference', $conference);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Conference->exists($id)) {
			throw new NotFoundException(__('Invalid conference'));
		}
		$options = array('conditions' => array('Conference.' . $this->Conference->primaryKey => $id));
		$this->set('conference', $this->Conference->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Conference->create();
			if ($this->Conference->save($this->request->data)) {
				$this->Flash->success(__('The conference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The conference could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Conference->exists($id)) {
			throw new NotFoundException(__('Invalid conference'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Conference->save($this->request->data)) {
				$this->Flash->success(__('The conference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The conference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Conference.' . $this->Conference->primaryKey => $id));
			$this->request->data = $this->Conference->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Conference->id = $id;
		if (!$this->Conference->exists()) {
			throw new NotFoundException(__('Invalid conference'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Conference->delete()) {
			$this->Flash->success(__('The conference has been deleted.'));
		} else {
			$this->Flash->error(__('The conference could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function survey() {
		$surveys = ClassRegistry::init('Survey')->find('all', ['limit' => 10, 'conditions' => ['Survey.deleted' => 0], 'order' => 'Survey.show_order ASC']);
		$navigation = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.slug' => 'survey']]);
		$this->set('navigation', $navigation);
		$this->set('surveys', $surveys);
	}

	public function createServeyElement() {
		if ($this->RequestHandler->isAjax()) { 
			$questions = ClassRegistry::init('Question')->find('all');
         	$this->render('/Elements/createSurvey'); 
     	} 
	}

	public function createServeyQuestionElement() {
		if ($this->RequestHandler->isAjax()) { 
         	$this->render('/Elements/createSurveyQuestion'); 
     	} 
	}

	public function createEditServeyQuestionElement($surveyId) {
		if ($this->RequestHandler->isAjax()) { 
			$this->set('surveyId', $surveyId);
         	$this->render('/Elements/createEditSurveyQuestion'); 
     	} 
	}

	public function editServeyQuestionElement() {
		if ($this->RequestHandler->isAjax()) { 
         	$this->render('/Elements/editSurveyQuestion'); 
     	} 
	}

	public function saveQuestion() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (ClassRegistry::init('Question')->save($this->request->data)) {
        	$questionId = ClassRegistry::init('Question')->getLastInsertID();
        	foreach ($this->request->data['answer'] as $eachAnswer) {
        		$data['answer'] = $eachAnswer;
        		$data['question_id'] = $questionId;
        		ClassRegistry::init('PresetAnswer')->create();
        		ClassRegistry::init('PresetAnswer')->save($data);
        	}
        	return json_encode((int)$questionId);
        } else {
        	return json_encode(0);
        }
	}

	public function updateQuestion() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $questionId = $this->request->data['question_id'];
        ClassRegistry::init('Question')->id = $questionId;
        if (ClassRegistry::init('Question')->save($this->request->data)) {
        	// Delete Previous answers
        	$answers = ClassRegistry::init('PresetAnswer')->find('all', ['conditions' => ['PresetAnswer.question_id' => $questionId]]);
        	// Delete all previous answer
        	if ($answers) {
        		foreach ($answers as $eachAnswer) {
        			ClassRegistry::init('PresetAnswer')->id = $eachAnswer['PresetAnswer']['preset_answer_id'];
        			ClassRegistry::init('PresetAnswer')->delete();
        		}
        	}
        	// Save New Answers
        	if ($this->request->data['answer']) {
        		foreach ($this->request->data['answer'] as $eachNanswer) {
        			$data['answer'] = $eachNanswer;
        			$data['question_id'] = $questionId;
        			ClassRegistry::init('PresetAnswer')->create();
        			ClassRegistry::init('PresetAnswer')->save($data);
        		}
        	}
        	return json_encode((int)$questionId);
        }
        return json_encode(0);
	}

	public function updateSurvey() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (ClassRegistry::init('Survey')->save($this->request->data)) {
        	$surveyId = ClassRegistry::init('Survey')->getLastInsertID();
        	// foreach ($this->request->data['questions'] as $eachQuestionId) {
        	// 	ClassRegistry::init('Question')->id = $eachQuestionId;
        	// 	ClassRegistry::init('Question')->saveField('survey_id', $surveyId);	
        	// }
        	return json_encode((int)$surveyId);
        }
        return json_encode(0);
	}

	public function saveSurvey() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (ClassRegistry::init('Survey')->save($this->request->data)) {
        	$surveyId = ClassRegistry::init('Survey')->getLastInsertID();
        	foreach ($this->request->data['questions'] as $eachQuestionId) {
        		ClassRegistry::init('Question')->id = $eachQuestionId;
        		ClassRegistry::init('Question')->saveField('survey_id', $surveyId);	
        	}
        	return json_encode((int)$surveyId);
        }
        return json_encode(0);
	}

	public function faqs() {
		$faqs = ClassRegistry::init('Faq')->find('all', ['limit' => 10, 'conditions' => ['Faq.deleted' => 0], 'order' => ['Faq.show_order ASC']]);
		$navigation = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.slug' => 'faqs']]);
		$this->set('navigation', $navigation);
		$this->set('faqs', $faqs);
	}

	public function polls() {
		$polls = ClassRegistry::init('Poll')->find('all', ['limit' => 20, 'conditions' => ['Poll.deleted' => 0], 'order' => ['Poll.show_order ASC']]);
		$navigation = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.slug' => 'polls']]);
		$this->set('navigation', $navigation);
		$this->set('polls', $polls);
	}

	public function createFaqElement() {
		if ($this->RequestHandler->isAjax()) { 
         	$this->render('/Elements/createFaq'); 
     	}
	}

	public function saveFaq() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (ClassRegistry::init('Faq')->save($this->request->data)) {
        	if (isset($this->request->data['faq_id'])) {
	        	$faqId = $this->request->data['faq_id'];
	        } else {
	        	$faqId = ClassRegistry::init('Faq')->getLastInsertID();
	        }
        	return json_encode((int)$faqId);
        }
        return json_encode(0);
	}

	public function deleteFaq() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Faq')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Faq')->saveField('deleted', 1)) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function deleteSurveyQuestion() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Question')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Question')->delete()) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function deleteSurvey() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Survey')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Survey')->saveField('deleted', 1)) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function deletePoll() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Poll')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Poll')->saveField('deleted', 1)) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function createPollElement() {
		if ($this->RequestHandler->isAjax()) { 
         	$this->render('/Elements/createPoll'); 
     	}
	}

	public function savePoll() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (ClassRegistry::init('Poll')->save($this->request->data)) {
        	$pollQuestionId = ClassRegistry::init('Poll')->getLastInsertID();
        	foreach ($this->request->data['answer'] as $eachAnswer) {
        		$data['poll_id'] = $pollQuestionId;
        		$data['answer'] = $eachAnswer;
        		ClassRegistry::init('PresetPollAnswer')->create();
        		ClassRegistry::init('PresetPollAnswer')->save($data);
        	}
        	return json_encode((int)$pollQuestionId);
        }
        else {
        	return json_encode(0);
        }
	}

	public function updatePoll() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $pollId = $this->request->data['poll_id'];
        ClassRegistry::init('Poll')->id = $pollId;
        if (ClassRegistry::init('Poll')->save($this->request->data)) {
        	$answer = ClassRegistry::init('PresetPollAnswer')->find('all', ['conditions' => ['PresetPollAnswer.poll_id' => $pollId]]);
        	if ($answer) {
        		foreach ($answer as $eachAnswer) {
        			ClassRegistry::init('PresetPollAnswer')->id = $eachAnswer['PresetPollAnswer']['preset_poll_answer_id'];
        			ClassRegistry::init('PresetPollAnswer')->delete();
        		}
        	}
        	if ($this->request->data['type'] == 1) {
        		if ($this->request->data['answer']) {
	        		foreach ($this->request->data['answer'] as $eachPanswer) {
	        			$data['poll_id'] = $pollId;
	        			$data['answer'] = $eachPanswer;
	        			ClassRegistry::init('PresetPollAnswer')->create();
	        			ClassRegistry::init('PresetPollAnswer')->save($data);
	        		}
        		}
        	}
        	return json_encode((int)$pollId);
        }
        return json_encode(0);
	}

	public function module() {

	}

	public function selectMuduleType() {
		if ($this->RequestHandler->isAjax()) { 
         	$this->render('/Elements/moduleType'); 
     	}
	}

	public function customMuduleType() {
		if ($this->RequestHandler->isAjax()) { 
			$customModule = ClassRegistry::init('CustomModule')->find('all', ['fields' => ['custom_module_id', 'name', 'parent_id']]);
			$this->set('customModule', $customModule);
         	$this->render('/Elements/customModuleType'); 
     	}
	}

	public function saveNewModule() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/json');
        if (ClassRegistry::init('CustomModule')->save($this->request->data)) {
        	$moduleId = ClassRegistry::init('CustomModule')->getLastInsertID();
        	$lastNavPos = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.type' => 'nav'], 'order' => ['Navigation.position DESC']]);
        	$nav['position'] = $lastNavPos['Navigation']['position'] + 1;
        	$nav['type'] = 'cus';
        	$nav['name'] = $this->request->data['name'];
            $nav['custom_module_id'] = $moduleId;
        	$nav['status'] = 'active';
        	ClassRegistry::init('Navigation')->save($nav);
        	$navId = ClassRegistry::init('Navigation')->getLastInsertID();
        	$return['nav'] = (int)$navId;
        	if ($this->request->data['module_menu_item']) {
        		for ($i=0; $i < $this->request->data['module_menu_item']; $i++) { 
        			$data['parent_id'] = $moduleId;
        			ClassRegistry::init('CustomModule')->create();
        			ClassRegistry::init('CustomModule')->save($data);
        		}
        	}
        	$return['modId'] = (int)$moduleId;
        	return json_encode($return);
        }
        return json_encode(0);
	}

	public function updateCusModule() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('CustomModule')->id = $this->request->data['custom_module_id'];
        if (ClassRegistry::init('CustomModule')->save($this->request->data)) {
        	$moduleId = ClassRegistry::init('CustomModule')->getLastInsertID();
        	if ($this->request->data['module_menu_item']) {
        		for ($i=0; $i < $this->request->data['module_menu_item']; $i++) { 
        			$data['parent_id'] = $moduleId;
        			ClassRegistry::init('CustomModule')->create();
        			ClassRegistry::init('CustomModule')->save($data);
        		}
        	}
        	return json_encode((int)$this->request->data['custom_module_id']);
        }
        return json_encode(0);
	}

	public function createCustomMudule() {
		if ($this->RequestHandler->isAjax()) { 
			$customModule = ClassRegistry::init('CustomModule')->find('all', ['fields' => ['custom_module_id', 'name', 'parent_id']]);
			$this->set('customModule', $customModule);
         	$this->render('/Elements/customModuleType'); 
     	}
	}

	public function customForm() {
		if ($this->RequestHandler->isAjax()) { 
         	$this->render('/Elements/customForm'); 
     	}
	}

	public function entertainment() {
		if ($this->RequestHandler->isAjax()) { 
			$exist = ClassRegistry::init('ModuleType')->find('first', ['conditions' => ['ModuleType.name' => $this->request->params['action']]]);
			$this->set('savedData', $exist);
         	$this->render('/Elements/modType'); 
     	}
	}

	public function donate() {
		if ($this->RequestHandler->isAjax()) { 
			$exist = ClassRegistry::init('ModuleType')->find('first', ['conditions' => ['ModuleType.name' => $this->request->params['action']]]);
			$this->set('savedData', $exist);
         	$this->render('/Elements/modType'); 
     	}
	}

	public function store() {
		if ($this->RequestHandler->isAjax()) { 
			$exist = ClassRegistry::init('ModuleType')->find('first', ['conditions' => ['ModuleType.name' => $this->request->params['action']]]);
			$this->set('savedData', $exist);
         	$this->render('/Elements/modType'); 
     	}
	}

	public function food() {
		if ($this->RequestHandler->isAjax()) { 
			$exist = ClassRegistry::init('ModuleType')->find('first', ['conditions' => ['ModuleType.name' => $this->request->params['action']]]);
			$this->set('savedData', $exist);
         	$this->render('/Elements/modType'); 
     	}
	}

	public function sponsors() {
		if ($this->RequestHandler->isAjax()) {
		$exist = ClassRegistry::init('ModuleType')->find('first', ['conditions' => ['ModuleType.name' => $this->request->params['action']]]);
         	$this->render('/Elements/modType'); 
     	}
	}

	public function surveyReport($id) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$id) {
				return json_encode(0);
			}
			ClassRegistry::init('Question')->bindModel(array('hasMany' => ['PresetAnswer']));
			ClassRegistry::init('Question')->bindModel(array('hasMany' => ['AnswerResult']));
			ClassRegistry::init('Survey')->recursive = 2;
			$survey = ClassRegistry::init('Survey')->find('first', ['fields' => ['Survey.name'], 'conditions' => ['Survey.survey_id' => $id]]);
			foreach ($survey['Question'] as $qkey => $eachQuestion) {
				
				foreach ($eachQuestion['PresetAnswer'] as $pkey => $eachPresetAnswer) {
					// Total Answer
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['total'] = sizeof($eachQuestion['AnswerResult']);
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['answered'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['yes'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['no'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['true'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['false'] = 0;
					// pr($survey['Question']); exit;
					foreach ($eachQuestion['AnswerResult'] as $akey => $eachAnswerResult) {
						if ($eachQuestion['type'] == 0) {
							if ($eachAnswerResult['preset_answer_id'] == $eachPresetAnswer['preset_answer_id']) {
								$survey['Question'][$qkey]['PresetAnswer'][$pkey]['answered'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['answered'] + 1;
							}
						} elseif ($eachQuestion['type'] == 1) {
							if ($eachAnswerResult['preset_answer_id'] == $eachPresetAnswer['preset_answer_id']) {
								if ($eachAnswerResult['is_yes'] == 1) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['yes'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['yes'] + 1;
								} elseif ($eachAnswerResult['is_yes'] == 0) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['no'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['no'] + 1;
								}
							}
						} elseif ($eachQuestion['type'] == 2) {
							if ($eachAnswerResult['preset_answer_id'] == $eachPresetAnswer['preset_answer_id']) {
								if ($eachAnswerResult['is_true'] == 1) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['true'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['true'] + 1;
								} elseif ($eachAnswerResult['is_true'] == 0) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['false'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['false'] + 1;
								}
							}
						} else {

						}
					}
				}
			}
			$this->set('survey', $survey);
         	$this->render('/Elements/surveyReport'); 
     	}
	}

	public function pollReport($id) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$id) {
				return json_encode(0);
			}
			ClassRegistry::init('Poll')->bindModel(array('hasMany' => ['PresetPollAnswer']));
			ClassRegistry::init('PresetPollAnswer')->bindModel(array('hasMany' => ['PollAnswerResult']));
			ClassRegistry::init('Poll')->recursive = 2;
			$polls = ClassRegistry::init('poll')->find('first', ['conditions' => ['Poll.poll_id' => $id]]);
			// Polls data build
			foreach ($polls['PresetPollAnswer'] as $pkey => $eachPoll) {
				$polls['PresetPollAnswer'][$pkey]['total'] = sizeof($eachPoll['PollAnswerResult']);
				$polls['PresetPollAnswer'][$pkey]['answered'] = 0;
				$polls['PresetPollAnswer'][$pkey]['yes'] = 0;
				$polls['PresetPollAnswer'][$pkey]['no'] = 0;
				$polls['PresetPollAnswer'][$pkey]['true'] = 0;
				$polls['PresetPollAnswer'][$pkey]['false'] = 0;
				// detailed datd
				foreach ($eachPoll['PollAnswerResult'] as $akey => $eachAnswer) {
					if ($polls['Poll']['type'] == 0) {
							if ($eachAnswer['preset_poll_answer_id'] == $eachPoll['preset_poll_answer_id']) {
								$polls['PresetPollAnswer'][$pkey]['answered'] = $polls['PresetPollAnswer'][$pkey]['answered'] + 1;
							}
						} elseif ($polls['Poll']['type'] == 1) {
							if ($eachAnswer['preset_poll_answer_id'] == $eachAnswer['preset_poll_answer_id']) {
								if ($eachAnswer['is_yes'] == 1) {
									$polls['PresetPollAnswer'][$pkey]['yes'] = $polls['PresetPollAnswer'][$pkey]['yes'] + 1;
								} elseif ($eachAnswer['is_yes'] == 0) {
									$polls['PresetPollAnswer'][$pkey]['no'] = $polls['PresetPollAnswer'][$pkey]['no'] + 1;
								}
							}
						} elseif ($polls['Poll']['type'] == 2) {
							if ($eachAnswer['preset_poll_answer_id'] == $eachAnswer['preset_poll_answer_id']) {
								if ($eachAnswer['is_true'] == 1) {
									$polls['PresetPollAnswer'][$pkey]['true'] = $polls['PresetPollAnswer'][$pkey]['true'] + 1;
								} elseif ($eachAnswer['is_true'] == 0) {
									$polls['PresetPollAnswer'][$pkey]['false'] = $polls['PresetPollAnswer'][$pkey]['false'] + 1;
								}
							}
						} else {

						}
				}
				// pr($eachPoll); exit;
			}
			$this->set('poll', $polls);
         	$this->render('/Elements/pollReport'); 
     	}
	}

	public function surveyedit($sid) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$sid) {
				return false;
			}
			$survey = ClassRegistry::init('Survey')->find('first', ['conditions' => ['Survey.survey_id' => $sid]]);
			$this->request->data = $survey['Survey'];
			$this->set('survey', $survey);
         	$this->render('/Elements/surveyEdit'); 
     	}
	}

	public function surveyQuestionEdit($sid) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$sid) {
				return false;
			}
			ClassRegistry::init('Question')->bindModel(array('hasMany' => ['PresetAnswer']));
			$question = ClassRegistry::init('Question')->find('first', ['conditions' => ['Question.question_id' => $sid]]);
			$this->request->data = $question['Question'];
			$this->set('question', $question);
         	$this->render('/Elements/quesitonEdit'); 
     	}
	}

	public function polledit($pid) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$pid) {
				return false;
			}
			ClassRegistry::init('Poll')->bindModel(array('hasMany' => ['PresetPollAnswer']));
			$poll = ClassRegistry::init('Poll')->find('first', ['conditions' => ['Poll.poll_id' => $pid]]);
			$this->set('poll', $poll);
         	$this->render('/Elements/pollEdit'); 
     	}
	}

	public function updateSurveyQuestionList() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data['Question']) {
        	foreach ($this->request->data['Question'] as $key => $value) {
	        	ClassRegistry::init('Question')->id = $value;
	        	ClassRegistry::init('Question')->saveField('show_order', $key + 1);
        	}
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function updateSurveyList() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data['Survey']) {
        	foreach ($this->request->data['Survey'] as $key => $value) {
	        	ClassRegistry::init('Survey')->id = $value;
	        	ClassRegistry::init('Survey')->saveField('show_order', $key + 1);
        	}
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function updatePollList() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data['Poll']) {
        	foreach ($this->request->data['Poll'] as $key => $value) {
	        	ClassRegistry::init('Poll')->id = $value;
	        	ClassRegistry::init('Poll')->saveField('show_order', $key + 1);
        	}
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function updateFaqList() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data['Faq']) {
        	foreach ($this->request->data['Faq'] as $key => $value) {
	        	ClassRegistry::init('Faq')->id = $value;
	        	ClassRegistry::init('Faq')->saveField('show_order', $key + 1);
        	}
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function pexport($id)
	{
		if (!$id) {
				return json_encode(0);
			}
			ClassRegistry::init('Poll')->bindModel(array('hasMany' => ['PresetPollAnswer']));
			ClassRegistry::init('PresetPollAnswer')->bindModel(array('hasMany' => ['PollAnswerResult']));
			ClassRegistry::init('Poll')->recursive = 2;
			$polls = ClassRegistry::init('poll')->find('first', ['conditions' => ['Poll.poll_id' => $id]]);
			// Polls data build
			foreach ($polls['PresetPollAnswer'] as $pkey => $eachPoll) {
				$polls['PresetPollAnswer'][$pkey]['total'] = sizeof($eachPoll['PollAnswerResult']);
				$polls['PresetPollAnswer'][$pkey]['answered'] = 0;
				$polls['PresetPollAnswer'][$pkey]['yes'] = 0;
				$polls['PresetPollAnswer'][$pkey]['no'] = 0;
				$polls['PresetPollAnswer'][$pkey]['true'] = 0;
				$polls['PresetPollAnswer'][$pkey]['false'] = 0;
				// detailed datd
				foreach ($eachPoll['PollAnswerResult'] as $akey => $eachAnswer) {
					if ($polls['Poll']['type'] == 0) {
							if ($eachAnswer['preset_poll_answer_id'] == $eachPoll['preset_poll_answer_id']) {
								$polls['PresetPollAnswer'][$pkey]['answered'] = $polls['PresetPollAnswer'][$pkey]['answered'] + 1;
							}
						} elseif ($polls['Poll']['type'] == 1) {
							if ($eachAnswer['preset_poll_answer_id'] == $eachAnswer['preset_poll_answer_id']) {
								if ($eachAnswer['is_yes'] == 1) {
									$polls['PresetPollAnswer'][$pkey]['yes'] = $polls['PresetPollAnswer'][$pkey]['yes'] + 1;
								} elseif ($eachAnswer['is_yes'] == 0) {
									$polls['PresetPollAnswer'][$pkey]['no'] = $polls['PresetPollAnswer'][$pkey]['no'] + 1;
								}
							}
						} elseif ($polls['Poll']['type'] == 2) {
							if ($eachAnswer['preset_poll_answer_id'] == $eachAnswer['preset_poll_answer_id']) {
								if ($eachAnswer['is_true'] == 1) {
									$polls['PresetPollAnswer'][$pkey]['true'] = $polls['PresetPollAnswer'][$pkey]['true'] + 1;
								} elseif ($eachAnswer['is_true'] == 0) {
									$polls['PresetPollAnswer'][$pkey]['false'] = $polls['PresetPollAnswer'][$pkey]['false'] + 1;
								}
							}
						} else {

						}
				}
			}
	    $this->set('poll', $polls);
	    $this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}

	public function suexport($id) {
		if (!$id) {
				return json_encode(0);
			}
			ClassRegistry::init('Question')->bindModel(array('hasMany' => ['PresetAnswer']));
			ClassRegistry::init('Question')->bindModel(array('hasMany' => ['AnswerResult']));
			ClassRegistry::init('Survey')->recursive = 2;
			$survey = ClassRegistry::init('Survey')->find('first', ['fields' => ['Survey.name'], 'conditions' => ['Survey.survey_id' => $id]]);
			foreach ($survey['Question'] as $qkey => $eachQuestion) {
				
				foreach ($eachQuestion['PresetAnswer'] as $pkey => $eachPresetAnswer) {
					// Total Answer
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['total'] = sizeof($eachQuestion['AnswerResult']);
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['answered'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['yes'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['no'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['true'] = 0;
					$survey['Question'][$qkey]['PresetAnswer'][$pkey]['false'] = 0;
					// pr($survey['Question']); exit;
					foreach ($eachQuestion['AnswerResult'] as $akey => $eachAnswerResult) {
						if ($eachQuestion['type'] == 0) {
							if ($eachAnswerResult['preset_answer_id'] == $eachPresetAnswer['preset_answer_id']) {
								$survey['Question'][$qkey]['PresetAnswer'][$pkey]['answered'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['answered'] + 1;
							}
						} elseif ($eachQuestion['type'] == 1) {
							if ($eachAnswerResult['preset_answer_id'] == $eachPresetAnswer['preset_answer_id']) {
								if ($eachAnswerResult['is_yes'] == 1) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['yes'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['yes'] + 1;
								} elseif ($eachAnswerResult['is_yes'] == 0) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['no'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['no'] + 1;
								}
							}
						} elseif ($eachQuestion['type'] == 2) {
							if ($eachAnswerResult['preset_answer_id'] == $eachPresetAnswer['preset_answer_id']) {
								if ($eachAnswerResult['is_true'] == 1) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['true'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['true'] + 1;
								} elseif ($eachAnswerResult['is_true'] == 0) {
									$survey['Question'][$qkey]['PresetAnswer'][$pkey]['false'] = $survey['Question'][$qkey]['PresetAnswer'][$pkey]['false'] + 1;
								}
							}
						} else {

						}
					}
				}
			}
 			$this->set('survey', $survey);
		    $this->layout = null;
		    $this->autoLayout = false;
		    Configure::write('debug','0');
	}

	public function faqedit($id) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$id) {
				return false;
			}
			$faq = ClassRegistry::init('Faq')->find('first', ['conditions' => ['Faq.faq_id' => $id]]);
			// pr($faq); exit;	
			$this->set('faq', $faq);
         	$this->render('/Elements/faqEdit'); 
     	}
	}

	public function saveModData($id) {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (isset($this->request->data['id'])) {
        	ClassRegistry::init('ModuleType')->id = $exits['ModuleType']['id'];
        } else {
        	ClassRegistry::init('ModuleType')->create();
        }
        // Save data
        if (ClassRegistry::init('ModuleType')->save($this->request->data)) {
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function customModuleEdit($id) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$id) {
				return false;
			}
			$customModule = ClassRegistry::init('CustomModule')->find('first', ['conditions' => ['CustomModule.custom_module_id' => $id]]);
			// pr($faq); exit;	
			$this->set('customModule', $customModule);
         	$this->render('/Elements/customModuleEdit'); 
     	}
	}

    public function customModPage() {
        if ($this->RequestHandler->isAjax()) { 
            if (!$this->request->data['id']) {
                return false;
            }
            $cusModId = $this->request->data['id'];
            // Module list
            $modules = ClassRegistry::init('Module')->find('all', ['conditions' => ['Module.custom_module_id' => $cusModId, 'Module.deleted' => 0]]);
            $navigation = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.custom_module_id' => $cusModId]]);
            $this->set('navigation', $navigation);
            $this->set('modules', $modules);
            $this->render('/Elements/navDetails'); 
        }
    }

    public function cusModuleEdit($id) {
        if ($this->RequestHandler->isAjax()) { 
            if (!$id) {
                return json_encode(0);
            }
            $module = ClassRegistry::init('Module')->find('first', ['conditions' => ['Module.id' => $id]]);
            $this->set('module', $module);
            $this->render('/Elements/editNewModule'); 
        }
    }

    public function saveNewCusModule() {
        $this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/json');
        if ($this->request->is('post')) {
            $this->request->data['status'] = 'active';
            if (ClassRegistry::init('Module')->save($this->request->data)) {
                $moduleId = ClassRegistry::init('Module')->getLastInsertID();
                return json_encode((int)$moduleId);
            } else {
                return json_encode(0);
            }
        }
    }

    public function updateNewCusModule() {
        $this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/json');
        if ($this->request->is('post')) {
            $this->request->data['status'] = 'active';
            ClassRegistry::init('Module')->id = $this->request->data['id'];
            if (ClassRegistry::init('Module')->save($this->request->data)) {
                return json_encode((int)$this->request->data['id']);
            } else {
                return json_encode(0);
            }
        }
    }

    public function deleteCusModule() {
        $this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Module')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Module')->saveField('deleted', 1)) {
            return json_encode(1);
        } else {
            return json_encode(0);
        }
    }
}
