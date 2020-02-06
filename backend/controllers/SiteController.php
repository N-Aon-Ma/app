<?php

namespace backend\controllers;

use common\models\AppleDb;
use common\resource\Apple;
use common\resource\AppleRepository;
use PHPUnit\Framework\StaticAnalysis\HappyPath\AssertNotInstanceOf\A;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create-apples', 'delete-apple', 'eat-apple', 'fall-apple'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionIndex()
    {
        $appleRepository = new AppleRepository(new AppleDb());
        return $this->render('index', ['model' => $appleRepository->findAllItems()]);
    }

    public function actionCreateApples()
    {
        $applesColor = ['green', 'red', "white"];
        $appleRepository = new AppleRepository(new AppleDb());
        $applesCount = max(0, $appleRepository->findAllItems());
        if ($applesCount < 10) {
            for ($i = 0; $i < $applesCount; $i++) {
                $color = $applesColor[array_rand($applesColor)];
                $apple = new Apple($color);
                $appleRepository->setItem($apple);
            }
        }
        return $this->redirect('index');
    }

    public function actionDeleteApple()
    {
        $id = $this->takeIdFromGet();
        $appleRepository = new AppleRepository(new AppleDb());
        $appleRepository->deleteItem($id);
        return $this->redirect('index');
    }

    public function actionEatApple()
    {
        $id = $this->takeIdFromGet();
        $appleRepository = new AppleRepository(new AppleDb());

        $apple = $appleRepository->getItem($id);
        $apple->eat(rand(0, 10) / 10);
        if ($apple->isLife()) {
            $appleRepository->setItem($apple);
        } else {
            $appleRepository->deleteItem($id);
        }
        return $this->redirect('index');
    }

    public function actionFallApple()
    {
        $id = $this->takeIdFromGet();
        $appleRepository = new AppleRepository(new AppleDb());

        $apple = $appleRepository->getItem($id);
        $apple->fallToGround();
        $appleRepository->setItem($apple);

        return $this->redirect('index');
    }

    protected function takeIdFromGet()
    {
        return (int)Yii::$app->request->get('id');
    }

}
