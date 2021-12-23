<?php
namespace Omnipro\Blog\ViewModel;

use \Magento\Framework\View\Element\Block\ArgumentInterface;

class BlogViewModel implements ArgumentInterface
{
    /**
     * @param \Omnipro\Blog\Model\ResourceModel\Blog\CollectionFactory
     */
    private $blogCollectionFactory;

    public function __construct(
        \Omnipro\Blog\Model\ResourceModel\Blog\CollectionFactory $blogCollectionFactory
    )
    {
        $this->blogCollectionFactory = $blogCollectionFactory;
    }

    public function getOpinions()
    {
        /**
         * @var \Omnipro\Blog\Model\ResourceModel\Blog\Collection $blogCollection
         */

         $blogCollection = $this->blogCollectionFactory->create();

         $blogCollection->addFieldToSelect('*');
         return $blogCollection->getItems();
    }
}
