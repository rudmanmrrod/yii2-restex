<?php
namespace app\rest\modules\v1;
use app\rest\helpers\CorsHelper;

/**
 * iKargo API V1 Module
 * 
 * @author Budi Irawan <budi@ebizu.com>
 * @since 1.0
 */
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init(); 
		
		CorsHelper::setAllowCors();
    }
}
