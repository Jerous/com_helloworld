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
	/**
	 * @var string message
	 */
	protected $message;
  
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

	/**
	 * Get the message
	 *
	 * @param   integer  $id  Greeting Id
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function getMsg($id = 1)
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}

		if (!isset($this->message[$id]))
		{
			// $this->message = 'Hello World!';

      $jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');
 
			// switch ($id)
			// {
      //   // index.php?option=com_helloworld&view=helloworld&id=2
			// 	case 2:
			// 		$this->message = 'Good bye World!';
			// 		break;
			// 	default:
      //   // index.php?option=com_helloworld&view=helloworld&id=1
			// 	case 1:
			// 		$this->message = 'Hello World!';
			// 		break;
			// }

			// Get a TableHelloWorld instance
			$table = $this->getTable();
 
			// Load the message
			$table->load($id);
 
			// Assign the message
			$this->messages[$id] = $table->greeting;
		}
 
		return $this->message[$id];
	}
}
?>