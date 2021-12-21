<?php
namespace Omnipro\UserOpinion\Model\ResourceModel\UserOpinion;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Omnipro\UserOpinion\Model\UserOpinion;
use \Omnipro\UserOpinion\Model\ResourceModel\UserOpinion as UserOpinionResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'opinion_id';
    protected $_eventPrefix = 'omnipro_useropinion_user_opinion_collection';
    protected $_eventObject = 'user_opinion_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(UserOpinion::class, UserOpinionResource::class);
    }
}
