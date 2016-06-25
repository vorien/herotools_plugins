<?php
namespace Vorien\NPCData\Controller;

use Vorien\NPCData\Controller\AppController;

use Cake\ORM\TableRegistry;

/**
 * Playerdata Controller
 *
 */
class PlayerdataController extends AppController {

	public function initialize() {
		Parent::initialize();
		$this->viewBuilder()->layout('Vorien/NPCData.player');
	}

	public function testJoin(){
		$join = TableRegistry::get('Vorien/NPCData.ArchetypesPersonas');	
		debug($join);
	}
	
	public function addperson() {
		$person = $people->newEntity();
		if ($this->request->is('post')) {
			$person = $people->patchEntity($person, $this->request->data);
			if ($people->save($person)) {
				$personas = TableRegistry::get('Vorien/NPCData.Personas');
				$persona = $personas->newEntity();
				$persona->person_id = $person->id;
				$persona->agenda_id = 4;
				if ($personas->save($persona)) {
					$this->Flash->success(__('The person has been saved and a persona has been created for players to use.'));
					return $this->redirect(['action' => 'index']);
				} else {
					$this->Flash->error(__('The person was saved, but the persona was not.'));
				}
			} else {
				$this->Flash->error(__('The person could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('person'));
		$this->set('_serialize', ['person']);
	}

	public function index() {
		$personas = TableRegistry::get('Vorien/NPCData.Personas');
		$query = $personas->find();
		$query->select(['id', 'agenda_id', 'person_id', 'profession', 'picture']);
		$query->innerJoinWith('Agendas', function ($q) {
			return $q->select(['id', 'name'])->where(['Agendas.name' => 'Players']);
		});
		$query->contain([ 'People' => function ($q) {
				return $q->select(['id', 'name']);
			}
		]);
		$query->hydrate(false);
		$playerslist = $query->find('all')->toArray();
		$this->set(compact('playerslist'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id Persona id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null) {
		$personas = TableRegistry::get('Vorien/NPCData.Personas');
//		debug($personas->associations());
//		exit;
		$persona = $personas->get($id, [
			'contain' => [
				'People', 
				'Agendas', 
				'Archetypes', 
				'Flaws', 
				'Guilds', 
				'Motivations', 
				'Qualities', 
				'Quirks', 
				'Notes']
		]);
		$personalitiestable = TableRegistry::get('Vorien/NPCData.Personalities');
		$personalities = $personalitiestable->find('all')->select(['name', 'virtue', 'vice'])->order(['sort_order'])->toArray();


		$this->set(compact('persona', 'personalities'));
		$this->set('_serialize', ['persona']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add() {
		$personas = TableRegistry::get('Vorien/NPCData.Personas');
		$persona = $personas->newEntity();
		if ($this->request->is('post')) {
			$persona = $personas->patchEntity($persona, $this->request->data);
			if ($personas->save($persona)) {
				$this->Flash->success(__('The persona has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The persona could not be saved. Please, try again.'));
			}
		}
		$people = $personas->People->find('list');
		$agendas = $personas->Agendas->find('list');
		$archetypes = $personas->Archetypes->find('list');
		$flaws = $personas->Flaws->find('list');
		$guilds = $personas->Guilds->find('list');
		$motivations = $personas->Motivations->find('list');
		$qualities = $personas->Qualities->find('list');
		$quirks = $personas->Quirks->find('list');
		$personalities = TableRegistry::get('Vorien/NPCData.Personalities')->find('all')->select(['name', 'virtue', 'vice'])->order(['sort_order'])->toArray();
		$this->set(compact('persona', 'people', 'agendas', 'archetypes', 'flaws', 'guilds', 'motivations', 'qualities', 'quirks', 'People', 'personalities'));
		$this->set('_serialize', ['persona']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Persona id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null) {
		$personas = TableRegistry::get('Vorien/NPCData.Personas');
		$persona = $personas->get($id, [
			'contain' => ['Archetypes', 'Flaws', 'Guilds', 'Motivations', 'Qualities', 'Quirks', 'People', 'Notes']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$persona = $personas->patchEntity($persona, $this->request->data);
			if ($personas->save($persona)) {
				$this->Flash->success(__('The persona has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The persona could not be saved. Please, try again.'));
			}
		}
		$people = $personas->People->find('list');
		$agendas = $personas->Agendas->find('list');
		$archetypes = $personas->Archetypes->find('list');
		$flaws = $personas->Flaws->find('list');
		$guilds = $personas->Guilds->find('list');
		$motivations = $personas->Motivations->find('list');
		$qualities = $personas->Qualities->find('list');
		$quirks = $personas->Quirks->find('list');
		$notes = $personas->Notes->find('all');
		$personalities = TableRegistry::get('Vorien/NPCData.Personalities')->find('all')->select(['name', 'virtue', 'vice'])->order(['sort_order'])->toArray();
		$newnote = $personas->Notes->newEntity();
		$this->set(compact('persona', 'people', 'agendas', 'archetypes', 'flaws', 'guilds', 'motivations', 'qualities', 'quirks', 'notes', 'personalities', 'newnote'));
		$this->set('_serialize', ['persona']);
		$this->set('action', 'edit');
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Persona id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null) {
		$this->request->allowMethod(['post', 'delete']);
		$personas = TableRegistry::get('Vorien/NPCData.Personas');
		$persona = $personas->get($id);
		if ($personas->delete($persona)) {
			$this->Flash->success(__('The persona has been deleted.'));
		} else {
			$this->Flash->error(__('The persona could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function editnote($id = null) {
		$notes = TableRegistry::get('Vorien/NPCData.Notes');
		$note = $notes->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$note = $notes->patchEntity($note, $this->request->data);
			if ($notes->save($note)) {
				$this->Flash->success(__('The note has been saved.'));
				return $this->redirect(['action' => 'edit', $note->persona_id]);
			} else {
				$this->Flash->error(__('The note could not be saved. Please, try again.'));
			}
		}
	}

    public function addnote()    {
		$notes = TableRegistry::get('Vorien/NPCData.Notes');
        $note = $notes->newEntity();
        if ($this->request->is('post')) {
            $note = $notes->patchEntity($note, $this->request->data);
            if ($notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
				return $this->redirect(['action' => 'edit', $note->persona_id]);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
    }


}
