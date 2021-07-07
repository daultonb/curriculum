<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OptionalPriorityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;

use App\Models\Optional_priorities;
/**
 * Class OptionalPriorityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OptionalPriorityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Optional_priorities::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/optional-priority');
        CRUD::setEntityNameStrings('optional priority', 'optional priorities');
        $this->crud->enableDetailsRow();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'op_id', // The db column name
            'label' => "OptionalPriority Id",// Table column heading
            'type' => 'Text',
           ]);

        $this->crud->addColumn([
            'name' => 'cat_name', // The db column name
            'label' => "Category Name",// Table column heading
            'type' => 'Text'
         ]);

      /* $this->crud->addColumn([
        'name' => 'cat_desc', // The db column name
        'label' => "Category desc",// Table column heading
         'type' => 'Text'
       ]);*/

       $this->crud->addColumn([
        'name' => 'subcat_name', // The db column name
        'label' => "Subcategory Name",// Table column heading
        'type' => 'Text'
       ]);

       $this->crud->addColumn([
        'name' => 'subcat_desc', // The db column name
        'label' => "Subcategory desc",// Table column heading
        'type' => 'Text'
       ]);

       $this->crud->addColumn([
        'name' => 'optional_priority', // The db column name
        'label' => "Optional Priority",// Table column heading
        'type' => 'Text'
       ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OptionalPriorityRequest::class);
        $this->crud->addColumn([
            'name' => 'op_id', // The db column name
            'label' => "OptionalPriority Id",// Table column heading
            'type' => 'number',
            'default' => '1'
           ]);
        $this->crud->addColumn([
            'name' => 'cat_name', // The db column name
            'label' => "Category Name",// Table column heading
            'type' => 'Text'
           ]);

        /* $this->crud->addColumn([
        'name' => 'cat_desc', // The db column name
        'label' => "Category desc",// Table column heading
         'type' => 'Text'
       ]);*/

        $this->crud->addColumn([
            'name' => 'subcat_id', // The db column name
            'label' => "subcat id",// Table column heading
            'type' => 'Text'
         ]);

        $this->crud->addColumn([
            'name' => 'subcat_name', // The db column name
            'label' => "Subcategory Name",// Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'subcat_desc', // The db column name
            'label' => "Subcategory desc",// Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'optional_priority', // The db column name
            'label' => "Optional Priority",// Table column heading
            'type' => 'Text'
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

}
