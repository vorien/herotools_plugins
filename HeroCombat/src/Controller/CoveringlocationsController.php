<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Coveringlocations Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CoveringlocationsTable $Coveringlocations
 */
class CoveringlocationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Coverings', 'Locations']
        ];
        $coveringlocations = $this->paginate($this->Coveringlocations);

        $this->set(compact('coveringlocations'));
        $this->set('_serialize', ['coveringlocations']);
    }

    /**
     * View method
     *
     * @param string|null $id Coveringlocation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coveringlocation = $this->Coveringlocations->get($id, [
            'contain' => ['Coverings', 'Locations']
        ]);

        $this->set('coveringlocation', $coveringlocation);
        $this->set('_serialize', ['coveringlocation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coveringlocation = $this->Coveringlocations->newEntity();
        if ($this->request->is('post')) {
            $coveringlocation = $this->Coveringlocations->patchEntity($coveringlocation, $this->request->data);
            if ($this->Coveringlocations->save($coveringlocation)) {
                $this->Flash->success(__('The coveringlocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The coveringlocation could not be saved. Please, try again.'));
            }
        }
        $coverings = $this->Coveringlocations->Coverings->find('list', ['limit' => 200]);
        $locations = $this->Coveringlocations->Locations->find('list', ['limit' => 200]);
        $this->set(compact('coveringlocation', 'coverings', 'locations'));
        $this->set('_serialize', ['coveringlocation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Coveringlocation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coveringlocation = $this->Coveringlocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coveringlocation = $this->Coveringlocations->patchEntity($coveringlocation, $this->request->data);
            if ($this->Coveringlocations->save($coveringlocation)) {
                $this->Flash->success(__('The coveringlocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The coveringlocation could not be saved. Please, try again.'));
            }
        }
        $coverings = $this->Coveringlocations->Coverings->find('list', ['limit' => 200]);
        $locations = $this->Coveringlocations->Locations->find('list', ['limit' => 200]);
        $this->set(compact('coveringlocation', 'coverings', 'locations'));
        $this->set('_serialize', ['coveringlocation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Coveringlocation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coveringlocation = $this->Coveringlocations->get($id);
        if ($this->Coveringlocations->delete($coveringlocation)) {
            $this->Flash->success(__('The coveringlocation has been deleted.'));
        } else {
            $this->Flash->error(__('The coveringlocation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
