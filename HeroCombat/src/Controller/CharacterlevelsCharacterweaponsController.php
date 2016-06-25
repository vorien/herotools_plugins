<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * CharacterlevelsCharacterweapons Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CharacterlevelsCharacterweaponsTable $CharacterlevelsCharacterweapons
 */
class CharacterlevelsCharacterweaponsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characterlevels', 'Characterweapons']
        ];
        $characterlevelsCharacterweapons = $this->paginate($this->CharacterlevelsCharacterweapons);

        $this->set(compact('characterlevelsCharacterweapons'));
        $this->set('_serialize', ['characterlevelsCharacterweapons']);
    }

    /**
     * View method
     *
     * @param string|null $id Characterlevels Characterweapon id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $characterlevelsCharacterweapon = $this->CharacterlevelsCharacterweapons->get($id, [
            'contain' => ['Characterlevels', 'Characterweapons']
        ]);

        $this->set('characterlevelsCharacterweapon', $characterlevelsCharacterweapon);
        $this->set('_serialize', ['characterlevelsCharacterweapon']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $characterlevelsCharacterweapon = $this->CharacterlevelsCharacterweapons->newEntity();
        if ($this->request->is('post')) {
            $characterlevelsCharacterweapon = $this->CharacterlevelsCharacterweapons->patchEntity($characterlevelsCharacterweapon, $this->request->data);
            if ($this->CharacterlevelsCharacterweapons->save($characterlevelsCharacterweapon)) {
                $this->Flash->success(__('The characterlevels characterweapon has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterlevels characterweapon could not be saved. Please, try again.'));
            }
        }
        $characterlevels = $this->CharacterlevelsCharacterweapons->Characterlevels->find('list', ['limit' => 200]);
        $characterweapons = $this->CharacterlevelsCharacterweapons->Characterweapons->find('list', ['limit' => 200]);
        $this->set(compact('characterlevelsCharacterweapon', 'characterlevels', 'characterweapons'));
        $this->set('_serialize', ['characterlevelsCharacterweapon']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Characterlevels Characterweapon id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $characterlevelsCharacterweapon = $this->CharacterlevelsCharacterweapons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $characterlevelsCharacterweapon = $this->CharacterlevelsCharacterweapons->patchEntity($characterlevelsCharacterweapon, $this->request->data);
            if ($this->CharacterlevelsCharacterweapons->save($characterlevelsCharacterweapon)) {
                $this->Flash->success(__('The characterlevels characterweapon has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterlevels characterweapon could not be saved. Please, try again.'));
            }
        }
        $characterlevels = $this->CharacterlevelsCharacterweapons->Characterlevels->find('list', ['limit' => 200]);
        $characterweapons = $this->CharacterlevelsCharacterweapons->Characterweapons->find('list', ['limit' => 200]);
        $this->set(compact('characterlevelsCharacterweapon', 'characterlevels', 'characterweapons'));
        $this->set('_serialize', ['characterlevelsCharacterweapon']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Characterlevels Characterweapon id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $characterlevelsCharacterweapon = $this->CharacterlevelsCharacterweapons->get($id);
        if ($this->CharacterlevelsCharacterweapons->delete($characterlevelsCharacterweapon)) {
            $this->Flash->success(__('The characterlevels characterweapon has been deleted.'));
        } else {
            $this->Flash->error(__('The characterlevels characterweapon could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
