<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * FlawsPersonas Controller
 *
 * @property \Vorien\NPCData\Model\Table\FlawsPersonasTable $FlawsPersonas
 */
class FlawsPersonasController extends AppController
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
        $flawsPersonas = $this->paginate($this->FlawsPersonas);

        $this->set(compact('flawsPersonas'));
        $this->set('_serialize', ['flawsPersonas']);
    }

    /**
     * View method
     *
     * @param string|null $id Flaws Persona id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $flawsPersona = $this->FlawsPersonas->get($id, [
            'contain' => ['Personas', 'Flaws']
        ]);

        $this->set('flawsPersona', $flawsPersona);
        $this->set('_serialize', ['flawsPersona']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $flawsPersona = $this->FlawsPersonas->newEntity();
        if ($this->request->is('post')) {
            $flawsPersona = $this->FlawsPersonas->patchEntity($flawsPersona, $this->request->data);
            if ($this->FlawsPersonas->save($flawsPersona)) {
                $this->Flash->success(__('The flaws persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The flaws persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->FlawsPersonas->Personas->find('list', ['limit' => 200]);
        $flaws = $this->FlawsPersonas->Flaws->find('list', ['limit' => 200]);
        $this->set(compact('flawsPersona', 'personas', 'flaws'));
        $this->set('_serialize', ['flawsPersona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Flaws Persona id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $flawsPersona = $this->FlawsPersonas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flawsPersona = $this->FlawsPersonas->patchEntity($flawsPersona, $this->request->data);
            if ($this->FlawsPersonas->save($flawsPersona)) {
                $this->Flash->success(__('The flaws persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The flaws persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->FlawsPersonas->Personas->find('list', ['limit' => 200]);
        $flaws = $this->FlawsPersonas->Flaws->find('list', ['limit' => 200]);
        $this->set(compact('flawsPersona', 'personas', 'flaws'));
        $this->set('_serialize', ['flawsPersona']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Flaws Persona id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flawsPersona = $this->FlawsPersonas->get($id);
        if ($this->FlawsPersonas->delete($flawsPersona)) {
            $this->Flash->success(__('The flaws persona has been deleted.'));
        } else {
            $this->Flash->error(__('The flaws persona could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
