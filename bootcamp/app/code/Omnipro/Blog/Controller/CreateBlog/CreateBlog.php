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
     * @param \Magento\Authorization\Model\UserContextInterface
     */
    protected $userContext;

    /**
     * @param \Magento\Backend\Block\Template\Context
     */
    private $ContextBackend;

    /**
     * @param \Magento\User\Model\ResourceModel\User\CollectionFactory
     */
    private $userCollectionFactory;

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
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Authorization\Model\UserContextInterface $userContext,
        \Magento\Backend\Block\Template\Context $ContextBackend,
        \Magento\User\Model\ResourceModel\User\CollectionFactory $userCollectionFactory,
        array $data = []
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->blogFactory = $blogFactory;
        $this->blogRepository = $blogRepository;
        $this->request = $request;
        $this->formKey = $formKey;
        $this->userContext = $userContext;
        $this->ContextBackend = $ContextBackend;
        $this->userCollectionFactory = $userCollectionFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */

     /* Key que proviene del formulario del front */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    /* Obtener los usuarios para verificar si es admin */
    public function getUserData($useremail)
    {
        $collection = $this->userCollectionFactory->create();
        $userId =$this->userContext->getUserId();
        $collection->addFieldToSelect('*');
        $userData = $collection->getData();
        $emailsAdmins = [];

        foreach ($userData as $role) {
            if ($role['role_name'] == 'Administrators') {
                $emailsAdmins[] = $role['email'];
            }
        }
        foreach($emailsAdmins as $emails) {
            if ($emails == $useremail) {
                return true;
            }
        }
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

        if ($this->getUserData($useremail)) {
         if ($this->getFormKey() == '1xEr7uTIJaNDtSHt') {
                $this->blogRepository->save($blog);
            }
        #$blog->save();
        }
        return $this->_redirect('blog');
    }
}
