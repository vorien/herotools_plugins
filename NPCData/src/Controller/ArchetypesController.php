<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Archetypes Controller
 *
 * @property \Vorien\NPCData\Model\Table\ArchetypesTable $Archetypes
 */
class ArchetypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $archetypes = $this->paginate($this->Archetypes);

        $this->set(compact('archetypes'));
        $this->set('_serialize', ['archetypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Archetype id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $archetype = $this->Archetypes->get($id, [
            'contain' => ['Personas']
        ]);

        $this->set('archetype', $archetype);
        $this->set('_serialize', ['archetype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $archetype = $this->Archetypes->newEntity();
        if ($this->request->is('post')) {
            $archetype = $this->Archetypes->patchEntity($archetype, $this->request->data);
            if ($this->Archetypes->save($archetype)) {
                $this->Flash->success(__('The archetype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The archetype could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Archetypes->Personas->find('list', ['limit' => 200]);
        $this->set(compact('archetype', 'personas'));
        $this->set('_serialize', ['archetype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Archetype id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $archetype = $this->Archetypes->get($id, [
            'contain' => ['Personas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $archetype = $this->Archetypes->patchEntity($archetype, $this->request->data);
            if ($this->Archetypes->save($archetype)) {
                $this->Flash->success(__('The archetype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The archetype could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Archetypes->Personas->find('list', ['limit' => 200]);
        $this->set(compact('archetype', 'personas'));
        $this->set('_serialize', ['archetype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Archetype id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $archetype = $this->Archetypes->get($id);
        if ($this->Archetypes->delete($archetype)) {
            $this->Flash->success(__('The archetype has been deleted.'));
        } else {
            $this->Flash->error(__('The archetype could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
