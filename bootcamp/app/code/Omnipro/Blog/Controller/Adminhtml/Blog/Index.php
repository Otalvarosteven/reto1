<?php
namespace Omnipro\Blog\Controller\Adminhtml\Blog;
 
class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
 
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Omnipro_Blog::menu');
 
        //Set the header title of grid
        $resultPage->getConfig()->getTitle()->prepend(__('Posts'));
 
       
        return $resultPage;
        //return $this->_redirect('blog');
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Omnipro_Blog::menu');
    }
}