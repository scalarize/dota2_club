<?php

class TestStationOperationDataForm extends YuxiBaseModel
{

	public $tm;

	public function rules()
	{
		return array(
			array('tm', 'numerical'),
		);
	}

	public function getDataProvider()
	{
		$dataProvider = new CActiveDataProvider('TestStationOperationRecord', array(
			'criteria' => array(
				'condition' => 'testing_time = ' . $this->tm,
			),
			'pagination' => false,
		));
		return $dataProvider;
	}

	public function getData()
	{
		$this->validate();
		$data = array();
		foreach ($this->dataProvider->data as $row) {
			if (empty($row->station)) continue;
			$id = intval($row->station->teststation_num);
			if ($id <= 0) continue;
			$data[$id] = $row->attributes;
			$data[$id]['teststation_num'] = $id;
			$data[$id]['high'] = 1.5;
			$data[$id]['low'] = 0.85;
		}
		ksort($data);
		return array_values($data);
	}
}
