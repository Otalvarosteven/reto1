<?php
namespace Omnipro\Blog\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blog extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('omnipro_blog', 'post_id');
    }
}
