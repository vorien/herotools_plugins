<?php
namespace Vorien\HeroCSheet\Controller;

use Vorien\HeroCSheet\Controller\AppController;

/**
 * Charactersheets Controller
 *
 * @property \Vorien\HeroCSheet\Model\Table\CharactersheetsTable $Charactersheets
 */
class CharactersheetsController extends AppController
{

	public function initialize() {
		parent::initialize();
		$this->loadComponent('Vorien/Dashboard.Ownership');
		$this->loadComponent('Vorien/Dashboard.DisplayFunctions');
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characters']
        ];
        $charactersheets = $this->paginate($this->Charactersheets);

        $this->set(compact('charactersheets'));
        $this->set('_serialize', ['charactersheets']);
		$charactersheets = $this->Charactersheets->find('all')->contain(['Characters' => ['Userdata']])->toArray();
		debug($charactersheets);
    }

    /**
     * View method
     *
     * @param string|null $id Charactersheet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $charactersheet = $this->Charactersheets->get($id, [
            'contain' => ['Characters']
        ]);

        $this->set('charactersheet', $charactersheet);
        $this->set('_serialize', ['charactersheet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $charactersheet = $this->Charactersheets->newEntity();
        if ($this->request->is('post')) {
            $charactersheet = $this->Charactersheets->patchEntity($charactersheet, $this->request->data);
            if ($this->Charactersheets->save($charactersheet)) {
                $this->Flash->success(__('The charactersheet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charactersheet could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Charactersheets->Characters->find('list', ['limit' => 200]);
        $this->set(compact('charactersheet', 'characters'));
        $this->set('_serialize', ['charactersheet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Charactersheet id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $charactersheet = $this->Charactersheets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $charactersheet = $this->Charactersheets->patchEntity($charactersheet, $this->request->data);
            if ($this->Charactersheets->save($charactersheet)) {
                $this->Flash->success(__('The charactersheet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charactersheet could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Charactersheets->Characters->find('list', ['limit' => 200]);
        $this->set(compact('charactersheet', 'characters'));
        $this->set('_serialize', ['charactersheet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Charactersheet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $charactersheet = $this->Charactersheets->get($id);
        if ($this->Charactersheets->delete($charactersheet)) {
            $this->Flash->success(__('The charactersheet has been deleted.'));
        } else {
            $this->Flash->error(__('The charactersheet could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
