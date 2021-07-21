<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReportType;
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
        $this->crud->addColumn([
            'name'  => 'type',
            'type'  => 'model_function',
            'function_name' => 'getType',
        ]);
        $this->crud->addButtonFromView('line', 'excel', 'excel', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SalesReportRequest::class);

        CRUD::field('label');
        CRUD::field('start_date');
        CRUD::field('end_date');

        $this->crud->addField([
            'name' => 'type',
            'type' => 'select2_from_array',
            'options' => [
                ReportType::Monthly => 'Monthly',
                ReportType::Customer => 'Customer',
            ],
            'allows_null' => false,
            'default' => ReportType::Monthly,
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('label');
        CRUD::column('start_date');
        CRUD::column('end_date');
        $this->crud->addColumn([
            'name'  => 'type',
            'type'  => 'model_function',
            'function_name' => 'getType',
        ]);
        $this->crud->addButtonFromView('line', 'excel', 'excel', 'beginning');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
