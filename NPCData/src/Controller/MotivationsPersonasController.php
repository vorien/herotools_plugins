<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * MotivationsPersonas Controller
 *
 * @property \Vorien\NPCData\Model\Table\MotivationsPersonasTable $MotivationsPersonas
 */
class MotivationsPersonasController extends AppController
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
        $motivationsPersonas = $this->paginate($this->MotivationsPersonas);

        $this->set(compact('motivationsPersonas'));
        $this->set('_serialize', ['motivationsPersonas']);
    }

    /**
     * View method
     *
     * @param string|null $id Motivations Persona id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $motivationsPersona = $this->MotivationsPersonas->get($id, [
            'contain' => ['Personas', 'Motivations']
        ]);

        $this->set('motivationsPersona', $motivationsPersona);
        $this->set('_serialize', ['motivationsPersona']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $motivationsPersona = $this->MotivationsPersonas->newEntity();
        if ($this->request->is('post')) {
            $motivationsPersona = $this->MotivationsPersonas->patchEntity($motivationsPersona, $this->request->data);
            if ($this->MotivationsPersonas->save($motivationsPersona)) {
                $this->Flash->success(__('The motivations persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The motivations persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->MotivationsPersonas->Personas->find('list', ['limit' => 200]);
        $motivations = $this->MotivationsPersonas->Motivations->find('list', ['limit' => 200]);
        $this->set(compact('motivationsPersona', 'personas', 'motivations'));
        $this->set('_serialize', ['motivationsPersona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Motivations Persona id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $motivationsPersona = $this->MotivationsPersonas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $motivationsPersona = $this->MotivationsPersonas->patchEntity($motivationsPersona, $this->request->data);
            if ($this->MotivationsPersonas->save($motivationsPersona)) {
                $this->Flash->success(__('The motivations persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The motivations persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->MotivationsPersonas->Personas->find('list', ['limit' => 200]);
        $motivations = $this->MotivationsPersonas->Motivations->find('list', ['limit' => 200]);
        $this->set(compact('motivationsPersona', 'personas', 'motivations'));
        $this->set('_serialize', ['motivationsPersona']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Motivations Persona id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $motivationsPersona = $this->MotivationsPersonas->get($id);
        if ($this->MotivationsPersonas->delete($motivationsPersona)) {
            $this->Flash->success(__('The motivations persona has been deleted.'));
        } else {
            $this->Flash->error(__('The motivations persona could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
