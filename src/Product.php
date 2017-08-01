<?php

/*
 * This file is part of the boqii openapi search client package.
 * (c) qinjb <qinjb@boqii.com> liugj <liugj@boqii.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bqrd\OpenApi\Search;

class Product extends Api
{
    /**
     * __construct 
     * 
     * @param string $baseUri 
     * @param array $options 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function __construct(string $baseUri, array $options)
    {
        parent::__construct($baseUri, $options);    
    }


    /**
     * get 
     * 
     * @param array $params 
     * @param array $headers 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function get(array $param, array $headers = [])
    {
         $query = array_intersect_key($param, array_flip([
                   'q', 'p', 'ps', 's', 'price', 'site_source', 'brandid', 'cateid', 'coupon',
                   'isstock', 'ifpromotion', 'isglobal', 'attrid', 'source', 'range',
                  ])
        );
        $query['highlight'] = 'pname';
        $query['facets'] = 'brandid,c3,p';
        $query['format'] = 'json';

        $response = $this->restClient->get('product/search', $query, $headers)->toArray();
        $fields = [
             'product' => [
                 'id' => 'id', 'pname' => 'pname', 'subtitle' => 'subtitle',
                 'sales' => 'sales',  'commentnum' => 'commentnum',
                 'stock' => 'inventory', 'upstatus' => 'upstatus', 'newcast' => 'newcast',
                 'isglobal' => 'isglobal', 'is_replace' => 'is_replace',
                 'globalstorage' => 'globalstorage', 'globalcity' => 'globalcity',
              ],
              'brand' => ['id' => 'brandid', 'brandname' => 'brandname'],
              'product_category' => ['cid' => 'cid'],
              'photo' => ['pid' => 'pid', 'picpath' => 'picpath'],
        ];
        $response['list'] = array_map(function ($product) use ($fields) {
            $value = [];
            foreach ($fields as $key => $columns) {
                foreach ($columns as $keyCol => $column) {
                    $value[$key][$keyCol] = $key == 'product' ?
                         ($product[$column] ?? '') : ($product[$keyCol][$column] ?? '');
                }
            }

            return $value;
        }, $response['list']);

        return $response;
    }

    /**
     * put 
     * 
     * @param mixed $product 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function put($product, array $headers = [])
    {
        return $this->restClient->put('product', $product, $headers)->toArray();
    }
}