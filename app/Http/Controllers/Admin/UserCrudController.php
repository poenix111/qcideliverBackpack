<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        /* $this->crud->setFromDb();
        $this->crud->addField('type','both'); */
        $columnas = [
            ['name' => 'email', 'type' => 'email', 'label' => 'Email'],
            'name',
            [
                'name'        => 'tipo', // the name of the db column
                'label'       => 'Tipo', // the input label
                'type'        => 'radio',
                'options'     => [ // the key will be stored in the db, the value will be shown as label; 
                                    0 => "Vendedor",
                                    1 => "Usuario"
                                ],
                // optional
                //'inline'      => false, // show the radios all on the same line?
                            ],
            [
                'name'        => 'estado', // the name of the db column
                'label'       => 'Estado', // the input label
                'type'        => 'radio',
                'options'     => [ // the key will be stored in the db, the value will be shown as label; 
                                    0 => "Activo",
                                    1 => "Inactivo"
                                ],
                // optional
                //'inline'      => false, // show the radios all on the same line?
                            ],
            ['name' => 'password', 'type' => 'password'],
        ];
         $this->crud->addColumn(['name' => 'foto' ,'type' => 'image']);
        $this->crud->addColumns($columnas, 'update/create/both'); //Agregue las columnas al mostrar
       
        
       $this->crud->addFields($columnas, 'both');
       $this->crud->addField(['name' => 'foto' ,'type' => 'text']);
        $this->crud->enableExportButtons();
        $this->crud->enableDetailsRow();
        $this->crud->allowAccess('details_row');
        
        // add asterisk for fields that are required in UserRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
     
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

   public function showDetailsRow($id)
    {
        $this->crud->hasAccessOrFail('details_row');

        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::details_row', $this->data);
    }
}
