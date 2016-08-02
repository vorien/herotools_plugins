<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Targets Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\TargetsTable $Targets
 */
class TargetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $targets = $this->paginate($this->Targets);

        $this->set(compact('targets'));
        $this->set('_serialize', ['targets']);
    }

    /**
     * View method
     *
     * @param string|null $id Target id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $target = $this->Targets->get($id, [
            'contain' => ['Locations']
        ]);

        $this->set('target', $target);
        $this->set('_serialize', ['target']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $target = $this->Targets->newEntity();
        if ($this->request->is('post')) {
            $target = $this->Targets->patchEntity($target, $this->request->data);
            if ($this->Targets->save($target)) {
                $this->Flash->success(__('The target has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The target could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('target'));
        $this->set('_serialize', ['target']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Target id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $target = $this->Targets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $target = $this->Targets->patchEntity($target, $this->request->data);
            if ($this->Targets->save($target)) {
                $this->Flash->success(__('The target has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The target could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('target'));
        $this->set('_serialize', ['target']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Target id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $target = $this->Targets->get($id);
        if ($this->Targets->delete($target)) {
            $this->Flash->success(__('The target has been deleted.'));
        } else {
            $this->Flash->error(__('The target could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
