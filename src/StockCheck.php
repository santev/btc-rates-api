<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Symfony\Contracts\HttpClient\HttpClientInterface;


/**
 * Description of StockCheck
 *
 * @author den
 */
class StockCheck {
    
    private $stock;
    private $endpoint;
    
    public function __construct(HttpClientInterface $stock, string $stockApiKey) {
        
    }
    
}
