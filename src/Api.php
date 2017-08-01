<?php
/*
 * This file is part of the boqii openapi shop client package.
 *
 * (c) liugj <liugj@boqii.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Bqrd\OpenApi\Search;

use Liugj\Arch\RestClient;

class Api
{
    /**
     * restClient.
     *
     * @var mixed
     */
    protected $restClient = null;
    /**
     * __construct.
     *
     * @param string $baseUri
     * @param array  $options
     *
     * @return mixed
     */
    public function __construct(string $baseUri, array $options = [])
    {
        $this->restClient = new RestClient($baseUri, $options);
    }
}
