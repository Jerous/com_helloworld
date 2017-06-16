<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class HelloWorldModelHelloWorld extends JModelItem
{
	// /**
	//  * @var string message
	//  */
	// protected $message;

	/**
	 * @var object item
	 */
	protected $item;
 
	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	2.5
	 */
	protected function populateState()
	{
		// Get the message id
		$jinput = JFactory::getApplication()->input;
		$id     = $jinput->get('id', 1, 'INT');
		$this->setState('message.id', $id);
 
		// Load the parameters.
		$this->setState('params', JFactory::getApplication()->getParams());
		parent::populateState();
	}
  
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	// /**
	//  * Get the message
	//  *
	//  * @param   integer  $id  Greeting Id
	//  *
	//  * @return  string        Fetched String from Table for relevant Id
	//  */
	// public function getMsg($id = 1)
	// {
	// 	if (!is_array($this->messages))
	// 	{
	// 		$this->messages = array();
	// 	}

	// 	if (!isset($this->message[$id]))
	// 	{
	// 		// $this->message = 'Hello World!';

  //     $jinput = JFactory::getApplication()->input;
	// 		$id     = $jinput->get('id', 1, 'INT');
 
	// 		// switch ($id)
	// 		// {
  //     //   // index.php?option=com_helloworld&view=helloworld&id=2
	// 		// 	case 2:
	// 		// 		$this->message = 'Good bye World!';
	// 		// 		break;
	// 		// 	default:
  //     //   // index.php?option=com_helloworld&view=helloworld&id=1
	// 		// 	case 1:
	// 		// 		$this->message = 'Hello World!';
	// 		// 		break;
	// 		// }

	// 		// Get a TableHelloWorld instance
	// 		$table = $this->getTable();
 
	// 		// Load the message
	// 		$table->load($id);
 
	// 		// Assign the message
	// 		$this->messages[$id] = $table->greeting;
	// 	}
 
	// 	return $this->messages[$id];
	// }

	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
	public function getItem()
	{
		if (!isset($this->item)) 
		{
			$id    = $this->getState('message.id');
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('h.greeting, h.params, c.title as category')
				  ->from('#__helloworld as h')
				  ->leftJoin('#__categories as c ON h.catid=c.id')
				  ->where('h.id=' . (int)$id);
			$db->setQuery((string)$query);
 
			if ($this->item = $db->loadObject()) 
			{
				// Load the JSON string
				$params = new JRegistry;
				$params->loadString($this->item->params, 'JSON');
				$this->item->params = $params;
 
				// Merge global params with item params
				$params = clone $this->getState('params');
				$params->merge($this->item->params);
				$this->item->params = $params;
			}
		}
		return $this->item;
	}
}
?>