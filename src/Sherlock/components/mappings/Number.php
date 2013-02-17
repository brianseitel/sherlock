<?php
/**
 * User: Zachary Tong
 * Date: 2/16/13
 * Time: 10:23 PM
 */

namespace sherlock\components\mappings;

use sherlock\components;
use sherlock\common\exceptions;


/**
 * @method \sherlock\components\mappings\Number field() field(\string $value)
 * @method \sherlock\components\mappings\Number store() store(\string $value)
 * @method \sherlock\components\mappings\Number index() index(\string $value)
 * @method \sherlock\components\mappings\Number index_name() index_name(\string $value)
 * @method \sherlock\components\mappings\Number boost() boost(\float $value)
 * @method \sherlock\components\mappings\Number null_value() null_value(\string $value)
 * @method \sherlock\components\mappings\Number type() type(\string $value)
 * @method \sherlock\components\mappings\Number precision_step() precision_step(\int $value)
 * @method \sherlock\components\mappings\Number include_in_all() include_in_all(\string $value)
 * @method \sherlock\components\mappings\Number ignore_malformed() ignore_malformed(\bool $value)
 */
class Number extends \sherlock\components\BaseComponent implements \sherlock\components\MappingInterface
{
	protected $type;

	public function __construct($type = null, $hashMap = null)
	{
		//if $type is set, we need to wrap the mapping property in a type
		//this is used for multi-mappings on index creation
		if (isset($type))
		{
			$this->type = $type;
		}

		parent::__construct($hashMap);
	}

	public function toArray()
	{
		$ret = array();
		foreach($this->params as $key => $value)
		{
			if($key == 'field')
				continue;

			$ret[$key] = $value;
		}

		if (!isset($this->params['field']))
			throw new \sherlock\common\exceptions\RuntimeException("Field name must be set for Number mapping");

		if (!isset($this->params['type']))
			throw new \sherlock\common\exceptions\RuntimeException("Field type must be set for Number mapping");

		$ret = array($this->params['field'] => $ret);

		if (isset($this->type))
			$ret = array($this->type => array("properties" => $ret));


		return $ret;

	}


}

?>