<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Personas Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonasTable $Personas
 */
class PersonasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['People', 'Agendas']
        ];
        $personas = $this->paginate($this->Personas);

        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }

    /**
     * View method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $persona = $this->Personas->get($id, [
            'contain' => ['People', 'Agendas', 'Archetypes', 'Flaws', 'Guilds', 'Motivations', 'Qualities', 'Quirks', 'Notes']
        ]);

        $this->set('persona', $persona);
        $this->set('_serialize', ['persona']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $persona = $this->Personas->newEntity();
        if ($this->request->is('post')) {
            $persona = $this->Personas->patchEntity($persona, $this->request->data);
            if ($this->Personas->save($persona)) {
                $this->Flash->success(__('The persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The persona could not be saved. Please, try again.'));
            }
        }
        $people = $this->Personas->People->find('list', ['limit' => 200]);
        $agendas = $this->Personas->Agendas->find('list', ['limit' => 200]);
        $archetypes = $this->Personas->Archetypes->find('list', ['limit' => 200]);
        $flaws = $this->Personas->Flaws->find('list', ['limit' => 200]);
        $guilds = $this->Personas->Guilds->find('list', ['limit' => 200]);
        $motivations = $this->Personas->Motivations->find('list', ['limit' => 200]);
        $qualities = $this->Personas->Qualities->find('list', ['limit' => 200]);
        $quirks = $this->Personas->Quirks->find('list', ['limit' => 200]);
        $this->set(compact('persona', 'people', 'agendas', 'archetypes', 'flaws', 'guilds', 'motivations', 'qualities', 'quirks'));
        $this->set('_serialize', ['persona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $persona = $this->Personas->get($id, [
            'contain' => ['Archetypes', 'Flaws', 'Guilds', 'Motivations', 'Qualities', 'Quirks']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $persona = $this->Personas->patchEntity($persona, $this->request->data);
            if ($this->Personas->save($persona)) {
                $this->Flash->success(__('The persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The persona could not be saved. Please, try again.'));
            }
        }
        $people = $this->Personas->People->find('list', ['limit' => 200]);
        $agendas = $this->Personas->Agendas->find('list', ['limit' => 200]);
        $archetypes = $this->Personas->Archetypes->find('list', ['limit' => 200]);
        $flaws = $this->Personas->Flaws->find('list', ['limit' => 200]);
        $guilds = $this->Personas->Guilds->find('list', ['limit' => 200]);
        $motivations = $this->Personas->Motivations->find('list', ['limit' => 200]);
        $qualities = $this->Personas->Qualities->find('list', ['limit' => 200]);
        $quirks = $this->Personas->Quirks->find('list', ['limit' => 200]);
        $this->set(compact('persona', 'people', 'agendas', 'archetypes', 'flaws', 'guilds', 'motivations', 'qualities', 'quirks'));
        $this->set('_serialize', ['persona']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $persona = $this->Personas->get($id);
        if ($this->Personas->delete($persona)) {
            $this->Flash->success(__('The persona has been deleted.'));
        } else {
            $this->Flash->error(__('The persona could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
