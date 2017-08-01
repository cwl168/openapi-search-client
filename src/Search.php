<?php

/*
 * This file is part of the boqii openapi search client package.
 * (c) qinjb <qinjb@boqii.com> liugj <liugj@boqii.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bqrd\OpenApi\Search;

use Liugj\Arch\Index;

class Search
{
    /**
     * index 
     * 
     * @var mixed
     * @access protected
     */
    protected $index = null;

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
        $this->index = new Index($baseUri, $options);    
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
    public function get(array $params, array $headers = [])
    {
        return $this->index->get($params, $headers);
    }
}
