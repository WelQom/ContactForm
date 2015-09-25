<?php
namespace Craft;

class ContactFormPlugin extends BasePlugin
{
	function getName()
	{
		return Craft::t('Contact Form');
	}

	function getVersion()
	{
		return '1.4';
	}

	function getDeveloper()
	{
		return 'Pixel & Tonic';
	}

	function getDeveloperUrl()
	{
		return 'http://pixelandtonic.com';
	}

	protected function defineSettings()
	{
		return array(
			'toEmail'          => array(AttributeType::String, 'required' => true),
			'prependSender'    => AttributeType::String,
			'prependSubject'   => AttributeType::String,
			'allowAttachments' => AttributeType::Bool,
			'honeypotField'    => AttributeType::String,
		);
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('contactform/_settings', array(
			'settings' => $this->getSettings()
		));
	}

	public function setSettings($values)
	{
		if (!$values)
		{
			$values = array();
		}

		if (is_array($values))
		{
			// Merge in any values that are stored in craft/config/contactform.php
			foreach (array('toEmail', 'prependSender', 'prependSubject', 'allowAttachments', 'honeypotField') as $key)
			{
				$configValue = craft()->config->get($key, 'contactform');

				if ($configValue !== null)
				{
					$values[$key] = $configValue;
				}
			}
		}

		parent::setSettings($values);
	}
}
