<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// You MUST use your component name (without com_) for the helper file name

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
class HelloWorldHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */
 
	public static function addSubmenu($submenu) 
	{
		// change the submenu
		// change some css properties (for displaying icons)
		// change the browser title if the submenu is categories
		// change the title and add a preferences button

		JHtmlSidebar::addEntry(
			JText::_('COM_HELLOWORLD_SUBMENU_MESSAGES'),
			'index.php?option=com_helloworld',
			$submenu == 'helloworlds'
		);
 
		JHtmlSidebar::addEntry(
			JText::_('COM_HELLOWORLD_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_helloworld',
			$submenu == 'categories'
		);
 
		// Set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-helloworld ' . '{background-image: url(../media/com_helloworld/images/tux-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION_CATEGORIES'));
		}
	}

	/**
	 * Get the actions
	 */
	public static function getActions($messageId = 0)
	{	
		$result	= new JObject;
 
		if (empty($messageId)) {
			$assetName = 'com_helloworld';
		}
		else {
			$assetName = 'com_helloworld.message.'.(int) $messageId;
		}
 
		$actions = JAccess::getActions('com_helloworld', 'component');
 
		foreach ($actions as $action) {
			$result->set($action->name, JFactory::getUser()->authorise($action->name, $assetName));
		}
 
		return $result;
	}
}
?>