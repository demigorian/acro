<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctel".
 *
 * @property integer $client_id
 * @property string $name
 * @property string $phone
 * @property integer $id_client
 *
 * @property Client $idClient
 */
class Ctel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required',],
            [['id_client','phone'], 'integer'],
            
            [['name'], 'string', 'max' => 100],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'id_client' => 'Id Client',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(Client::className(), ['client_id' => 'id_client']);
    }
}
