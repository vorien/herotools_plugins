<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * PersonasArchetypes Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonasArchetypesTable $PersonasArchetypes
 */
class PersonasArchetypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Personas', 'Archetypes']
        ];
        $personasArchetypes = $this->paginate($this->PersonasArchetypes);

        $this->set(compact('personasArchetypes'));
        $this->set('_serialize', ['personasArchetypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Personas Archetype id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personasArchetype = $this->PersonasArchetypes->get($id, [
            'contain' => ['Personas', 'Archetypes']
        ]);

        $this->set('personasArchetype', $personasArchetype);
        $this->set('_serialize', ['personasArchetype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personasArchetype = $this->PersonasArchetypes->newEntity();
        if ($this->request->is('post')) {
            $personasArchetype = $this->PersonasArchetypes->patchEntity($personasArchetype, $this->request->data);
            if ($this->PersonasArchetypes->save($personasArchetype)) {
                $this->Flash->success(__('The personas archetype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas archetype could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasArchetypes->Personas->find('list', ['limit' => 200]);
        $archetypes = $this->PersonasArchetypes->Archetypes->find('list', ['limit' => 200]);
        $this->set(compact('personasArchetype', 'personas', 'archetypes'));
        $this->set('_serialize', ['personasArchetype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personas Archetype id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personasArchetype = $this->PersonasArchetypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personasArchetype = $this->PersonasArchetypes->patchEntity($personasArchetype, $this->request->data);
            if ($this->PersonasArchetypes->save($personasArchetype)) {
                $this->Flash->success(__('The personas archetype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas archetype could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasArchetypes->Personas->find('list', ['limit' => 200]);
        $archetypes = $this->PersonasArchetypes->Archetypes->find('list', ['limit' => 200]);
        $this->set(compact('personasArchetype', 'personas', 'archetypes'));
        $this->set('_serialize', ['personasArchetype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personas Archetype id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personasArchetype = $this->PersonasArchetypes->get($id);
        if ($this->PersonasArchetypes->delete($personasArchetype)) {
            $this->Flash->success(__('The personas archetype has been deleted.'));
        } else {
            $this->Flash->error(__('The personas archetype could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
