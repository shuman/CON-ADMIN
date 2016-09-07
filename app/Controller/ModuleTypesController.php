<?php
App::uses('AppController', 'Controller');
/**
 * ModuleTypes Controller
 *
 * @property ModuleType $ModuleType
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ModuleTypesController extends AppController {

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
		$this->ModuleType->recursive = 0;
		$this->set('moduleTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ModuleType->exists($id)) {
			throw new NotFoundException(__('Invalid module type'));
		}
		$options = array('conditions' => array('ModuleType.' . $this->ModuleType->primaryKey => $id));
		$this->set('moduleType', $this->ModuleType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ModuleType->create();
			if ($this->ModuleType->save($this->request->data)) {
				$this->Flash->success(__('The module type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The module type could not be saved. Please, try again.'));
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
		if (!$this->ModuleType->exists($id)) {
			throw new NotFoundException(__('Invalid module type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ModuleType->save($this->request->data)) {
				$this->Flash->success(__('The module type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The module type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ModuleType.' . $this->ModuleType->primaryKey => $id));
			$this->request->data = $this->ModuleType->find('first', $options);
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
		$this->ModuleType->id = $id;
		if (!$this->ModuleType->exists()) {
			throw new NotFoundException(__('Invalid module type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ModuleType->delete()) {
			$this->Flash->success(__('The module type has been deleted.'));
		} else {
			$this->Flash->error(__('The module type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
