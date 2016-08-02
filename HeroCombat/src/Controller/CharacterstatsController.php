<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Characterstats Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CharacterstatsTable $Characterstats
 */
class CharacterstatsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characters']
        ];
        $characterstats = $this->paginate($this->Characterstats);

        $this->set(compact('characterstats'));
        $this->set('_serialize', ['characterstats']);
    }

    /**
     * View method
     *
     * @param string|null $id Characterstat id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $characterstat = $this->Characterstats->get($id, [
            'contain' => ['Characters', 'Characterlevels', 'Charactermaneuvers', 'Characterprotections', 'Characterweapons']
        ]);

        $this->set('characterstat', $characterstat);
        $this->set('_serialize', ['characterstat']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $characterstat = $this->Characterstats->newEntity();
        if ($this->request->is('post')) {
            $characterstat = $this->Characterstats->patchEntity($characterstat, $this->request->data);
            if ($this->Characterstats->save($characterstat)) {
                $this->Flash->success(__('The characterstat has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterstat could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Characterstats->Characters->find('list', ['limit' => 200]);
        $this->set(compact('characterstat', 'characters'));
        $this->set('_serialize', ['characterstat']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Characterstat id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $characterstat = $this->Characterstats->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $characterstat = $this->Characterstats->patchEntity($characterstat, $this->request->data);
            if ($this->Characterstats->save($characterstat)) {
                $this->Flash->success(__('The characterstat has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterstat could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Characterstats->Characters->find('list', ['limit' => 200]);
        $this->set(compact('characterstat', 'characters'));
        $this->set('_serialize', ['characterstat']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Characterstat id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $characterstat = $this->Characterstats->get($id);
        if ($this->Characterstats->delete($characterstat)) {
            $this->Flash->success(__('The characterstat has been deleted.'));
        } else {
            $this->Flash->error(__('The characterstat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
