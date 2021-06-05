<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BankRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BankCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\BankAccount::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bank');
        CRUD::setEntityNameStrings('bank', 'banks');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb();

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BankRequest::class);

        CRUD::setFromDb();

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
