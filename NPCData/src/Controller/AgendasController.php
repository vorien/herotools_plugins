<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Agendas Controller
 *
 * @property \Vorien\NPCData\Model\Table\AgendasTable $Agendas
 */
class AgendasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $agendas = $this->paginate($this->Agendas);

        $this->set(compact('agendas'));
        $this->set('_serialize', ['agendas']);
    }

    /**
     * View method
     *
     * @param string|null $id Agenda id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $agenda = $this->Agendas->get($id, [
            'contain' => ['Personas']
        ]);

        $this->set('agenda', $agenda);
        $this->set('_serialize', ['agenda']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $agenda = $this->Agendas->newEntity();
        if ($this->request->is('post')) {
            $agenda = $this->Agendas->patchEntity($agenda, $this->request->data);
            if ($this->Agendas->save($agenda)) {
                $this->Flash->success(__('The agenda has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The agenda could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('agenda'));
        $this->set('_serialize', ['agenda']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Agenda id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $agenda = $this->Agendas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $agenda = $this->Agendas->patchEntity($agenda, $this->request->data);
            if ($this->Agendas->save($agenda)) {
                $this->Flash->success(__('The agenda has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The agenda could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('agenda'));
        $this->set('_serialize', ['agenda']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Agenda id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $agenda = $this->Agendas->get($id);
        if ($this->Agendas->delete($agenda)) {
            $this->Flash->success(__('The agenda has been deleted.'));
        } else {
            $this->Flash->error(__('The agenda could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
