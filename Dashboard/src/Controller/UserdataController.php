<?php
namespace Vorien\Dashboard\Controller;

use Vorien\Dashboard\Controller\AppController;

/**
 * Userdata Controller
 *
 * @property \Vorien\Dashboard\Model\Table\UserdataTable $Userdata
 */
class UserdataController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $userdata = $this->paginate($this->Userdata);

        $this->set(compact('userdata'));
        $this->set('_serialize', ['userdata']);
    }

    /**
     * View method
     *
     * @param string|null $id Userdata id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userdata = $this->Userdata->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userdata', $userdata);
        $this->set('_serialize', ['userdata']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userdata = $this->Userdata->newEntity();
        if ($this->request->is('post')) {
            $userdata = $this->Userdata->patchEntity($userdata, $this->request->data);
            if ($this->Userdata->save($userdata)) {
                $this->Flash->success(__('The userdata has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The userdata could not be saved. Please, try again.'));
            }
        }
        $users = $this->Userdata->Users->find('list', ['limit' => 200]);
        $this->set(compact('userdata', 'users'));
        $this->set('_serialize', ['userdata']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Userdata id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userdata = $this->Userdata->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userdata = $this->Userdata->patchEntity($userdata, $this->request->data);
            if ($this->Userdata->save($userdata)) {
                $this->Flash->success(__('The userdata has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The userdata could not be saved. Please, try again.'));
            }
        }
        $users = $this->Userdata->Users->find('list', ['limit' => 200]);
        $this->set(compact('userdata', 'users'));
        $this->set('_serialize', ['userdata']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Userdata id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userdata = $this->Userdata->get($id);
        if ($this->Userdata->delete($userdata)) {
            $this->Flash->success(__('The userdata has been deleted.'));
        } else {
            $this->Flash->error(__('The userdata could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
