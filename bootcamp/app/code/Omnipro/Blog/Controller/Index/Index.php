<?php
namespace Omnipro\Blog\Controller\Index;

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
     * @param \Omnipro\Blog\Model\BlogFactory
     */
    private $blogFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Omnipro\Blog\Model\BlogFactory $blogFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->blogFactory = $blogFactory;
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
         * @var \Omnipro\Blog\Model\Blog $blog
         */
        $blog = $this->blogFactory->create();
        
        $blog->setUserEmail('kevin@omni.pro');
        $blog->setImageUrl("link");
        $blog->setTitle("Televisor");
        $blog->setOpinion('Excelente');

        //$this->BlogRepository->save($blog);

        $blog->save();

        $json->setData([
            'success' => true,
            'userBlogOpinion' => $blog->toArray()
        ]);

        return $json;
    }
}
