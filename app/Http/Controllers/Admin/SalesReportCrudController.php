<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SalesReportRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class SalesReportCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\SalesReport::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sales-report');
        CRUD::setEntityNameStrings('sales report', 'sales reports');
        $this->crud->denyAccess(['edit', 'update']);
    }

    protected function setupListOperation()
    {
        CRUD::column('label');
        CRUD::column('start_date');
        CRUD::column('end_date');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SalesReportRequest::class);

        CRUD::field('label');
        CRUD::field('start_date');
        CRUD::field('end_date');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
