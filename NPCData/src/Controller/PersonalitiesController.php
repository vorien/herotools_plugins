<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Personalities Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonalitiesTable $Personalities
 */
class PersonalitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $personalities = $this->paginate($this->Personalities);

        $this->set(compact('personalities'));
        $this->set('_serialize', ['personalities']);
    }

    /**
     * View method
     *
     * @param string|null $id Personality id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personality = $this->Personalities->get($id, [
            'contain' => []
        ]);

        $this->set('personality', $personality);
        $this->set('_serialize', ['personality']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personality = $this->Personalities->newEntity();
        if ($this->request->is('post')) {
            $personality = $this->Personalities->patchEntity($personality, $this->request->data);
            if ($this->Personalities->save($personality)) {
                $this->Flash->success(__('The personality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personality could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('personality'));
        $this->set('_serialize', ['personality']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personality id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personality = $this->Personalities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personality = $this->Personalities->patchEntity($personality, $this->request->data);
            if ($this->Personalities->save($personality)) {
                $this->Flash->success(__('The personality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personality could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('personality'));
        $this->set('_serialize', ['personality']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personality id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personality = $this->Personalities->get($id);
        if ($this->Personalities->delete($personality)) {
            $this->Flash->success(__('The personality has been deleted.'));
        } else {
            $this->Flash->error(__('The personality could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
