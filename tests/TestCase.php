<?php

namespace Tests;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;
//Debería servir para poder usar la base de datos para test
abstract class TestCase extends BaseTestCase
{
    protected $defaultData;
    use CreatesApplication;

}
