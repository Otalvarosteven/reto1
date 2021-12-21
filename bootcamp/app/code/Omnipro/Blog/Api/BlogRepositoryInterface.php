<?php
namespace Omnipro\Blog\Api;

interface BlogRepositoryInterface
{
    /**
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Omnipro\Blog\Api\Data\SearchResultsInterface
     */
    public function getList($searchCriteria);

    /**
     *
     * @param int $id
     * @return \Omnipro\Blog\Api\Data\BlogInterface
     */
    public function getById($id);

    /**
     *
     * @param \Omnipro\Blog\Api\Data\BlogInterface $blog
     * @return \Omnipro\Blog\Api\Data\BlogInterface
     */
    public function save($blog);

    /**
     *
     * @param \Omnipro\Blog\Api\Data\BlogInterface $blog
     * @return bool
     */
    public function delete($blog);

    /**
     *
     * @param int $id
     * @return bool
     */
    public function deleteById($id);
}
