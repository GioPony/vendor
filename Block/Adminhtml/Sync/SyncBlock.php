<?php
namespace Origami\Vendor\Block\Adminhtml\Sync;

use Magento\Backend\Block\Template;

class SyncBlock extends Template
{
    protected function _prepareLayout()
    {
        //$this->_addSyncButton();
        return parent::_prepareLayout();
    }

    protected function _addSyncButton()
    {
        $toolbar = $this->getToolbar();
        $toolbar->addChild(
            'sync_button',
            \Magento\Backend\Block\Widget\Button::class,
            [
                'label' => __('Launch synchronisation'),
                'class' => 'primary',
                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/sync') . '\')'
            ]
        );        
    }
} 