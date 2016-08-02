<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Characterweapons Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CharacterweaponsTable $Characterweapons
 */
class CharacterweaponsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characterstats', 'Weapons']
        ];
        $characterweapons = $this->paginate($this->Characterweapons);

        $this->set(compact('characterweapons'));
        $this->set('_serialize', ['characterweapons']);
    }

    /**
     * View method
     *
     * @param string|null $id Characterweapon id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $characterweapon = $this->Characterweapons->get($id, [
            'contain' => ['Characterstats', 'Weapons', 'Characterlevels']
        ]);

        $this->set('characterweapon', $characterweapon);
        $this->set('_serialize', ['characterweapon']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $characterweapon = $this->Characterweapons->newEntity();
        if ($this->request->is('post')) {
            $characterweapon = $this->Characterweapons->patchEntity($characterweapon, $this->request->data);
            if ($this->Characterweapons->save($characterweapon)) {
                $this->Flash->success(__('The characterweapon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterweapon could not be saved. Please, try again.'));
            }
        }
        $characterstats = $this->Characterweapons->Characterstats->find('list', ['limit' => 200]);
        $weapons = $this->Characterweapons->Weapons->find('list', ['limit' => 200]);
        $characterlevels = $this->Characterweapons->Characterlevels->find('list', ['limit' => 200]);
        $this->set(compact('characterweapon', 'characterstats', 'weapons', 'characterlevels'));
        $this->set('_serialize', ['characterweapon']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Characterweapon id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $characterweapon = $this->Characterweapons->get($id, [
            'contain' => ['Characterlevels']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $characterweapon = $this->Characterweapons->patchEntity($characterweapon, $this->request->data);
            if ($this->Characterweapons->save($characterweapon)) {
                $this->Flash->success(__('The characterweapon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterweapon could not be saved. Please, try again.'));
            }
        }
        $characterstats = $this->Characterweapons->Characterstats->find('list', ['limit' => 200]);
        $weapons = $this->Characterweapons->Weapons->find('list', ['limit' => 200]);
        $characterlevels = $this->Characterweapons->Characterlevels->find('list', ['limit' => 200]);
        $this->set(compact('characterweapon', 'characterstats', 'weapons', 'characterlevels'));
        $this->set('_serialize', ['characterweapon']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Characterweapon id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $characterweapon = $this->Characterweapons->get($id);
        if ($this->Characterweapons->delete($characterweapon)) {
            $this->Flash->success(__('The characterweapon has been deleted.'));
        } else {
            $this->Flash->error(__('The characterweapon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
