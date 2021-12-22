<?php
namespace Omnipro\Blog\Block;

use Omnipro\Blog\Controller\CreateBlog;

class Blog extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getFormAction()
    {
            // companymodule is given in routes.xml
            // controller_name is folder name inside controller folder
            // action is php file name inside above controller_name folder

        return $this->getUrl('blog/createblog/createblog');
        // here controller_name is index, action is booking
    }
}
