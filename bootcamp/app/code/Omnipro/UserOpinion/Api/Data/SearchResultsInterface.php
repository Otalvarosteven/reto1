<?php
namespace Omnipro\UserOpinion\Api\Data;

interface SearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     *
     * @return \Omnipro\UserOpinion\Api\Data\UserOpinionInterface[]
     */
    public function getItems();

    /**
     *
     * @param \Omnipro\UserOpinion\Api\Data\UserOpinionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}