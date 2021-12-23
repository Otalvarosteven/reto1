<?php
namespace Omnipro\Blog\Block\Adminhtml;
 
class Post extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_blog';
        $this->_blockGroup = 'Omnipro_Blog';
        $this->_headerText = __('Posts');
        //$this->_addButtonLabel = __('Create New Post');
        parent::_construct();
        $this->removeButton('add'); // Add this code to remove the button
        $this->removeButton('Search'); // Add this code to remove the button
    }
 
}