<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Coverings Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CoveringsTable $Coverings
 */
class CoveringsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $coverings = $this->paginate($this->Coverings);

        $this->set(compact('coverings'));
        $this->set('_serialize', ['coverings']);
    }

    /**
     * View method
     *
     * @param string|null $id Covering id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $covering = $this->Coverings->get($id, [
            'contain' => ['Characterprotections', 'Coveringlocations']
        ]);

        $this->set('covering', $covering);
        $this->set('_serialize', ['covering']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $covering = $this->Coverings->newEntity();
        if ($this->request->is('post')) {
            $covering = $this->Coverings->patchEntity($covering, $this->request->data);
            if ($this->Coverings->save($covering)) {
                $this->Flash->success(__('The covering has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The covering could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('covering'));
        $this->set('_serialize', ['covering']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Covering id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $covering = $this->Coverings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $covering = $this->Coverings->patchEntity($covering, $this->request->data);
            if ($this->Coverings->save($covering)) {
                $this->Flash->success(__('The covering has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The covering could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('covering'));
        $this->set('_serialize', ['covering']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Covering id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $covering = $this->Coverings->get($id);
        if ($this->Coverings->delete($covering)) {
            $this->Flash->success(__('The covering has been deleted.'));
        } else {
            $this->Flash->error(__('The covering could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
