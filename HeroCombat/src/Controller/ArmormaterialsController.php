<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Armormaterials Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\ArmormaterialsTable $Armormaterials
 */
class ArmormaterialsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Armors', 'Materials']
        ];
        $armormaterials = $this->paginate($this->Armormaterials);

        $this->set(compact('armormaterials'));
        $this->set('_serialize', ['armormaterials']);
    }

    /**
     * View method
     *
     * @param string|null $id Armormaterial id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $armormaterial = $this->Armormaterials->get($id, [
            'contain' => ['Armors', 'Materials']
        ]);

        $this->set('armormaterial', $armormaterial);
        $this->set('_serialize', ['armormaterial']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $armormaterial = $this->Armormaterials->newEntity();
        if ($this->request->is('post')) {
            $armormaterial = $this->Armormaterials->patchEntity($armormaterial, $this->request->data);
            if ($this->Armormaterials->save($armormaterial)) {
                $this->Flash->success(__('The armormaterial has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The armormaterial could not be saved. Please, try again.'));
            }
        }
        $armors = $this->Armormaterials->Armors->find('list', ['limit' => 200]);
        $materials = $this->Armormaterials->Materials->find('list', ['limit' => 200]);
        $this->set(compact('armormaterial', 'armors', 'materials'));
        $this->set('_serialize', ['armormaterial']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Armormaterial id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $armormaterial = $this->Armormaterials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $armormaterial = $this->Armormaterials->patchEntity($armormaterial, $this->request->data);
            if ($this->Armormaterials->save($armormaterial)) {
                $this->Flash->success(__('The armormaterial has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The armormaterial could not be saved. Please, try again.'));
            }
        }
        $armors = $this->Armormaterials->Armors->find('list', ['limit' => 200]);
        $materials = $this->Armormaterials->Materials->find('list', ['limit' => 200]);
        $this->set(compact('armormaterial', 'armors', 'materials'));
        $this->set('_serialize', ['armormaterial']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Armormaterial id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $armormaterial = $this->Armormaterials->get($id);
        if ($this->Armormaterials->delete($armormaterial)) {
            $this->Flash->success(__('The armormaterial has been deleted.'));
        } else {
            $this->Flash->error(__('The armormaterial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
