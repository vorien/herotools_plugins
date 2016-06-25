<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Professions Controller
 *
 * @property \Vorien\NPCData\Model\Table\ProfessionsTable $Professions
 */
class ProfessionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Guilds']
        ];
        $professions = $this->paginate($this->Professions);

        $this->set(compact('professions'));
        $this->set('_serialize', ['professions']);
    }

    /**
     * View method
     *
     * @param string|null $id Profession id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profession = $this->Professions->get($id, [
            'contain' => ['Guilds']
        ]);

        $this->set('profession', $profession);
        $this->set('_serialize', ['profession']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profession = $this->Professions->newEntity();
        if ($this->request->is('post')) {
            $profession = $this->Professions->patchEntity($profession, $this->request->data);
            if ($this->Professions->save($profession)) {
                $this->Flash->success(__('The profession has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The profession could not be saved. Please, try again.'));
            }
        }
        $guilds = $this->Professions->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('profession', 'guilds'));
        $this->set('_serialize', ['profession']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Profession id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $profession = $this->Professions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profession = $this->Professions->patchEntity($profession, $this->request->data);
            if ($this->Professions->save($profession)) {
                $this->Flash->success(__('The profession has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The profession could not be saved. Please, try again.'));
            }
        }
        $guilds = $this->Professions->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('profession', 'guilds'));
        $this->set('_serialize', ['profession']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Profession id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profession = $this->Professions->get($id);
        if ($this->Professions->delete($profession)) {
            $this->Flash->success(__('The profession has been deleted.'));
        } else {
            $this->Flash->error(__('The profession could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
