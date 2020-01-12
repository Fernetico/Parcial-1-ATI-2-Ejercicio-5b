<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;

class Soap extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    public function index()
    {
        $this->soapWrapper->add('CurrencyServer', function ($service){
            $service
                ->wsdl('http://fx.currencysystem.com/webservices/CurrencyServer4.asmx?WSDL')
                ->trace(true);
        });

        $data = $this->soapWrapper->call('CurrencyServer.Currencies');

        $response = $data->CurrenciesResult;

        echo $response;
    }
}
