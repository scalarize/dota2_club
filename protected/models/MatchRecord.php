<?php

/**
 * This is the model class for table "match_bak".
 *
 * The followings are the available columns in table 'match_bak':
 * @property string $id
 * @property integer $player_id
 * @property integer $win
 * @property string $match_id
 * @property integer $stats
 * @property integer $side
 */
class MatchRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'match_bak';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('player_id, win, stats, side', 'numerical', 'integerOnly'=>true),
			array('match_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, player_id, win, match_id, stats, side', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'player_id' => 'Player',
			'win' => 'Win',
			'match_id' => 'Match',
			'stats' => 'Stats',
			'side' => 'Side',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('player_id',$this->player_id);
		$criteria->compare('win',$this->win);
		$criteria->compare('match_id',$this->match_id,true);
		$criteria->compare('stats',$this->stats);
		$criteria->compare('side',$this->side);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MatchRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
