<?php

namespace dektrium\user\models;

use dektrium\user\Finder;
use dektrium\user\Mailer;
use dektrium\user\Module;
use dektrium\user\traits\ModuleTrait;
use Yii;
use yii\base\Model;

/**
 * Model for collecting data on security settings.
 *
 * @author Viktor Bokhan <vikt20@gmail.com>
 */
class SecurityForm extends Model
{
    use ModuleTrait;

    /**
     * @var string
     */
    public $ip_access;

    /**
     * @var string
     */
    public $ip_lock;

    /**
     * @var string
     */
    public $otp_login_enable;

    /**
     * @var Finder
     */
    protected $finder;

    /** @var User */
    private $_user;

    /** @return User */
    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = Yii::$app->user->identity;
        }

        return $this->_user;
    }

    /** @inheritdoc */
    public function __construct(Mailer $mailer, $config = [])
    {
        $this->setAttributes([
            'ip_access' => $this->user->ip_access,
            'ip_lock' => $this->user->ip_lock,
            'otp_login_enable' => $this->user->otp_login_enable
            
        ], false);
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ip_access'    => \Yii::t('user', 'IP адрес'),
            'ip_lock' => \Yii::t('user', 'Включить блокировку по IP (Не влияет на доступ по API)'),
            'otp_login_enable' => \Yii::t('user', 'Включить блокировку OTP (Данные для одноразового пароля находятся в разделе API)'),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //'ipRequired' => ['ip', 'required'],
            'ipPattern' => ['ip_access','match', 'pattern' => '/^[0-9.]+$/'],
            'Switches' => [['ip_lock', 'otp_login_enable'], 'boolean']
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $this->user->ip_access = $this->ip_access;
            $this->user->ip_lock = $this->ip_lock;
            $this->user->otp_login_enable = $this->otp_login_enable;
            return $this->user->save();
        }

        return false;
    }


}
