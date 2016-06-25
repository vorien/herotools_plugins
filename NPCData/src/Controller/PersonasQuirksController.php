<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * PersonasQuirks Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonasQuirksTable $PersonasQuirks
 */
class PersonasQuirksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Personas', 'Quirks']
        ];
        $personasQuirks = $this->paginate($this->PersonasQuirks);

        $this->set(compact('personasQuirks'));
        $this->set('_serialize', ['personasQuirks']);
    }

    /**
     * View method
     *
     * @param string|null $id Personas Quirk id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personasQuirk = $this->PersonasQuirks->get($id, [
            'contain' => ['Personas', 'Quirks']
        ]);

        $this->set('personasQuirk', $personasQuirk);
        $this->set('_serialize', ['personasQuirk']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personasQuirk = $this->PersonasQuirks->newEntity();
        if ($this->request->is('post')) {
            $personasQuirk = $this->PersonasQuirks->patchEntity($personasQuirk, $this->request->data);
            if ($this->PersonasQuirks->save($personasQuirk)) {
                $this->Flash->success(__('The personas quirk has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas quirk could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasQuirks->Personas->find('list', ['limit' => 200]);
        $quirks = $this->PersonasQuirks->Quirks->find('list', ['limit' => 200]);
        $this->set(compact('personasQuirk', 'personas', 'quirks'));
        $this->set('_serialize', ['personasQuirk']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personas Quirk id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personasQuirk = $this->PersonasQuirks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personasQuirk = $this->PersonasQuirks->patchEntity($personasQuirk, $this->request->data);
            if ($this->PersonasQuirks->save($personasQuirk)) {
                $this->Flash->success(__('The personas quirk has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas quirk could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasQuirks->Personas->find('list', ['limit' => 200]);
        $quirks = $this->PersonasQuirks->Quirks->find('list', ['limit' => 200]);
        $this->set(compact('personasQuirk', 'personas', 'quirks'));
        $this->set('_serialize', ['personasQuirk']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personas Quirk id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personasQuirk = $this->PersonasQuirks->get($id);
        if ($this->PersonasQuirks->delete($personasQuirk)) {
            $this->Flash->success(__('The personas quirk has been deleted.'));
        } else {
            $this->Flash->error(__('The personas quirk could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
