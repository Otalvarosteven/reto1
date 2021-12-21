<?php
namespace Omnipro\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Omnipro\Blog\Api\Data\BlogInterface;

class BlogRepository implements \Omnipro\Blog\Api\BlogRepositoryInterface
{

    /**
     * @param \Omnipro\Blog\Model\ResourceModel\Blog
     */
    private $blogResource;

    /**
     * @param \Omnipro\Blog\Model\ResourceModel\Blog\CollectionFactory
     */
    private $blogCollectionFactory;

    /**
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \Omnipro\Blog\Api\Data\SearchResultsInterfaceFactory
     */
    private $searchResultsInterfaceFactory;

    /**
     * @param \Omnipro\Blog\Model\BlogFactory
     */
    private $blogFactory;

    public function __construct(
        \Omnipro\Blog\Model\ResourceModel\Blog $blogResource,
        \Omnipro\Blog\Model\ResourceModel\Blog\CollectionFactory $blogCollectionFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Omnipro\Blog\Api\Data\SearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        \Omnipro\Blog\Model\BlogFactory $blogFactory
    ) {
        $this->blog = $blogResource;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
        $this->blogFactory = $blogFactory;

    }

    public function getList($searchCriteria)
    {
        $collection = $this->blogCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function getById($id)
    {
        $blog = $this->blogFactory->create();
        $this->blogResource->load($blog, $id);
        if (!$blog->getOpinionId()) {
            throw new NoSuchEntityException(__("The blog opinion doesn't exists"));
        }

        return $blog;
    }

    /**
     *
     * @param blog $blog
     * @return BlogInterface
     * @throws CouldNotSaveException
     */
    public function save($blog)
    {
        try {
            $this->blogResource->save($blog);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }

    /**
     *
     * @param blog $blog
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete($blog)
    {
        try {
            $this->blogResource->delete($blog);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
