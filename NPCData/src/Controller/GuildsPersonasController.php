<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * GuildsPersonas Controller
 *
 * @property \Vorien\NPCData\Model\Table\GuildsPersonasTable $GuildsPersonas
 */
class GuildsPersonasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Personas', 'Guilds']
        ];
        $guildsPersonas = $this->paginate($this->GuildsPersonas);

        $this->set(compact('guildsPersonas'));
        $this->set('_serialize', ['guildsPersonas']);
    }

    /**
     * View method
     *
     * @param string|null $id Guilds Persona id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $guildsPersona = $this->GuildsPersonas->get($id, [
            'contain' => ['Personas', 'Guilds']
        ]);

        $this->set('guildsPersona', $guildsPersona);
        $this->set('_serialize', ['guildsPersona']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $guildsPersona = $this->GuildsPersonas->newEntity();
        if ($this->request->is('post')) {
            $guildsPersona = $this->GuildsPersonas->patchEntity($guildsPersona, $this->request->data);
            if ($this->GuildsPersonas->save($guildsPersona)) {
                $this->Flash->success(__('The guilds persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The guilds persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->GuildsPersonas->Personas->find('list', ['limit' => 200]);
        $guilds = $this->GuildsPersonas->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('guildsPersona', 'personas', 'guilds'));
        $this->set('_serialize', ['guildsPersona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Guilds Persona id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $guildsPersona = $this->GuildsPersonas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $guildsPersona = $this->GuildsPersonas->patchEntity($guildsPersona, $this->request->data);
            if ($this->GuildsPersonas->save($guildsPersona)) {
                $this->Flash->success(__('The guilds persona has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The guilds persona could not be saved. Please, try again.'));
            }
        }
        $personas = $this->GuildsPersonas->Personas->find('list', ['limit' => 200]);
        $guilds = $this->GuildsPersonas->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('guildsPersona', 'personas', 'guilds'));
        $this->set('_serialize', ['guildsPersona']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Guilds Persona id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $guildsPersona = $this->GuildsPersonas->get($id);
        if ($this->GuildsPersonas->delete($guildsPersona)) {
            $this->Flash->success(__('The guilds persona has been deleted.'));
        } else {
            $this->Flash->error(__('The guilds persona could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
