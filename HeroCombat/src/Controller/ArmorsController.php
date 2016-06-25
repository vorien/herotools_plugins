<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Armors Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\ArmorsTable $Armors
 */
class ArmorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $armors = $this->paginate($this->Armors);

        $this->set(compact('armors'));
        $this->set('_serialize', ['armors']);
    }

    /**
     * View method
     *
     * @param string|null $id Armor id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $armor = $this->Armors->get($id, [
            'contain' => ['Armormaterials', 'Characterprotections']
        ]);

        $this->set('armor', $armor);
        $this->set('_serialize', ['armor']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $armor = $this->Armors->newEntity();
        if ($this->request->is('post')) {
            $armor = $this->Armors->patchEntity($armor, $this->request->data);
            if ($this->Armors->save($armor)) {
                $this->Flash->success(__('The armor has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The armor could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('armor'));
        $this->set('_serialize', ['armor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Armor id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $armor = $this->Armors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $armor = $this->Armors->patchEntity($armor, $this->request->data);
            if ($this->Armors->save($armor)) {
                $this->Flash->success(__('The armor has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The armor could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('armor'));
        $this->set('_serialize', ['armor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Armor id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $armor = $this->Armors->get($id);
        if ($this->Armors->delete($armor)) {
            $this->Flash->success(__('The armor has been deleted.'));
        } else {
            $this->Flash->error(__('The armor could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
