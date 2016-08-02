<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Weapons Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\WeaponsTable $Weapons
 */
class WeaponsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $weapons = $this->paginate($this->Weapons);

        $this->set(compact('weapons'));
        $this->set('_serialize', ['weapons']);
    }

    /**
     * View method
     *
     * @param string|null $id Weapon id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weapon = $this->Weapons->get($id, [
            'contain' => ['Characterweapons']
        ]);

        $this->set('weapon', $weapon);
        $this->set('_serialize', ['weapon']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weapon = $this->Weapons->newEntity();
        if ($this->request->is('post')) {
            $weapon = $this->Weapons->patchEntity($weapon, $this->request->data);
            if ($this->Weapons->save($weapon)) {
                $this->Flash->success(__('The weapon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weapon could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('weapon'));
        $this->set('_serialize', ['weapon']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Weapon id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weapon = $this->Weapons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weapon = $this->Weapons->patchEntity($weapon, $this->request->data);
            if ($this->Weapons->save($weapon)) {
                $this->Flash->success(__('The weapon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weapon could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('weapon'));
        $this->set('_serialize', ['weapon']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Weapon id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weapon = $this->Weapons->get($id);
        if ($this->Weapons->delete($weapon)) {
            $this->Flash->success(__('The weapon has been deleted.'));
        } else {
            $this->Flash->error(__('The weapon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
