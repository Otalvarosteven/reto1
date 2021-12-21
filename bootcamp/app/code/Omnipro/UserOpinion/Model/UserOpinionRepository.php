<?php
namespace Omnipro\UserOpinion\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Omnipro\UserOpinion\Api\Data\UserOpinionInterface;

class UserOpinionRepository implements \Omnipro\UserOpinion\Api\UserOpinionRepositoryInterface
{
    /**
     * @param \Omnipro\UserOpinion\Model\UserOpinionFactory
     */
    private $userOpinionFactory;

    /**
     * @param \Omnipro\UserOpinion\Model\ResourceModel\UserOpinion
     */
    private $userOpinionResource;

    /**
     * @param \Omnipro\UserOpinion\Model\ResourceModel\UserOpinion\CollectionFactory
     */
    private $userOpinionCollectionFactory;

    /**
     * @param \Omnipro\UserOpinion\Api\Data\SearchResultsInterfaceFactory
     */
    private $searchResultsInterfaceFactory;

    /**
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        \Omnipro\UserOpinion\Model\UserOpinionFactory $userOpinionFactory,
        \Omnipro\UserOpinion\Model\ResourceModel\UserOpinion $userOpinionResource,
        \Omnipro\UserOpinion\Model\ResourceModel\UserOpinion\CollectionFactory $userOpinionCollectionFactory,
        \Omnipro\UserOpinion\Api\Data\SearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    ) {
        $this->userOpinionFactory = $userOpinionFactory;
        $this->userOpinionResource = $userOpinionResource;
        $this->userOpinionCollectionFactory = $userOpinionCollectionFactory;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function getList($searchCriteria)
    {
        $collection = $this->userOpinionCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function getById($id)
    {
        $userOpinion = $this->userOpinionFactory->create();
        $this->userOpinionResource->load($userOpinion, $id);
        if (!$userOpinion->getOpinionId()) {
            throw new NoSuchEntityException(__("The user opinion doesn't exists"));
        }

        return $userOpinion;
    }

    /**
     *
     * @param UserOpinion $userOpinion
     * @return UserOpinionInterface
     * @throws CouldNotSaveException
     */
    public function save($userOpinion)
    {
        try {
            $this->userOpinionResource->save($userOpinion);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }

    /**
     *
     * @param UserOpinion $userOpinion
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete($userOpinion)
    {
        try {
            $this->userOpinionResource->delete($userOpinion);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}