<?php
namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;

/**
 * Characterprotections Controller
 *
 * @property \Vorien\HeroCombat\Model\Table\CharacterprotectionsTable $Characterprotections
 */
class CharacterprotectionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characterstats', 'Locations', 'Coverings', 'Armors', 'Materials']
        ];
        $characterprotections = $this->paginate($this->Characterprotections);

        $this->set(compact('characterprotections'));
        $this->set('_serialize', ['characterprotections']);
    }

    /**
     * View method
     *
     * @param string|null $id Characterprotection id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $characterprotection = $this->Characterprotections->get($id, [
            'contain' => ['Characterstats', 'Locations', 'Coverings', 'Armors', 'Materials']
        ]);

        $this->set('characterprotection', $characterprotection);
        $this->set('_serialize', ['characterprotection']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $characterprotection = $this->Characterprotections->newEntity();
        if ($this->request->is('post')) {
            $characterprotection = $this->Characterprotections->patchEntity($characterprotection, $this->request->data);
            if ($this->Characterprotections->save($characterprotection)) {
                $this->Flash->success(__('The characterprotection has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterprotection could not be saved. Please, try again.'));
            }
        }
        $characterstats = $this->Characterprotections->Characterstats->find('list', ['limit' => 200]);
        $locations = $this->Characterprotections->Locations->find('list', ['limit' => 200]);
        $coverings = $this->Characterprotections->Coverings->find('list', ['limit' => 200]);
        $armors = $this->Characterprotections->Armors->find('list', ['limit' => 200]);
        $materials = $this->Characterprotections->Materials->find('list', ['limit' => 200]);
        $this->set(compact('characterprotection', 'characterstats', 'locations', 'coverings', 'armors', 'materials'));
        $this->set('_serialize', ['characterprotection']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Characterprotection id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $characterprotection = $this->Characterprotections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $characterprotection = $this->Characterprotections->patchEntity($characterprotection, $this->request->data);
            if ($this->Characterprotections->save($characterprotection)) {
                $this->Flash->success(__('The characterprotection has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characterprotection could not be saved. Please, try again.'));
            }
        }
        $characterstats = $this->Characterprotections->Characterstats->find('list', ['limit' => 200]);
        $locations = $this->Characterprotections->Locations->find('list', ['limit' => 200]);
        $coverings = $this->Characterprotections->Coverings->find('list', ['limit' => 200]);
        $armors = $this->Characterprotections->Armors->find('list', ['limit' => 200]);
        $materials = $this->Characterprotections->Materials->find('list', ['limit' => 200]);
        $this->set(compact('characterprotection', 'characterstats', 'locations', 'coverings', 'armors', 'materials'));
        $this->set('_serialize', ['characterprotection']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Characterprotection id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $characterprotection = $this->Characterprotections->get($id);
        if ($this->Characterprotections->delete($characterprotection)) {
            $this->Flash->success(__('The characterprotection has been deleted.'));
        } else {
            $this->Flash->error(__('The characterprotection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
