<?php
/**
 * @package silverstripe-metadata
 */
class MetadataSelectFieldOption extends DataObject {

	private static $db = array(
		'Key'   => 'Varchar(100)',
		'Value' => 'Varchar(255)',
		'Sort'	=> 'Int',
	);

	private static $has_one = array(
		'Parent' => 'MetadataSelectField'
	);

	private static $summary_fields = array(
		'Key',
		'Value'
	);

	/**
	 * @return string
	 */
	public function getKey() {
		return ($key = $this->getField('Key')) ? $key : $this->Value;
	}

	public function validate() {
		$result = parent::validate();

		if (!$this->Value) {
			$result->error('Each select option must have a value.');
		}

		return $result;
	}

	public function singular_name() {
		return 'Option';
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName('ParentID');
		return $fields;
	}

}