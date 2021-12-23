<?php
namespace Omnipro\Blog\Controller\CreateBlog;

class CreateBlog extends \Magento\Framework\App\Action\Action
{
    protected $request;

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
     * @param \Omnipro\Blog\Api\BlogRepositoryInterface
     */
    private $blogRepository;

    /**
     * @param \Magento\Framework\Data\Form\FormKey
     */
    private $formKey;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Omnipro\Blog\Model\BlogFactory $blogFactory,
        \Omnipro\Blog\Api\BlogRepositoryInterface $blogRepository,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Data\Form\FormKey $formKey
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->blogFactory = $blogFactory;
        $this->blogRepository = $blogRepository;
        $this->request = $request;
        $this->formKey = $formKey;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function getFormKey(){
        return $this->formKey->getFormKey();
    }
    public function execute()
    {
        $title = $this->request->getParam('title');
        $opinion = $this->request->getParam('content');
        $useremail = $this->request->getParam('email');
        $image = $this->request->getParam('image');
        $key = $this->getFormKey();

        $json = $this->jsonFactory->create();
        $blog = $this->blogFactory->create();

        // $blog->setUserEmail($useremail);
        // $blog->setImageUrl("link");
        // $blog->setTitle($title);
        // $blog->setOpinion($opinion);
        $blog->setData([
            'title' => $title,
            'opinion' => $opinion ,
            'user_email' => $useremail,
            'image_url' => '\d\f\dfj.jpg',
        ]);

       
        if ($this->getFormKey() == '1xEr7uTIJaNDtSHt') {
                $this->blogRepository->save($blog);
            }
        #$blog->save();

        return $this->_redirect('blog');
    }
}
