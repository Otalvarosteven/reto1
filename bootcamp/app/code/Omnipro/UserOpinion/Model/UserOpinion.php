<?php
namespace Omnipro\UserOpinion\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Omnipro\UserOpinion\Api\Data\UserOpinionInterface;
use \Omnipro\UserOpinion\Model\ResourceModel\UserOpinion as UserOpinionResorce;

class UserOpinion extends AbstractModel implements IdentityInterface, UserOpinionInterface
{
    const CACHE_TAG = 'omnipro_useropinion_user_opinion';

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
    protected $_eventPrefix = 'user_opinion';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(UserOpinionResorce::class);
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

    public function getOpinionId()
    {
        return $this->getData('opinion_id');
    }

    public function setOpinionId($opinionId)
    {
        $this->setData('opinion_id', $opinionId);
    }

    public function getSku()
    {
        return $this->getData('sku');
    }

    public function setSku($sku)
    {
        $this->setData('sku', $sku);
    }

    public function getUserEmail()
    {
        return $this->getData('user_email');
    }

    public function setUserEmail($userEmail)
    {
        $this->setData('user_email', $userEmail);
    }

    public function getPuntuacion()
    {
        return $this->getData('puntuacion');
    }

    public function setPuntuacion($puntuacion)
    {
        $this->setData('puntuacion', $puntuacion);
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
