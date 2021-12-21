<?php
namespace Omnipro\UserOpinion\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class UserOpinion extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('omnipro_useropinion', 'opinion_id');
    }
}
