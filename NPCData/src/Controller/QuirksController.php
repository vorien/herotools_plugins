<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Quirks Controller
 *
 * @property \Vorien\NPCData\Model\Table\QuirksTable $Quirks
 */
class QuirksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $quirks = $this->paginate($this->Quirks);

        $this->set(compact('quirks'));
        $this->set('_serialize', ['quirks']);
    }

    /**
     * View method
     *
     * @param string|null $id Quirk id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $quirk = $this->Quirks->get($id, [
            'contain' => ['Personas']
        ]);

        $this->set('quirk', $quirk);
        $this->set('_serialize', ['quirk']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quirk = $this->Quirks->newEntity();
        if ($this->request->is('post')) {
            $quirk = $this->Quirks->patchEntity($quirk, $this->request->data);
            if ($this->Quirks->save($quirk)) {
                $this->Flash->success(__('The quirk has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The quirk could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Quirks->Personas->find('list', ['limit' => 200]);
        $this->set(compact('quirk', 'personas'));
        $this->set('_serialize', ['quirk']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Quirk id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quirk = $this->Quirks->get($id, [
            'contain' => ['Personas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quirk = $this->Quirks->patchEntity($quirk, $this->request->data);
            if ($this->Quirks->save($quirk)) {
                $this->Flash->success(__('The quirk has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The quirk could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Quirks->Personas->find('list', ['limit' => 200]);
        $this->set(compact('quirk', 'personas'));
        $this->set('_serialize', ['quirk']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Quirk id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quirk = $this->Quirks->get($id);
        if ($this->Quirks->delete($quirk)) {
            $this->Flash->success(__('The quirk has been deleted.'));
        } else {
            $this->Flash->error(__('The quirk could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
