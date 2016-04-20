<?php

class TestStationChartForm extends YuxiBaseModel
{

	public $type = 'chart';
	public $tm;

	public function rules()
	{
		return array(
			array('type, tm', 'safe'),
		);
	}

	public function validate($attributes = NULL, $clearErrors = true)
	{
		if (empty($this->tm)) {
			$meta = $this->testingTimeMeta;
			$this->tm = array_keys($meta)[0];
		}
		$this->tm = intval($this->tm);
	}

	public function getTestingTimeMeta()
	{
		$sql = 'select distinct testing_time from teststation_operation';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->query();
		$ret = array();
		foreach ($result as $row) {
			$tm = intval($row['testing_time']);
			$dt = floor($tm / 100);
			$hr = $tm % 100;
			$ts = strtotime($dt) + $hr * 3600;
			$ret[$tm] = date('Y-m-d H:i', $ts);
		}
		return $ret;
	}

}

