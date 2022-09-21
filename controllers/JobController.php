<?php
namespace app\controllers;

use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use app\models\Bioteh;
use yii\web\Response;

class JobController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ],
        ];

        return $behaviors;
    }

    public function actionGenerate()
    {
        if (Yii::$app->request->isGet){
            return (new Bioteh())->toGenerate();
        }
        return 'Ошибка на уровне контроллера!';
    }

    public function actionRetrieveAll()
    {
        if (Yii::$app->request->isGet) {
            return (new Bioteh())->getAllModels();
        }
        return 'Ошибка на уровне контроллера!';
    }

    public function actionRetrieve($id)
    {
        if (Yii::$app->request->isGet) {
            return (new Bioteh())->getModelById($id);
        }
        return 'Ошибка на уровне контроллера!';
    }
}