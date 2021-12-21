<?php
namespace Omnipro\RickAndMorty\ViewModel;

class RickAndMortyViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    const RICK_AND_MORTY_API = "https://rickandmortyapi.com/api/character";

    private $curl; 

    public function __construct( \Magento\Framework\HTTP\Client\Curl $curl)
    {
        $this->_curl = $curl;
    }

    public function sayHello() {
        return 'Hello';
    }

    public function getCharacters() {
        $this->_curl->get(self::RICK_AND_MORTY_API);
        $body = $this->_curl->getBody();
        return json_decode($body, true);
    }
}
