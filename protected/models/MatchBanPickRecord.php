<?php

/**
 * This is the model class for table "bp_history".
 *
 * The followings are the available columns in table 'bp_history':
 * @property string $id
 * @property string $match_id
 * @property string $steam_match_id
 * @property integer $side
 * @property integer $op
 * @property string $idx
 * @property string $hero_id
 */
class MatchBanPickRecord extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bp_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('side, op', 'numerical', 'integerOnly'=>true),
            array('match_id, idx, hero_id', 'length', 'max'=>10),
            array('steam_match_id', 'length', 'max'=>20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, match_id, steam_match_id, side, op, idx, hero_id', 'safe', 'on'=>'search'),
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
            'match_id' => 'Match',
            'steam_match_id' => 'Steam Match',
            'side' => 'Side',
            'op' => 'Op',
            'idx' => 'Idx',
            'hero_id' => 'Hero',
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
        $criteria->compare('match_id',$this->match_id,true);
        $criteria->compare('steam_match_id',$this->steam_match_id,true);
        $criteria->compare('side',$this->side);
        $criteria->compare('op',$this->op);
        $criteria->compare('idx',$this->idx,true);
        $criteria->compare('hero_id',$this->hero_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MatchBanPickRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
