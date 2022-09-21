<?php
namespace app\models;

use Exception;
use Yii;
use yii\base\Model;
use app\models\User;

class RegForm extends Model
{
    public $username;
    public $email;
    public $password_1;
    public $password_2;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username, email, password_1 are required
            [['username', 'email', 'password_1'], 'required'],
            // email must be type Email
            [['email'], 'email'],
            // must be a string value
            [['username', 'email', 'password_1', 'password_2'], 'string'],
        ];
    }

    public function validateData()
    {
        $params = Yii::$app->request->bodyParams['RegForm'];

        if ($params['password_1'] !== $params['password_2']){
            return false;
        }
        if (file_exists('registration_cache')){
            $tmp = json_decode(file_get_contents("registration_cache"));
            User::$users = (array)$tmp;
        }
        $tmp_endId = (array)end(User::$users);
        $endId = $tmp_endId['id'];
        $endId++;

        User::$users[$endId] = [
            'id'=>$endId,
            'username'=>$params['username'],
            'password'=>$params['password_1'],
            'email'=>$params['email'],
            'authKey'=>$params['username'].$endId.'authKey',
        ];

        return true;
    }

    public function create()
    {
        try {
            file_put_contents("registration_cache", json_encode(User::$users));
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

}