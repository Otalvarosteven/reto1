<?php
namespace Omnipro\UserOpinion\Api;

interface UserOpinionRepositoryInterface
{
    /**
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Omnipro\UserOpinion\Api\Data\SearchResultsInterface
     */
    public function getList($searchCriteria);

    /**
     *
     * @param int $id
     * @return \Omnipro\UserOpinion\Api\Data\UserOpinionInterface
     */
    public function getById($id);

    /**
     *
     * @param \Omnipro\UserOpinion\Api\Data\UserOpinionInterface $userOpinion
     * @return \Omnipro\UserOpinion\Api\Data\UserOpinionInterface
     */
    public function save($userOpinion);

    /**
     *
     * @param \Omnipro\UserOpinion\Api\Data\UserOpinionInterface $userOpinion
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