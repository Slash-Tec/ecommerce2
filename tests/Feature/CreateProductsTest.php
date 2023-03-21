<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\CreateProduct;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\CreateData;

class CreateProductsTest extends TestCase
{

    use RefreshDatabase;
    use CreateData;
    use DatabaseMigrations;

    //Corresponde al paso 1 \/
    /** @test */
    public function it_creates_a_product()
    {
        $category = $this->createCategory();
        $subcategory = $this->createCustomSubcategory($category->id,'celulares');
        $brand = $category->brands()->create(['name' => 'LG']);

        Livewire::test(CreateProduct::class)
            ->set('category_id', $category->id)
            ->set('name', 'algo')
            ->set('slug', 'algo')
            ->set('subcategory_id',$subcategory->id)
            ->set('brand_id', $brand->id)
            ->set('description','dsdsajdoasdj',)
            ->set('price', '118.99',)
            ->set('quantity', '20',)
            ->call('save')
            ->assertRedirect('admin/products/1/edit');
        $this->assertEquals(1,Product::count());
        $this->assertDatabaseHas('products', ['name' => 'algo', 'slug' => 'algo',
            'subcategory_id' =>$subcategory->id, 'brand_id' =>$brand->id,
            'description' => 'dsdsajdoasdj',
            'price' => '118.99', 'quantity' => 20]);
    }

    /** @test */
    public function the_category_id_is_required()
    {
        $category = $this->createCategory();
        $subcategory = $this->createCustomSubcategory($category->id,'celulares');
        $brand = $category->brands()->create(['name' => 'LG']);

        Livewire::test(CreateProduct::class)
            ->set('category_id', '')
            ->set('name', 'algo')
            ->set('slug', 'algo')
            ->set('subcategory_id',$subcategory->id)
            ->set('brand_id', $brand->id)
            ->set('description','dsdsajdoasdj',)
            ->set('price', '118.99',)
            ->set('quantity', '20',)
            ->call('save')
            ->assertHasErrors(['category_id']);
        $this->assertDatabaseEmpty('products');
    }
    //Corresponde al cierre del paso 1 /\
}