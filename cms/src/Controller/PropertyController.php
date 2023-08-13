<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Property Controller
 *
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $property = $this->paginate($this->Property);

        $this->set(compact('property'));
    }

    /**
     * View method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $property = $this->Property->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('property'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $property = $this->Property->newEmptyEntity();
        if ($this->request->is('post')) {
            $property = $this->Property->patchEntity($property, $this->request->getData());
            if ($this->Property->save($property)) {
                $this->Flash->success(__('The property has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property could not be saved. Please, try again.'));
        }
        $this->set(compact('property'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $property = $this->Property->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $property = $this->Property->patchEntity($property, $this->request->getData());
            if ($this->Property->save($property)) {
                $this->Flash->success(__('The property has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property could not be saved. Please, try again.'));
        }
        $this->set(compact('property'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $property = $this->Property->get($id);
        if ($this->Property->delete($property)) {
            $this->Flash->success(__('The property has been deleted.'));
        } else {
            $this->Flash->error(__('The property could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Search method
     */
    public function search(){
        
        $propertiesTable = TableRegistry::getTableLocator()->get('Properties');
        $locationOptions = $propertiesTable->find('list', [
            'keyField' => 'location',
            'valueField' => 'location'
        ])->distinct('location')->toArray();

        $bedroomOptions = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'];
        $bathroomOptions = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'];

        $conditions = [];

        $location = $this->request->getData('location');
        $priceMin = $this->request->getData('price_min');
        $priceMax = $this->request->getData('price_max');
        $bedrooms = $this->request->getData('bedrooms');
        $bathrooms = $this->request->getData('bathrooms');

        if (!empty($location)) {
            $conditions['location LIKE'] = '%' . $location . '%';
        }
        if (!empty($priceMin)) {
            $conditions['price >='] = $priceMin;
        }
        if (!empty($priceMax)) {
            $conditions['price <='] = $priceMax;
        }
        if (!empty($bedrooms)) {
            $conditions['bedrooms'] = $bedrooms;
        }
        if (!empty($bathrooms)) {
            $conditions['bathrooms'] = $bathrooms;
        }

        $properties = $propertiesTable->find('all', [
            'conditions' => $conditions,
        ]);

        $this->set('properties', $properties);
        $this->set('locationOptions', $locationOptions);
        $this->set('bedroomOptions', $bedroomOptions);
        $this->set('bathroomOptions', $bathroomOptions);
        $this->set('searchCriteria', [
            'location' => $location,
            'price_min' => $priceMin,
            'price_max' => $priceMax,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
        ]);

        $this->set('noMatch', $properties->isEmpty());
    }
}
