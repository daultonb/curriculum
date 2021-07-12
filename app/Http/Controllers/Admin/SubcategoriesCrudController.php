<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubcategoriesRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;

use App\Models\OptionalPrioritySubcategories;
/**
 * Class SubcategoriesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubcategoriesCrudController extends CrudController
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
        CRUD::setModel(\App\Models\OptionalPrioritySubcategories::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/subcategories');
        CRUD::setEntityNameStrings('subcategories', 'subcategories');
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
            'name' => 'subcat_id',
            'label'=>"Subcategory ID",
            'type' =>'number'
        ]);

        $this->crud->addColumn([
            'name' => 'subcat_name',
            'label'=>"Subcategory Name",
            'type' =>'Text'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SubcategoriesRequest::class);
        $subid = \DB::table('optional_priority_subcategories')->count();
        
        $this->crud->addField([
            'name'=>'subcat_id',
            'label'=>'Subcategory ID',
            'type' => 'number',
            'default' =>$subid+1,
        ]);

        $this->crud->addField([
            'name'=>'subcat_name',
            'label'=>'Subcategory Name',
            'type'=>'Text',
        ]);

        $this->crud->addField([
            'name'=>'subcat_desc',
            'label'=>'Subcategory Desc',
            'type'=>'Text',
        ]);

        $this->crud->addField([
            'name'=>'cat_id',
            'label'=>'Category ID',
            'type'=>'number',
            'default'=>'1',
        ]);

        $this->crud->addField([
            'name'=>'subcat_postamble',
            'label'=>'Subcategory Postamble',
            'type'=>'Text',
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {

        $this->crud->addField([
            'name'=>'subcat_name',
            'label'=>'Subcategory Name',
            'type'=>'Text',
        ]);

        $this->crud->addField([
            'name'=>'subcat_desc',
            'label'=>'Subcategory Desc',
            'type'=>'Text',
        ]);


        $this->crud->addField([
            'name'=>'subcat_postamble',
            'label'=>'Subcategory Postamble',
            'type'=>'Text',
        ]);

    }
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumn([
            'name' => 'subcat_id',
            'label'=>"Subcategory ID",
            'type' =>'number'
        ]);
        $this->crud->addColumn([
            'name' => 'subcat_name',
            'label'=>"Subcategory Name",
            'type' =>'Text'
        ]);
        $this->crud->addColumn([
            'name' => 'subcat_desc',
            'label'=>"Subcategory Desc",
            'type' =>'Text'
        ]);
        $this->crud->addColumn([
            'name' => 'subcat_postamble',
            'label'=>"Subcategory Postamble",
            'type' =>'Text'
        ]);

    }
}
