<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Maneuvers Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\ManeuversTable $Maneuvers
 */
class ManeuversController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $maneuvers = $this->paginate($this->Maneuvers);

        $this->set(compact('maneuvers'));
        $this->set('_serialize', ['maneuvers']);
    }

    /**
     * View method
     *
     * @param string|null $id Maneuver id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $maneuver = $this->Maneuvers->get($id, [
            'contain' => ['Charactermaneuvers']
        ]);

        $this->set('maneuver', $maneuver);
        $this->set('_serialize', ['maneuver']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $maneuver = $this->Maneuvers->newEntity();
        if ($this->request->is('post')) {
            $maneuver = $this->Maneuvers->patchEntity($maneuver, $this->request->data);
            if ($this->Maneuvers->save($maneuver)) {
                $this->Flash->success(__('The maneuver has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The maneuver could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('maneuver'));
        $this->set('_serialize', ['maneuver']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Maneuver id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $maneuver = $this->Maneuvers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maneuver = $this->Maneuvers->patchEntity($maneuver, $this->request->data);
            if ($this->Maneuvers->save($maneuver)) {
                $this->Flash->success(__('The maneuver has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The maneuver could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('maneuver'));
        $this->set('_serialize', ['maneuver']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Maneuver id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $maneuver = $this->Maneuvers->get($id);
        if ($this->Maneuvers->delete($maneuver)) {
            $this->Flash->success(__('The maneuver has been deleted.'));
        } else {
            $this->Flash->error(__('The maneuver could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
