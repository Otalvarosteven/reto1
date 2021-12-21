<?php
namespace Omnipro\UserOpinion\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonFactory;

    /**
     * @param \Omnipro\UserOpinion\Api\Data\UserOpinionInterfaceFactory
     */
    private $userOpinionFactory;

    /**
     * @param \Omnipro\UserOpinion\Api\UserOpinionRepositoryInterface
     */
    private $userOpinionRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Omnipro\UserOpinion\Api\Data\UserOpinionInterfaceFactory $userOpinionFactory,
        \Omnipro\UserOpinion\Api\UserOpinionRepositoryInterface $userOpinionRepository
    ) {
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->userOpinionFactory = $userOpinionFactory;
        $this->userOpinionRepository = $userOpinionRepository;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $json = $this->jsonFactory->create();

        /**
         * @var \Omnipro\UserOpinion\Model\UserOpinion $userOpinion
         */
        $userOpinion = $this->userOpinionFactory->create();
        
        $userOpinion->setSku('abc12345');
        $userOpinion->setUserEmail('kevin@omni.pro');
        $userOpinion->setPuntuacion(8);
        $userOpinion->setOpinion('Excelente');

        $this->userOpinionRepository->save($userOpinion);

        $json->setData([
            'success' => true,
            'userOpinion' => $userOpinion->toArray()
        ]);
        return $json;
    }
}
