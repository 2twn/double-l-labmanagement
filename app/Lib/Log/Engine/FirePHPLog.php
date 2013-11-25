<?php
/**
 * File Storage stream for Logging
 *
 * PHP 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       Cake.Log.Engine
 * @since         CakePHP(tm) v 1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('BaseLog', 'Log/Engine');
App::uses('Hash', 'Utility');
App::uses('CakeNumber', 'Utility');
if(!class_exists('FirePHP')) { 
	App::import('Vendor', 'FirePHP', array('file' => 'FirePHPCore'.DS.'FirePHP.class.php')); 
}
/**
 * File Storage stream for Logging. Writes logs to different files
 * based on the type of log it is.
 *
 * @package       Cake.Log.Engine
 */
class FirePHPLog extends BaseLog {

/**
 * Default configuration values
 *
 * @var array
 * @see FileLog::__construct()
 */
	protected $_defaults = array(
		'maxObjectDepth' => 5,
        'maxArrayDepth' => 5,
        'maxDepth' => 10,
        'useNativeJsonEncode' => true,
        'includeLineNumbers' => true,
		'enabled' => true,
	);

/**
 * @var object
 */
	protected $_firephp = null;

/**
 * Constructs a new File Logger.
 *
 * Config
 *
 * - `types` string or array, levels the engine is interested in
 * - `scopes` string or array, scopes the engine is interested in
 * - `file` Log file name
 * - `path` The path to save logs on.
 * - `size` Used to implement basic log file rotation. If log file size
 *   reaches specified size the existing file is renamed by appending timestamp
 *   to filename and new log file is created. Can be integer bytes value or
 *   human reabable string values like '10MB', '100KB' etc.
 * - `rotate` Log files are rotated specified times before being removed.
 *   If value is 0, old versions are removed rather then rotated.
 * - `mask` A mask is applied when log files are created. Left empty no chmod
 *   is made.
 *
 * @param array $options Options for the FileLog, see above.
 */
	public function __construct($config = array()) {
		$config = Hash::merge($this->_defaults, $config);
		$this->_firephp = FirePHP::getInstance(true);
		$this->_firephp->setEnabled($config['enabled']);
		$this->_firephp->setOptions($config);
		parent::__construct($config);
	}

/**
 * Sets protected properties based on config provided
 *
 * @param array $config Engine configuration
 * @return array
 */
	public function config($config = array()) {
		parent::config($config);

		return $this->_config;
	}

/**
 * Implements writing to log files.
 *
 * @param string $type The type of log you are making.
 * @param string $message The message you want to log.
 * @return boolean success of write.
 */
	public function write($type, $message) {
		$output = date('Y-m-d H:i:s') . ' ' . ucfirst($type) . ': ' . $message . "\n";
		$this->_firephp->log($type, $output);
		return true;
	}
}
