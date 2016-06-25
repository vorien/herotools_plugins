<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

/**
 * PersonasQualities Controller
 *
 * @property \Vorien\NPCData\Model\Table\PersonasQualitiesTable $PersonasQualities
 */
class PersonasQualitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Personas', 'Qualities']
        ];
        $personasQualities = $this->paginate($this->PersonasQualities);

        $this->set(compact('personasQualities'));
        $this->set('_serialize', ['personasQualities']);
    }

    /**
     * View method
     *
     * @param string|null $id Personas Quality id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personasQuality = $this->PersonasQualities->get($id, [
            'contain' => ['Personas', 'Qualities']
        ]);

        $this->set('personasQuality', $personasQuality);
        $this->set('_serialize', ['personasQuality']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personasQuality = $this->PersonasQualities->newEntity();
        if ($this->request->is('post')) {
            $personasQuality = $this->PersonasQualities->patchEntity($personasQuality, $this->request->data);
            if ($this->PersonasQualities->save($personasQuality)) {
                $this->Flash->success(__('The personas quality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas quality could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasQualities->Personas->find('list', ['limit' => 200]);
        $qualities = $this->PersonasQualities->Qualities->find('list', ['limit' => 200]);
        $this->set(compact('personasQuality', 'personas', 'qualities'));
        $this->set('_serialize', ['personasQuality']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personas Quality id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personasQuality = $this->PersonasQualities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personasQuality = $this->PersonasQualities->patchEntity($personasQuality, $this->request->data);
            if ($this->PersonasQualities->save($personasQuality)) {
                $this->Flash->success(__('The personas quality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personas quality could not be saved. Please, try again.'));
            }
        }
        $personas = $this->PersonasQualities->Personas->find('list', ['limit' => 200]);
        $qualities = $this->PersonasQualities->Qualities->find('list', ['limit' => 200]);
        $this->set(compact('personasQuality', 'personas', 'qualities'));
        $this->set('_serialize', ['personasQuality']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personas Quality id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personasQuality = $this->PersonasQualities->get($id);
        if ($this->PersonasQualities->delete($personasQuality)) {
            $this->Flash->success(__('The personas quality has been deleted.'));
        } else {
            $this->Flash->error(__('The personas quality could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
