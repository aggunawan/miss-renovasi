<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvoiceHistoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class InvoiceHistoryCrudController extends CrudController
{
    use CreateOperation;
    use DeleteOperation;
    use ListOperation;
    use ShowOperation;
    use UpdateOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\InvoiceHistory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/invoice-history');
        CRUD::setEntityNameStrings('invoicehistory', 'Invoice Histories');

        $this->crud->denyAccess(['create', 'update', 'edit', 'delete', 'show']);
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            ['name' => 'message', 'label' => __('Event'), 'limit' => 255]
        ]);

        $this->crud->addButtonFromView('line', 'invoice', 'invoice-anchor', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(InvoiceHistoryRequest::class);

        CRUD::field('message');

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
