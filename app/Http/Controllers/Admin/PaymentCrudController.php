<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PaymentCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        CRUD::setModel(Payment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payment');
        CRUD::setEntityNameStrings('payment', 'payments');

        $this->crud->denyAccess(['create', 'update', 'create', 'delete']);
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'invoice',
                'type' => 'relationship',
                'entity' => 'invoice',
                'attribute' => 'number',
                'model' => App\Models\Invoice::class,
            ],
            [
                'name' => 'code',
                'type' => 'text',
            ]
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            [
                'name' => 'code',
            ],
            [
                'name' => 'invoice.number',
                'type' => 'relationship',
                'label' => __('Invoice Number'),
                'entity'    => 'invoice',
                'attribute' => 'number',
                'model'     => 'App\Models\Invoice',
            ],
            [
                'name' => 'status',
                'type' => 'model_function',
                'label' => __('Status'),
                'function_name' => 'getStatus',
            ],
        ]);

        $this->crud->addButtonFromView('line', 'approve', 'approve-proof', 'beginning');
        $this->crud->addButtonFromView('line', 'decline', 'decline-proof', 'beginning');
        $this->crud->addButtonFromView('line', 'proof', 'proof', 'beginning');
    }
}
