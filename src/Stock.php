<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of Stock
 *
 * @author den
 */
class Stock {

    private $stock;
    private $endpoint;

    public function __construct(HttpClientInterface $stockApi) {
        $this->stock = $stockApi;
    }

    public function getKeyInfo(): array {
        #for terminal test: curl -H "X-CMC_PRO_API_KEY: b03cacc44-28a1-4f2c-8507-daceb38989a6" -H "Accept: application/json" -G https://pro-api.coinmarketcap.com/v1/key/info

        $response = $this->stock->request(
                'GET',
                '/v1/key/info',
        );

        $status_code = $response->getStatusCode();
        if (200 !== $status_code) {
            // handle the HTTP request error (e.g. retry the request)
            $content = [
                'error_code' => $status_code,
                'error_message' => 'Stock request error.',
            ];
        } else {
            $content = $response->getContent(); // returns the raw content returned by the server (JSON in this case)
            $content = $response->toArray(); // transforms the response JSON content into a PHP array
        }
        return $content;
    }

    public function getQuotes() {
        $response = $this->stock->request(
                'GET',
                '/v1/cryptocurrency/quotes/latest',
                [
                    'query' => [
                        'id' => '2781,2790,2787', //USD,EUR,CNY
                        'convert' => 'BTC'
                    ]
                ]
        );

        $status_code = $response->getStatusCode();
        if (200 !== $status_code) {
            // handle the HTTP request error (e.g. retry the request)
            $content = [
                'error_code' => $status_code,
                'error_message' => 'Stock request error.',
            ];
        } else {
            $content = $response->getContent(); // returns the raw content returned by the server (JSON in this case)
            $content = $response->toArray(); // transforms the response JSON content into a PHP array
        }
        return $content;
    }

}
