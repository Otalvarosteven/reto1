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
     * @return \Omnipro\Blog\Api\Data\UserOpinionInterface
     */
    public function getById($id);

    /**
     *
     * @param \Omnipro\Blog\Api\Data\UserOpinionInterface $userOpinion
     * @return \Omnipro\Blog\Api\Data\UserOpinionInterface
     */
    public function save($userOpinion);

    /**
     *
     * @param \Omnipro\Blog\Api\Data\UserOpinionInterface $userOpinion
     * @return bool
     */
    public function delete($userOpinion);

    /**
     *
     * @param int $id
     * @return bool
     */
    public function deleteById($id);
}
