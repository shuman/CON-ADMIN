<?php
App::uses('AppController', 'Controller');
/**
 * Navigations Controller
 *
 * @property Navigation $Navigation
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class NavigationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Navigation->recursive = 0;
		$this->set('navigations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Navigation->exists($id)) {
			throw new NotFoundException(__('Invalid navigation'));
		}
		$options = array('conditions' => array('Navigation.' . $this->Navigation->primaryKey => $id));
		$this->set('navigation', $this->Navigation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Navigation->create();
			if ($this->Navigation->save($this->request->data)) {
				$this->Flash->success(__('The navigation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The navigation could not be saved. Please, try again.'));
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
		if (!$this->Navigation->exists($id)) {
			throw new NotFoundException(__('Invalid navigation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Navigation->save($this->request->data)) {
				$this->Flash->success(__('The navigation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The navigation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Navigation.' . $this->Navigation->primaryKey => $id));
			$this->request->data = $this->Navigation->find('first', $options);
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
		$this->Navigation->id = $id;
		if (!$this->Navigation->exists()) {
			throw new NotFoundException(__('Invalid navigation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Navigation->delete()) {
			$this->Flash->success(__('The navigation has been deleted.'));
		} else {
			$this->Flash->error(__('The navigation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function navList() {
		$navigations = ClassRegistry::init('Navigation')->find('all', ['fields' => ['id', 'type', 'name', 'slug', 'custom_module_id', 'status'], 'conditions' => ['Navigation.type' => ['nav', 'cus'], 'Navigation.status !=' => 'removed'], 'order' => ['Navigation.position ASC']]);
		return $navigations;
	}

	public function mainMenuList() {
		$navigations = ClassRegistry::init('Navigation')->find('all', ['fields' => ['id', 'name', 'slug', 'status'], 'conditions' => ['Navigation.type' => 'main', 'Navigation.status !=' => 'removed'], 'order' => ['Navigation.position ASC']]);
		return $navigations;
	}

	public function updateNav($nid) {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (!$nid) {
        	return false;
        }
        ClassRegistry::init('Navigation')->id = $nid;
        if (ClassRegistry::init('Navigation')->saveField('status', 'inactive')) {
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function updateNavOn($nid) {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (!$nid) {
        	return false;
        }
        ClassRegistry::init('Navigation')->id = $nid;
        if (ClassRegistry::init('Navigation')->saveField('status', 'active')) {
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function editNav($nid) {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (!$nid) {
        	return false;
        }
        ClassRegistry::init('Navigation')->id = $nid;
        if (ClassRegistry::init('Navigation')->saveField('status', 'inactive')) {
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function deleteNav($nid) {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (!$nid) {
        	return false;
        }
        ClassRegistry::init('Navigation')->id = $nid;
        if (ClassRegistry::init('Navigation')->saveField('status', 'removed')) {
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function saveUpdateNav() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data) {
        	if (ClassRegistry::init('Navigation')->save($this->request->data)) {
        		return json_encode(1);
        	}
        }
        return json_encode(0);
	}

	public function updateNavigation() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data['Navigation']) {
        	foreach ($this->request->data['Navigation'] as $key => $value) {
	        	ClassRegistry::init('Navigation')->id = $value;
	        	ClassRegistry::init('Navigation')->saveField('position', $key + 1);
        	}
        	return json_encode(1);
        }
        return json_encode(0);
	}
}
