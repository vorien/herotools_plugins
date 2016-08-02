<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Characterlevels Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CharacterlevelsTable $Characterlevels
 */
class CharacterlevelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characterstats', 'Levels']
        ];
        $characterlevels = $this->paginate($this->Characterlevels);

        $this->set(compact('characterlevels'));
        $this->set('_serialize', ['characterlevels']);
    }

    /**
     * View method
     *
     * @param string|null $id Characterlevel id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $characterlevel = $this->Characterlevels->get($id, [
            'contain' => ['Characterstats', 'Levels', 'Characterweapons']
        ]);

        $this->set('characterlevel', $characterlevel);
        $this->set('_serialize', ['characterlevel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $characterlevel = $this->Characterlevels->newEntity();
        if ($this->request->is('post')) {
            $characterlevel = $this->Characterlevels->patchEntity($characterlevel, $this->request->data);
            if ($this->Characterlevels->save($characterlevel)) {
                $this->Flash->success(__('The characterlevel has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterlevel could not be saved. Please, try again.'));
            }
        }
        $characterstats = $this->Characterlevels->Characterstats->find('list', ['limit' => 200]);
        $levels = $this->Characterlevels->Levels->find('list', ['limit' => 200]);
        $characterweapons = $this->Characterlevels->Characterweapons->find('list', ['limit' => 200]);
        $this->set(compact('characterlevel', 'characterstats', 'levels', 'characterweapons'));
        $this->set('_serialize', ['characterlevel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Characterlevel id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $characterlevel = $this->Characterlevels->get($id, [
            'contain' => ['Characterweapons']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $characterlevel = $this->Characterlevels->patchEntity($characterlevel, $this->request->data);
            if ($this->Characterlevels->save($characterlevel)) {
                $this->Flash->success(__('The characterlevel has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterlevel could not be saved. Please, try again.'));
            }
        }
        $characterstats = $this->Characterlevels->Characterstats->find('list', ['limit' => 200]);
        $levels = $this->Characterlevels->Levels->find('list', ['limit' => 200]);
        $characterweapons = $this->Characterlevels->Characterweapons->find('list', ['limit' => 200]);
        $this->set(compact('characterlevel', 'characterstats', 'levels', 'characterweapons'));
        $this->set('_serialize', ['characterlevel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Characterlevel id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $characterlevel = $this->Characterlevels->get($id);
        if ($this->Characterlevels->delete($characterlevel)) {
            $this->Flash->success(__('The characterlevel has been deleted.'));
        } else {
            $this->Flash->error(__('The characterlevel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
