<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * PersonasFlaws Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonasFlawsTable $PersonasFlaws
 */
class PersonasFlawsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Personas', 'Flaws']
        ];
        $personasFlaws = $this->paginate($this->PersonasFlaws);

        $this->set(compact('personasFlaws'));
        $this->set('_serialize', ['personasFlaws']);
    }

    /**
     * View method
     *
     * @param string|null $id Personas Flaw id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personasFlaw = $this->PersonasFlaws->get($id, [
            'contain' => ['Personas', 'Flaws']
        ]);

        $this->set('personasFlaw', $personasFlaw);
        $this->set('_serialize', ['personasFlaw']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personasFlaw = $this->PersonasFlaws->newEntity();
        if ($this->request->is('post')) {
            $personasFlaw = $this->PersonasFlaws->patchEntity($personasFlaw, $this->request->data);
            if ($this->PersonasFlaws->save($personasFlaw)) {
                $this->Flash->success(__('The personas flaw has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas flaw could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasFlaws->Personas->find('list', ['limit' => 200]);
        $flaws = $this->PersonasFlaws->Flaws->find('list', ['limit' => 200]);
        $this->set(compact('personasFlaw', 'personas', 'flaws'));
        $this->set('_serialize', ['personasFlaw']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personas Flaw id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personasFlaw = $this->PersonasFlaws->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personasFlaw = $this->PersonasFlaws->patchEntity($personasFlaw, $this->request->data);
            if ($this->PersonasFlaws->save($personasFlaw)) {
                $this->Flash->success(__('The personas flaw has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas flaw could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasFlaws->Personas->find('list', ['limit' => 200]);
        $flaws = $this->PersonasFlaws->Flaws->find('list', ['limit' => 200]);
        $this->set(compact('personasFlaw', 'personas', 'flaws'));
        $this->set('_serialize', ['personasFlaw']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personas Flaw id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personasFlaw = $this->PersonasFlaws->get($id);
        if ($this->PersonasFlaws->delete($personasFlaw)) {
            $this->Flash->success(__('The personas flaw has been deleted.'));
        } else {
            $this->Flash->error(__('The personas flaw could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
