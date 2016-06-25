<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Levels Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\LevelsTable $Levels
 */
class LevelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $levels = $this->paginate($this->Levels);

        $this->set(compact('levels'));
        $this->set('_serialize', ['levels']);
    }

    /**
     * View method
     *
     * @param string|null $id Level id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $level = $this->Levels->get($id, [
            'contain' => ['Characterlevels']
        ]);

        $this->set('level', $level);
        $this->set('_serialize', ['level']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $level = $this->Levels->newEntity();
        if ($this->request->is('post')) {
            $level = $this->Levels->patchEntity($level, $this->request->data);
            if ($this->Levels->save($level)) {
                $this->Flash->success(__('The level has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The level could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('level'));
        $this->set('_serialize', ['level']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Level id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $level = $this->Levels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $level = $this->Levels->patchEntity($level, $this->request->data);
            if ($this->Levels->save($level)) {
                $this->Flash->success(__('The level has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The level could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('level'));
        $this->set('_serialize', ['level']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Level id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $level = $this->Levels->get($id);
        if ($this->Levels->delete($level)) {
            $this->Flash->success(__('The level has been deleted.'));
        } else {
            $this->Flash->error(__('The level could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
