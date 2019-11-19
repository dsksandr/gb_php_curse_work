<?php


namespace app\tests;


use app\models\entities\ProductModel;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @dataProvider providerProduct
     * @param string $name
     */
    public function testProduct($name)
    {
        $product = new ProductModel($name);
        $this->assertEquals($name, $product->name);
    }

    public function providerProduct()
    {
        return [
            ['asdfadf%%^%$'],
            ['123456-=)'],
            ['Стол обеденный Anne'],
            ['Стол обеденный AnneСтол обеденный AnneСтол обеденный AnneСтол обеденный AnneСтол обеденный Anne'],
        ];
    }
}

