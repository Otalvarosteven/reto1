<?php
namespace Omnipro\Blog\Api\Data;

interface SearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     *
     * @return \Omnipro\Blog\Api\Data\UserOpinionInterface[]
     */
    public function getItems();

    /**
     *
     * @param \Omnipro\Blog\Api\Data\UserOpinionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
