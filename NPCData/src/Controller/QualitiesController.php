<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * Qualities Controller
 *
 * @property \Vorien\NPCData\Model\Table\QualitiesTable $Qualities
 */
class QualitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $qualities = $this->paginate($this->Qualities);

        $this->set(compact('qualities'));
        $this->set('_serialize', ['qualities']);
    }

    /**
     * View method
     *
     * @param string|null $id Quality id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $quality = $this->Qualities->get($id, [
            'contain' => ['Personas']
        ]);

        $this->set('quality', $quality);
        $this->set('_serialize', ['quality']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quality = $this->Qualities->newEntity();
        if ($this->request->is('post')) {
            $quality = $this->Qualities->patchEntity($quality, $this->request->data);
            if ($this->Qualities->save($quality)) {
                $this->Flash->success(__('The quality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The quality could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Qualities->Personas->find('list', ['limit' => 200]);
        $this->set(compact('quality', 'personas'));
        $this->set('_serialize', ['quality']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Quality id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quality = $this->Qualities->get($id, [
            'contain' => ['Personas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quality = $this->Qualities->patchEntity($quality, $this->request->data);
            if ($this->Qualities->save($quality)) {
                $this->Flash->success(__('The quality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The quality could not be saved. Please, try again.'));
            }
        }
        $personas = $this->Qualities->Personas->find('list', ['limit' => 200]);
        $this->set(compact('quality', 'personas'));
        $this->set('_serialize', ['quality']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Quality id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quality = $this->Qualities->get($id);
        if ($this->Qualities->delete($quality)) {
            $this->Flash->success(__('The quality has been deleted.'));
        } else {
            $this->Flash->error(__('The quality could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
