<?php

/*
 * This file is part of the boqii openapi search client package.
 * (c) qinjb <qinjb@boqii.com> liugj <liugj@boqii.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bqrd\OpenApi\Search;

use GuzzleHttp\Client as GuzzleHttpClient;

class RestClient
{
    /**
     * baseUri 
     * 
     * @var string
     * @access protected
     */
    protected $baseUri = '';

    /**
     * options 
     * 
     * @var mixed
     * @access protected
     */
    protected $options = [];

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
    public function __construct(string $baseUri, array $options = [])
    {
        $this->baseUri = $baseUri;
        $this->options = $options;
    }

    /**
     * __call 
     * 
     * @param mixed $method 
     * @param mixed $args 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function __call($method, $args)
    {
        $url = $args[0];
        $vars = isset($args[1]) ? $args[1] : [];
        $headers = (isset($args[2]) ? $args[2] : []) + ['User-Agent' => 'arch.client php dev-master'];

        $response = (new GuzzleHttpClient([
            'base_uri' => $this->baseUri,
            'timeout' => $this->options['timeout'] ?? 3.0,
        ]))->request($method, $url, [
            'query' => $this->before($method, $url, $vars),
            'headers' => $headers,
        ]);

        return new Response($response);
    }

    /**
     * getRandStr 
     * 
     * @param int $length 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function getRandStr(int $length)
    {
        $str = null;
        $strPol = '0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++)
        {
            $str .= $strPol[rand(0, $max)]; 
        }

        return $str;
    }

    /**
     * before 
     * 
     * @param string $method 
     * @param string $url 
     * @param mixed $param 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function before(string $method, string $url, $param)
    {
        if (is_string($param)) {
            parse_str($param, $vars);    
        } else {
            $vars = $param;    
        }
        $appId = $this->options['access_app_id'];
        $token = $this->options['access_app_secret'];
        $vars['x-api-proxy-app-id'] = $appId;
        $vars['x-api-proxy-nonce'] = $this->getRandStr(10);
        $vars['x-api-proxy-timestamp'] = microtime(true);
        $parameter = $vars;
        if (($pos = strpos($url, '?')) !== false) {
            parse_str(substr($url, $pos + 1), $newVars);
            $parameter = $parameter + $newVars;
        }

        $vars['Sign'] = \Liugj\Helpers\sign($parameter, $token);

        return $vars;
    }
}
