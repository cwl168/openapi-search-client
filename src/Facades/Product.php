<?php

/*
 * This file is part of the boqii openapi search client package.
 * (c) qinjb <qinjb@boqii.com> liugj <liugj@boqii.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bqrd\OpenApi\Search\Facades;

use Bqrd\OpenApi\Search\Product as OpenApiProduct;
use Illuminate\Support\Facades\Facade;

class Product extends Facade
{
    /**
     * getFacadeAccessor.
     *
     * @static
     *
     * @return mixed
     */
    public static function getFacadeAccessor()
    {
        return OpenApiProduct::class;
    }
}
