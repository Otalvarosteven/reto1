<?php
namespace Omnipro\ModuloCsv\Model;

class Cron
{
    protected $_logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function croncsv(){
        $this->_logger->info('first');
        return $this;
    }
}