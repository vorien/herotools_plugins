<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * PersonasGuilds Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonasGuildsTable $PersonasGuilds
 */
class PersonasGuildsController extends AppController
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
        $personasGuilds = $this->paginate($this->PersonasGuilds);

        $this->set(compact('personasGuilds'));
        $this->set('_serialize', ['personasGuilds']);
    }

    /**
     * View method
     *
     * @param string|null $id Personas Guild id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personasGuild = $this->PersonasGuilds->get($id, [
            'contain' => ['Personas', 'Guilds']
        ]);

        $this->set('personasGuild', $personasGuild);
        $this->set('_serialize', ['personasGuild']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personasGuild = $this->PersonasGuilds->newEntity();
        if ($this->request->is('post')) {
            $personasGuild = $this->PersonasGuilds->patchEntity($personasGuild, $this->request->data);
            if ($this->PersonasGuilds->save($personasGuild)) {
                $this->Flash->success(__('The personas guild has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas guild could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasGuilds->Personas->find('list', ['limit' => 200]);
        $guilds = $this->PersonasGuilds->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('personasGuild', 'personas', 'guilds'));
        $this->set('_serialize', ['personasGuild']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personas Guild id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personasGuild = $this->PersonasGuilds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personasGuild = $this->PersonasGuilds->patchEntity($personasGuild, $this->request->data);
            if ($this->PersonasGuilds->save($personasGuild)) {
                $this->Flash->success(__('The personas guild has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas guild could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasGuilds->Personas->find('list', ['limit' => 200]);
        $guilds = $this->PersonasGuilds->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('personasGuild', 'personas', 'guilds'));
        $this->set('_serialize', ['personasGuild']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personas Guild id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personasGuild = $this->PersonasGuilds->get($id);
        if ($this->PersonasGuilds->delete($personasGuild)) {
            $this->Flash->success(__('The personas guild has been deleted.'));
        } else {
            $this->Flash->error(__('The personas guild could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
