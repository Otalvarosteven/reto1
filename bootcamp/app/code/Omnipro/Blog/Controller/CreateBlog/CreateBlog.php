<?php
namespace Omnipro\Blog\Controller\CreateBlog;

use Magento\Framework\App\Filesystem\DirectoryList;

class CreateBlog extends \Magento\Framework\App\Action\Action
{
    protected $request;


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
     * @param \Magento\MediaStorage\Model\File\UploaderFactory
     */
    private $uploaderFactory;

    /**
     * @param \Magento\Framework\Image\AdapterFactory
     */
    private $adapterFactory;

    /**
     * @param \Magento\Framework\Filesystem
     */
    private $filesystem;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Omnipro\Blog\Model\BlogFactory $blogFactory,
        \Omnipro\Blog\Api\BlogRepositoryInterface $blogRepository,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Authorization\Model\UserContextInterface $userContext,
        \Magento\Backend\Block\Template\Context $ContextBackend,
        \Magento\User\Model\ResourceModel\User\CollectionFactory $userCollectionFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        array $data = []
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->blogFactory = $blogFactory;
        $this->blogRepository = $blogRepository;
        $this->request = $request;
        $this->formKey = $formKey;
        $this->userContext = $userContext;
        $this->ContextBackend = $ContextBackend;
        $this->userCollectionFactory = $userCollectionFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
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

        // $uploaderFactory = $this->uploaderFactory->create(['fileId' => $image]);
        // $uploaderFactory->setAllowedExtensions(['jpg', 'jpg', 'png']);
        // $imageAdapter = $this->adapterFactory->create();
        // /* start of validated image */
        // $uploaderFactory->addValidateCallback('custom_image_upload', $imageAdapter, 'validateUploadFile');
        // $uploaderFactory->setAllowRenameFiles(true);
        // $uploaderFactory->setFilesDispersion(true);
        // $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
        // $destinationPath = $mediaDirectory->getAbsolutePath('custom_image');
        // $result = $uploaderFactory->save($destinationPath);
        // $imagepath = $result['file'];

        

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
            'image_url' => 'https://via.placeholder.com/100x100.png',
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
