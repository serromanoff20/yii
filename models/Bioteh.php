<?php
namespace app\models;

use Yii;
use phpDocumentor\Reflection\Types\Self_;
use \yii\base\Model;
use yii\base\Security;
use yii\caching\ArrayCache;
use Exception;

class Bioteh extends BiotehStorage
{
    public function rules(): array
    {
        $rules = [
            [['id', 'generatedInt'], 'integer'],
        ];

        return $rules;
    }

    public function getAllModels():array
    {
        try {
            $result_array = unserialize(file_get_contents("cache_file"));
        } catch (Exception $exception){
            $result_array = $this->storage;
        }
        return $result_array;
    }

    public function getModelById($id):array
    {
        if (file_exists('cache_file')){
            $this->storage = unserialize(file_get_contents("cache_file"));

            if (key_exists($id,$this->storage)){
                $result_array = [
                    'data'=>$this->storage[$id],
                    'message'=>'Успешно!'
                ];
            } else {
                $result_array = [
//                    'data' => $this->storage,
                    'message' => 'Сгенерированного числа с номером id '.$id.' не найдено'
                ];
            }
        } else {
            $result_array = [
//                'data' => $this->storage,
                'message' => 'Необходимо хотя бы один раз сгенерировать число.'
            ];
        }

        return $result_array;
    }

    public function toGenerate()
    {
        try {
            $this->setGeneratedInt(random_int(0, 1000));

            if (file_exists('cache_file')){
                $this->storage = unserialize(file_get_contents("cache_file"));
                $this->setId(end($this->storage)['id']);
                $this->toSave();
            } else {
                $this->setId();
            }
        } catch (Exception $e) {
            return 'Ошибка на уровне модели! '.$e;
        }

        Yii::$app->mailer->compose()->
            setFrom('96termit@gmail.com')->
            setTo('serromanoff2015@ya.ru')->
            setSubject('Тестовое задание')->
            setTextBody(json_encode($this->storage, JSON_UNESCAPED_UNICODE))->
            send();

        return $this->storage;
    }
}