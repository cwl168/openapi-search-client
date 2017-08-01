<?php

/*
 * This file is part of the boqii openapi search client package.
 * (c) qinjb <qinjb@boqii.com> liugj <liugj@boqii.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Bqrd\OpenApi\Search\Product;

use PHPUnit\Framework\TestCase;

class ProductTestCase extends TestCase
{
    /**
     * options.
     *
     * @var mixed
     */
    public $options = [];

    /**
     * url.
     *
     * @var string
     */
    public $url = '';

    /**
     * setUp.
     *
     *
     *
     * @return mixed
     */
    public function setUp()
    {
        $this->options = [
            'access_app_id' => '',
            'access_app_secret' => '',
            'timeout' => 10,
        ];
        $this->url = 'http://openapi-search-local.boqii.com/v3.4/shop/';
    }

    /**
     * testSearch.
     *
     *
     *
     * @return mixed
     */
    public function testGet()
    {
        $params = ['p' => 1, 'ps' => 12, 'q' => '狗粮', 'price' => 1, 'site_source' => 'shop'];
        $response = (new Product($this->url, $this->options))->get($params);
        var_dump($response);
    }

    /**
     * testPut 
     * 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function testPut()
    {
        $product = ['productid' => 12345, 'inventory' => 1200];    
        $response = (new Product($this->url, $this->options))->put($product);
    }
}
