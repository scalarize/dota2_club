<?php

/**
 * This is the model class for table "player_steam_profile".
 *
 * The followings are the available columns in table 'player_steam_profile':
 * @property string $steam_id
 * @property string $personaname
 * @property string $lastlogoff
 * @property string $avatar
 * @property string $avatarmedium
 * @property string $avatarfull
 */
class PlayerSteamProfileRecord extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'player_steam_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('steam_id', 'required'),
            array('steam_id', 'length', 'max'=>20),
            array('personaname, lastlogoff, avatar, avatarmedium, avatarfull', 'length', 'max'=>1024),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('steam_id, personaname, lastlogoff, avatar, avatarmedium, avatarfull', 'safe', 'on'=>'search'),
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
            'steam_id' => 'Steam',
            'personaname' => 'Personaname',
            'lastlogoff' => 'Lastlogoff',
            'avatar' => 'Avatar',
            'avatarmedium' => 'Avatarmedium',
            'avatarfull' => 'Avatarfull',
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

        $criteria->compare('steam_id',$this->steam_id,true);
        $criteria->compare('personaname',$this->personaname,true);
        $criteria->compare('lastlogoff',$this->lastlogoff,true);
        $criteria->compare('avatar',$this->avatar,true);
        $criteria->compare('avatarmedium',$this->avatarmedium,true);
        $criteria->compare('avatarfull',$this->avatarfull,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PlayerSteamProfileRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
