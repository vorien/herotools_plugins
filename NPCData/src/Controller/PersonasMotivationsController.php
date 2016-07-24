<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * PersonasMotivations Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonasMotivationsTable $PersonasMotivations
 */
class PersonasMotivationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Personas', 'Motivations']
        ];
        $personasMotivations = $this->paginate($this->PersonasMotivations);

        $this->set(compact('personasMotivations'));
        $this->set('_serialize', ['personasMotivations']);
    }

    /**
     * View method
     *
     * @param string|null $id Personas Motivation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personasMotivation = $this->PersonasMotivations->get($id, [
            'contain' => ['Personas', 'Motivations']
        ]);

        $this->set('personasMotivation', $personasMotivation);
        $this->set('_serialize', ['personasMotivation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personasMotivation = $this->PersonasMotivations->newEntity();
        if ($this->request->is('post')) {
            $personasMotivation = $this->PersonasMotivations->patchEntity($personasMotivation, $this->request->data);
            if ($this->PersonasMotivations->save($personasMotivation)) {
                $this->Flash->success(__('The personas motivation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas motivation could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasMotivations->Personas->find('list', ['limit' => 200]);
        $motivations = $this->PersonasMotivations->Motivations->find('list', ['limit' => 200]);
        $this->set(compact('personasMotivation', 'personas', 'motivations'));
        $this->set('_serialize', ['personasMotivation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personas Motivation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personasMotivation = $this->PersonasMotivations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personasMotivation = $this->PersonasMotivations->patchEntity($personasMotivation, $this->request->data);
            if ($this->PersonasMotivations->save($personasMotivation)) {
                $this->Flash->success(__('The personas motivation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas motivation could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasMotivations->Personas->find('list', ['limit' => 200]);
        $motivations = $this->PersonasMotivations->Motivations->find('list', ['limit' => 200]);
        $this->set(compact('personasMotivation', 'personas', 'motivations'));
        $this->set('_serialize', ['personasMotivation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personas Motivation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personasMotivation = $this->PersonasMotivations->get($id);
        if ($this->PersonasMotivations->delete($personasMotivation)) {
            $this->Flash->success(__('The personas motivation has been deleted.'));
        } else {
            $this->Flash->error(__('The personas motivation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
