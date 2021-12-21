<?php
namespace Omnipro\Blog\Api\Data;

interface SearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     *
     * @return \Omnipro\Blog\Api\Data\BlogInterface[]
     */
    public function getItems();

    /**
     *
     * @param \Omnipro\Blog\Api\Data\BlogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
