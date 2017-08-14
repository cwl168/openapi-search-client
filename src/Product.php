<?php

/*
 * This file is part of the boqii openapi search client package.
 *
 * (c) qinjb <qinjb@boqii.com> liugj <liugj@boqii.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bqrd\OpenApi\Search;

class Product extends Api
{
    /**
     * __construct.
     *
     * @param string $baseUri
     * @param array  $options
     *
     * @return mixed
     */
    public function __construct(string $baseUri, array $options)
    {
        parent::__construct($baseUri, $options);
    }

    /**
     * get.
     *
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     */
    public function get(array $param, array $headers = [])
    {
        $query = array_intersect_key($param, array_flip([
                   'q', 'p', 'ps', 's', 'price', 'site_source', 'brandid', 'cateid', 'coupon',
                   'isstock', 'ifpromotion', 'isglobal', 'attrid', 'source', 'range',
                   'productid', //测试使用
                  ]));
        $query['highlight'] = 'pname';
        $query['facets'] = 'brandid,c3,p';

        $response = $this->restClient->get('product/search', $query, $headers)->toArray();
        $fields = [
             'product' => [
                 'productid' => 'id', 'pname' => 'pname', 'subtitle' => 'subtitle',
                 'sales' => 'sales',  'commentnum' => 'commentnum', 'cast'=>'cast', 'newcast'=>'newcast',
                 'inventory' => 'stock', 'upstatus' => 'upstatus', 'price' => 'price',
                 'isglobal' => 'isglobal', 'is_replace' => 'is_replace',
                 'globalstorage' => 'globalstorage', 'globalcity' => 'globalcity',
              ],
              'brand' => ['brandid' => 'brandid', 'brandname' => 'brandname'],
              'product_category' => ['cid' => 'cid'],
              'photo' => ['pid' => 'pid', 'picpath' => 'picpath'],
        ];
        $response['list'] = array_map(function ($product) use ($fields) {
            $value = [];
            foreach ($fields as $key => $columns) {
                if ($key == 'product') {
                    foreach ($columns as $from => $to) {
                        $value[$key][$to] = $product[$from];
                    }
                } else {
                    foreach ($columns as $from => $to) {
                        $value[$key][$to] = $product[$key][$from];
                    }
                }
            }

            return $value;
        }, $response['list']);

        return $response;
    }

    /**
     * put.
     *
     * @param mixed $product
     *
     * @return mixed
     */
    public function put($product, array $headers = [])
    {
        return $this->restClient->put('product', $product, $headers)->toArray();
    }
}
