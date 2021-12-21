<?php
namespace Omnipro\Blog\Api\Data;

interface BlogInterface
{
    /**
     * Return Opinion Id
     * @return int
     */
    public function getPostId();

    /**
     * Set an Opinion Id
     * @param int $opinionId
     * @return void
     */
    public function setPostId($postId);

    /**
     * Get the Opinion Sku
     * @return string
     */
    public function getImageUrl();
    
    /**
     * Set the product sku
     * @param string $sku
     * @return void
     */
    public function setImageUrl($imageUrl);

    /**
     *
     * @return string
     */
    public function getUserEmail();

    /**
     *
     * @param string $userEmail
     * @return void
     */
    public function setUserEmail($userEmail);

    /**
     *
     * @return string
     */
    public function getOpinion();

    /**
     *
     * @param string $opinion
     * @return void
     */
    public function setOpinion($opinion);

    /**
     *
     * @return string
     */
    public function getTitle();

    /**
     *
     * @param string $opinion
     * @return void
     */
    public function setTitle($title);
}

