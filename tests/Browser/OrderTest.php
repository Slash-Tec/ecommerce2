<?php

namespace Tests\Browser;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\CreateData;

class OrderTest extends DuskTestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use CreateData;

	/** @test */
    public function it_creates_the_order_and_destroys_shopping_cart()
    {
        $product = $this->createProduct();
        $user = $this->createUser();

        $this->browse(function (Browser $browser) use ($product, $user) {
            $browser->loginAs($user->id)
                ->visit('/')
                ->pause(100)
                ->click('h1.text-lg > a')
                ->pause(100)
                ->click('div.flex-1 > button')
                ->pause(100)
                ->click('div.relative > div > span')
                ->pause(100)
                ->click('div.px-3 > a.inline-flex')
                ->assertSee($product->name)
                ->pause(100)
                ->click('a.bg-red-600')
                ->pause(1000)
                ->type('div.bg-white > div.mb-4 > input', 'salva')
                ->pause(100)
                ->type('div.bg-white > div:nth-of-type(2) > input', '45345453454')
                ->pause(100)
                ->press('CONTINUAR CON LA COMPRA')
                ->pause(1000)
                ->assertPathIs('/orders/1/payment')
                ->click('div.relative > div > span')
                ->pause(100)
                ->assertSeeIn('li.py-6', 'No tiene agregado ningún item en el carrito')
                ->screenshot('createsOrder-test');
        });
        $this->assertDatabaseEmpty('shoppingcart');
    }
}