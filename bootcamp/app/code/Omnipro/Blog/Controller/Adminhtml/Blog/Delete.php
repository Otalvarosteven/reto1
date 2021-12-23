<?php
namespace Omnipro\Blog\Controller\Adminhtml\Blog;
 
class Delete extends \Magento\Backend\App\Action
{
    /** * @var \Webkul\Grid\Model\GridFactory  */
    
    public $postFactory;
 
    /**
     * @param \Omnipro\Blog\Api\BlogRepositoryInterface
     */
    private $blogRepository;
 
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Webkul\Grid\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Omnipro\Blog\Model\BlogFactory $blogFactory,
        \Omnipro\Blog\Api\BlogRepositoryInterface $blogRepository
    ) {
        parent::__construct($context);
        $this->postFactory = $blogFactory;
        $this->blogRepository = $blogRepository;
    }
 
    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('blogmenu/blog');
            return;
        }
        try {
 
            $values = array_values($data);
            $ids_to_delete = $values[1];
            
            for ($i=0; count($ids_to_delete)!=0; $i++) {
                $id = array_pop($ids_to_delete);
                $this->blogRepository->deleteById($id);
            }
 
            $ids_to_delete = $values[1];
            $ids_message = implode(",", $ids_to_delete);
            
            $message = "Post/s with ID={$ids_message} has been successfully deleted.";
            $this->messageManager->addSuccess(__($message));
 
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('blogmenu/blog');
    }
 
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Omnipro_Blog::delete');
    }
}