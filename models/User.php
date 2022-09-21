<?php
namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;
use yii\web\Response;

class User extends BaseObject implements IdentityInterface
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public string $authKey;

    public static array $users = [
        '100' => [
            'id' => 100,
            'username' => 'admin',
            'password' => 'admin',
            'email' => 'test@mail.com',
            'authKey' => 'test100authKey',
        ],
        '101' => [
            'id' => 101,
            'username' => 'demo',
            'password' => 'demo',
            'email' => 'test@mail.com',
            'authKey' => 'test101authKey',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $tmp_arr = [];
        $tmp_usr = [];
        if (file_exists('registration_cache')){
            $tmp_arr = json_decode(file_get_contents('registration_cache'));
            self::$users = (array)$tmp_arr;

            foreach (self::$users as $user){
                $tmp_usr[] = (array)$user;
            }
        }
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static Response|null
     */
    public static function findByUsername(string $username)
    {
        $tmp_usr = [];
        if(file_exists('registration_cache')){
            $tmp_arr = json_decode(file_get_contents('registration_cache'));
            self::$users = (array)$tmp_arr;

            foreach (self::$users as $user){
                $tmp_usr[] = (array)$user;
            }
        }

        foreach ($tmp_usr as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }
}
