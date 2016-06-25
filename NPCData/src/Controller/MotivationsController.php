<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Motivations Controller
 *
 * @property \Vorien\NPCData\Model\Table\MotivationsTable $Motivations
 */
class MotivationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $motivations = $this->paginate($this->Motivations);

        $this->set(compact('motivations'));
        $this->set('_serialize', ['motivations']);
    }

    /**
     * View method
     *
     * @param string|null $id Motivation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $motivation = $this->Motivations->get($id, [
            'contain' => ['Personas']
        ]);

        $this->set('motivation', $motivation);
        $this->set('_serialize', ['motivation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $motivation = $this->Motivations->newEntity();
        if ($this->request->is('post')) {
            $motivation = $this->Motivations->patchEntity($motivation, $this->request->data);
            if ($this->Motivations->save($motivation)) {
                $this->Flash->success(__('The motivation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The motivation could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Motivations->Personas->find('list', ['limit' => 200]);
        $this->set(compact('motivation', 'personas'));
        $this->set('_serialize', ['motivation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Motivation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $motivation = $this->Motivations->get($id, [
            'contain' => ['Personas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $motivation = $this->Motivations->patchEntity($motivation, $this->request->data);
            if ($this->Motivations->save($motivation)) {
                $this->Flash->success(__('The motivation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The motivation could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Motivations->Personas->find('list', ['limit' => 200]);
        $this->set(compact('motivation', 'personas'));
        $this->set('_serialize', ['motivation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Motivation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $motivation = $this->Motivations->get($id);
        if ($this->Motivations->delete($motivation)) {
            $this->Flash->success(__('The motivation has been deleted.'));
        } else {
            $this->Flash->error(__('The motivation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
