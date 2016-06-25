<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Flaws Controller
 *
 * @property \Vorien\NPCData\Model\Table\FlawsTable $Flaws
 */
class FlawsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $flaws = $this->paginate($this->Flaws);

        $this->set(compact('flaws'));
        $this->set('_serialize', ['flaws']);
    }

    /**
     * View method
     *
     * @param string|null $id Flaw id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $flaw = $this->Flaws->get($id, [
            'contain' => ['Personas']
        ]);

        $this->set('flaw', $flaw);
        $this->set('_serialize', ['flaw']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $flaw = $this->Flaws->newEntity();
        if ($this->request->is('post')) {
            $flaw = $this->Flaws->patchEntity($flaw, $this->request->data);
            if ($this->Flaws->save($flaw)) {
                $this->Flash->success(__('The flaw has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The flaw could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Flaws->Personas->find('list', ['limit' => 200]);
        $this->set(compact('flaw', 'personas'));
        $this->set('_serialize', ['flaw']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Flaw id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $flaw = $this->Flaws->get($id, [
            'contain' => ['Personas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flaw = $this->Flaws->patchEntity($flaw, $this->request->data);
            if ($this->Flaws->save($flaw)) {
                $this->Flash->success(__('The flaw has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The flaw could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Flaws->Personas->find('list', ['limit' => 200]);
        $this->set(compact('flaw', 'personas'));
        $this->set('_serialize', ['flaw']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Flaw id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flaw = $this->Flaws->get($id);
        if ($this->Flaws->delete($flaw)) {
            $this->Flash->success(__('The flaw has been deleted.'));
        } else {
            $this->Flash->error(__('The flaw could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
