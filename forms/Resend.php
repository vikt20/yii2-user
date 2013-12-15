<?php namespace dektrium\user\forms;

use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * Model that manages resending confirmation tokens to users.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Resend extends Model
{
	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var string
	 */
	public $verifyCode;

	/**
	 * @var \dektrium\user\models\User
	 */
	protected $identity;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'email' => \Yii::t('user', 'Email'),
			'verifyCode' => \Yii::t('user', 'Verification Code'),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['email', 'required'],
			['email', 'email'],
			['email', 'exist', 'className' => '\dektrium\user\models\User'],
			['email', 'validateEmail'],
			['verifyCode', 'captcha', 'skipOnEmpty' => !in_array('resend', \Yii::$app->getModule('user')->captcha)]
		];
	}

	/**
	 * Validates if user has already been confirmed or not.
	 */
	public function validateEmail()
	{
		if ($this->identity != null && $this->identity->isConfirmed) {
			$this->addError('email', \Yii::t('user', 'This account has already been confirmed'));
		}
	}

	/**
	 * Resends confirmation message to user.
	 *
	 * @return bool
	 */
	public function resend()
	{
		if ($this->validate()) {
			$this->identity->sendConfirmationMessage();

			return true;
		} else {
			return false;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function beforeValidate()
	{
		if (parent::beforeValidate()) {
			$query = new ActiveQuery(['modelClass' => \Yii::$app->getUser()->identityClass]);
			$this->identity = $query->where(['email' => $this->email])->one();

			return true;
		} else {
			return false;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function formName()
	{
		return 'resend-form';
	}
}