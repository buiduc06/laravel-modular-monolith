<?php

namespace UI\Admin\Http\Controllers;

use App\Http\Controllers\Admin\Response;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Exception;
use UI\Admin\Http\Requests\ProductRequest;
use UI\Admin\Models\Category;
use UI\Admin\Models\Product;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     * @throws Exception
     */
    public function setup()
    {
        CRUD::setModel(Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    : void
    {
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('category.name')->type('text');
        CRUD::column('is_active')->type('boolean')->options([0 => 'Active', 1 => 'Inactive']);
        CRUD::column('price');
        CRUD::column('stock');
        CRUD::column('created_at');
        CRUD::column('updated_at');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    : void
    {
        CRUD::setValidation(ProductRequest::class);
        CRUD::field('name');
        CRUD::field('category_id')
            ->label('Category')
            ->type('select')
            ->entity('category')
            ->attribute('name')
            ->model(Category::class);

        CRUD::field('description')
            ->type('textarea');
        CRUD::field('price');
        CRUD::field('stock');
        CRUD::field('is_active');
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    : void
    {
        $this->setupCreateOperation();
    }
}
