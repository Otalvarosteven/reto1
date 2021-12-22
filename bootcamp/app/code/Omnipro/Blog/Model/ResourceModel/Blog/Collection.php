<?php
namespace Omnipro\Blog\Model\ResourceModel\Blog;

use \Omnipro\Blog\Model\ResourceModel\Blog as BlogResource;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Omnipro\Blog\Model\Blog;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'omnipro_blog_blog_collection';
    protected $_eventObject = 'blog_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Blog::class, BlogResource::class);
    }
}
