<?php
namespace Omnipro\Blog\Model;

use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractModel;
use \Omnipro\Blog\Api\Data\BlogInterface;
use \Omnipro\Blog\Model\ResourceModel\Blog as BlogResorce;

class Blog extends AbstractModel implements IdentityInterface, BlogInterface
{
    const CACHE_TAG = 'omnipro_blog_blog';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'blog';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BlogResorce::class);
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getPostId()
    {
        return $this->getData('post_id');
    }

    public function setPostId($postId)
    {
        $this->setData('post_id', $postId);
    }

    public function getImageUrl()
    {
        return $this->getData('image_url');
    }

    public function setImageUrl($imageUrl)
    {
        $this->setData('image_url', $imageUrl);
    }

    public function getUserEmail()
    {
        return $this->getData('user_email');
    }

    public function setUserEmail($userEmail)
    {
        $this->setData('user_email', $userEmail);
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function setTitle($title)
    {
        $this->setData('title', $title);
    }

    public function getOpinion()
    {
        return $this->getData('opinion');
    }

    public function setOpinion($opinion)
    {
        $this->setData('opinion', $opinion);
    }
}
