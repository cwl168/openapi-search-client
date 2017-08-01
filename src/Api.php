<?php

/*
 * This file is part of the boqii openapi search client package.
 * (c) qinjb <qinjb@boqii.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bqrd\OpenApi\Search;

use Liugj\Arch\RestClient;

class Api
{
    /**
     * restClient 
     * 
     * @var mixed
     * @access protected
     */
    protected $restClient = null;

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
    public function __construct(string $baseUri, array $options = array())
    {
        $this->restClient = new RestClient($baseUri, $options);
    }
}
