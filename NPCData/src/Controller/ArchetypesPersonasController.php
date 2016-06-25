<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * ArchetypesPersonas Controller
 *
 * @property \Vorien\NPCData\Model\Table\ArchetypesPersonasTable $ArchetypesPersonas
 */
class ArchetypesPersonasController extends AppController
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
        $archetypesPersonas = $this->paginate($this->ArchetypesPersonas);

        $this->set(compact('archetypesPersonas'));
        $this->set('_serialize', ['archetypesPersonas']);
    }

    /**
     * View method
     *
     * @param string|null $id Archetypes Persona id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $archetypesPersona = $this->ArchetypesPersonas->get($id, [
            'contain' => ['Personas', 'Archetypes']
        ]);

        $this->set('archetypesPersona', $archetypesPersona);
        $this->set('_serialize', ['archetypesPersona']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $archetypesPersona = $this->ArchetypesPersonas->newEntity();
        if ($this->request->is('post')) {
            $archetypesPersona = $this->ArchetypesPersonas->patchEntity($archetypesPersona, $this->request->data);
            if ($this->ArchetypesPersonas->save($archetypesPersona)) {
                $this->Flash->success(__('The archetypes persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The archetypes persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->ArchetypesPersonas->Personas->find('list', ['limit' => 200]);
        $archetypes = $this->ArchetypesPersonas->Archetypes->find('list', ['limit' => 200]);
        $this->set(compact('archetypesPersona', 'personas', 'archetypes'));
        $this->set('_serialize', ['archetypesPersona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Archetypes Persona id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $archetypesPersona = $this->ArchetypesPersonas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $archetypesPersona = $this->ArchetypesPersonas->patchEntity($archetypesPersona, $this->request->data);
            if ($this->ArchetypesPersonas->save($archetypesPersona)) {
                $this->Flash->success(__('The archetypes persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The archetypes persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->ArchetypesPersonas->Personas->find('list', ['limit' => 200]);
        $archetypes = $this->ArchetypesPersonas->Archetypes->find('list', ['limit' => 200]);
        $this->set(compact('archetypesPersona', 'personas', 'archetypes'));
        $this->set('_serialize', ['archetypesPersona']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Archetypes Persona id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $archetypesPersona = $this->ArchetypesPersonas->get($id);
        if ($this->ArchetypesPersonas->delete($archetypesPersona)) {
            $this->Flash->success(__('The archetypes persona has been deleted.'));
        } else {
            $this->Flash->error(__('The archetypes persona could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
