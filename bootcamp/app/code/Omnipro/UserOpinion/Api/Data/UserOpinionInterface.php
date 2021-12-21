<?php
namespace Omnipro\UserOpinion\Api\Data;

interface UserOpinionInterface
{
    /**
     * Return Opinion Id
     * @return int
     */
    public function getOpinionId();

    /**
     * Set an Opinion Id
     * @param int $opinionId
     * @return void
     */
    public function setOpinionId($opinionId);

    /**
     * Get the Opinion Sku
     * @return string
     */
    public function getSku();
    
    /**
     * Set the product sku
     * @param string $sku
     * @return void
     */
    public function setSku($sku);

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
     * @return float
     */
    public function getPuntuacion();

    /**
     *
     * @param float $puntuacion
     * @return void
     */
    public function setPuntuacion($puntuacion);

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
}
