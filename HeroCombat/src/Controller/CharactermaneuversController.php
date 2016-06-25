<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Charactermaneuvers Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CharactermaneuversTable $Charactermaneuvers
 */
class CharactermaneuversController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characters', 'Maneuvers']
        ];
        $charactermaneuvers = $this->paginate($this->Charactermaneuvers);

        $this->set(compact('charactermaneuvers'));
        $this->set('_serialize', ['charactermaneuvers']);
    }

    /**
     * View method
     *
     * @param string|null $id Charactermaneuver id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $charactermaneuver = $this->Charactermaneuvers->get($id, [
            'contain' => ['Characters', 'Maneuvers']
        ]);

        $this->set('charactermaneuver', $charactermaneuver);
        $this->set('_serialize', ['charactermaneuver']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $charactermaneuver = $this->Charactermaneuvers->newEntity();
        if ($this->request->is('post')) {
            $charactermaneuver = $this->Charactermaneuvers->patchEntity($charactermaneuver, $this->request->data);
            if ($this->Charactermaneuvers->save($charactermaneuver)) {
                $this->Flash->success(__('The charactermaneuver has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charactermaneuver could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Charactermaneuvers->Characters->find('list', ['limit' => 200]);
        $maneuvers = $this->Charactermaneuvers->Maneuvers->find('list', ['limit' => 200]);
        $this->set(compact('charactermaneuver', 'characters', 'maneuvers'));
        $this->set('_serialize', ['charactermaneuver']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Charactermaneuver id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $charactermaneuver = $this->Charactermaneuvers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $charactermaneuver = $this->Charactermaneuvers->patchEntity($charactermaneuver, $this->request->data);
            if ($this->Charactermaneuvers->save($charactermaneuver)) {
                $this->Flash->success(__('The charactermaneuver has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charactermaneuver could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Charactermaneuvers->Characters->find('list', ['limit' => 200]);
        $maneuvers = $this->Charactermaneuvers->Maneuvers->find('list', ['limit' => 200]);
        $this->set(compact('charactermaneuver', 'characters', 'maneuvers'));
        $this->set('_serialize', ['charactermaneuver']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Charactermaneuver id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $charactermaneuver = $this->Charactermaneuvers->get($id);
        if ($this->Charactermaneuvers->delete($charactermaneuver)) {
            $this->Flash->success(__('The charactermaneuver has been deleted.'));
        } else {
            $this->Flash->error(__('The charactermaneuver could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
