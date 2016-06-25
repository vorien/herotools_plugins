<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Allguilds Controller
 *
 * @property \Vorien\NPCData\Model\Table\AllguildsTable $Allguilds
 */
class AllguildsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $allguilds = $this->paginate($this->Allguilds);

        $this->set(compact('allguilds'));
        $this->set('_serialize', ['allguilds']);
    }

    /**
     * View method
     *
     * @param string|null $id Allguild id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allguild = $this->Allguilds->get($id, [
            'contain' => []
        ]);

        $this->set('allguild', $allguild);
        $this->set('_serialize', ['allguild']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allguild = $this->Allguilds->newEntity();
        if ($this->request->is('post')) {
            $allguild = $this->Allguilds->patchEntity($allguild, $this->request->data);
            if ($this->Allguilds->save($allguild)) {
                $this->Flash->success(__('The allguild has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allguild could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allguild'));
        $this->set('_serialize', ['allguild']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Allguild id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $allguild = $this->Allguilds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allguild = $this->Allguilds->patchEntity($allguild, $this->request->data);
            if ($this->Allguilds->save($allguild)) {
                $this->Flash->success(__('The allguild has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allguild could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allguild'));
        $this->set('_serialize', ['allguild']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Allguild id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allguild = $this->Allguilds->get($id);
        if ($this->Allguilds->delete($allguild)) {
            $this->Flash->success(__('The allguild has been deleted.'));
        } else {
            $this->Flash->error(__('The allguild could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
