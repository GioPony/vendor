<?php

namespace Origami\Vendor\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Intro extends Field
{
    /**
     * Render the element value
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _renderValue(AbstractElement $element)
    {
        $html = '
        <style>
            .use-default,
            .origami_vendor_config_intro{
                display: none;
            }

            span::before{
                content: "" !important;
            }
        </style>';

        $html .= '
        <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; padding: 20px;">
            <h1 style="color: #2c3e50; font-size: 28px; margin-bottom: 20px;">Welcome to the Origami Link Module</h1>
            <p style="font-size: 16px; margin-bottom: 15px;">
            The Origami Link module enables seamless synchronization between your Magento catalog and an Origami Marketplace-powered platform. It collects key product data—such as attributes, categories, taxes, titles, images, prices, and stock—and prepares them for mapping and integration within your seller account on the marketplace Back Office.
            </p>

            <h2 style="color: #34495e; font-size: 24px; margin-top: 30px; margin-bottom: 15px;">How It Works</h2>
            <p style="font-size: 16px; margin-bottom: 15px;">Follow these steps to get started:</p>

            <div style="background-color: #ffffff; border: 1px solid #ddd; padding: 20px; border-radius: 8px; margin-top: 20px;">
                <ol style="padding-left: 20px;">
                    <li style="margin-bottom: 10px; font-size: 16px;">
                        <strong>Set the Category ID (Optional)</strong><br>
                        Specify the ID of a Magento category to fetch its related subcategories.
                    </li>
                    <li style="margin-bottom: 10px; font-size: 16px;">
                        <strong>Set the Stock ID (Optional)</strong><br>
                        Define the stock ID you want to sync from Magento.
                    </li>
                    <li style="margin-bottom: 10px; font-size: 16px;">
                        <strong>Generate or Enter a Token</strong><br>
                        Leave the token field blank to automatically generate a unique token, or input your preferred token.
                    </li>
                </ol>
            </div>

            <div style="background-color: #e8f4f8; border-left: 4px solid #3498db; padding: 15px; margin-top: 20px; border-radius: 4px;">
                <p style="margin: 0; font-size: 14px; color: #2c3e50;">
                Once configured, the module will generate an API URL. To finalize the configuration, please go to your Origami Marketplace seller backoffice and configure the feed with this API URL.
                </p>
            </div>
        </div>';

        return $html;
    }
}