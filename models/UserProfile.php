<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $cedula
 * @property string $nombre
 * @property string $apellido
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cedula', 'nombre', 'apellido'], 'required'],
	    ['cedula','unique'],
            [['cedula'], 'integer'],
            [['nombre', 'apellido'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cedula' => 'Cedula',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
        ];
    }
}
