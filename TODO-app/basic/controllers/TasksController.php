<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\TasksForm;
use app\models\Tasks;
use yii\data\Pagination;
use Yii;


class TasksController extends Controller
{
    /**
     * Метод в зависимости от переданного параметра собирает из БД записи
     * задач и прописывает пагинатор, возвращая в виде массива
     * По умолчанию: все задачи
     *
     * @return array: pagination, tasks
     */
    private function getTasks($sortStatus = -1)
    {
        switch ($sortStatus) {
            case 0:
                $tasks = Tasks::find()->where(['task_status' => 0]);
                break;
            case 1:
                $tasks = Tasks::find()->where(['task_status' => 1]);
                break;
            default:
                $tasks = Tasks::find();
                break;
        }

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $tasks->count(),
        ]);

        $tasks = $tasks->orderBy([
            "task_status" => SORT_ASC,
            "date" => SORT_DESC,
        ])->offset($pagination->offset)->limit($pagination->limit)->all();


        return ['pagination' => $pagination, 'tasks' => $tasks];

    }

    /**
     * Удаление задачи
     *
     * @return boolean
     */

    public function actionDelete($task_id=null)
    {
        if ($task_id) {
            $task = Tasks::find()->where(['id' => $task_id])->one();
            $task->delete();
            return true;
        }
        return false;
    }

    /**
     * Смена статуса задачи
     *
     * @return boolean
     */
    public function actionChange($task_id=null)
    {
        if ($task_id) {
            $task = Tasks::find()->where(['id' => $task_id])->one();
            $task->task_status = 1;
            $task->save();
            return true;
        }
        return false;
    }

    /**
     * Вывод всех задач
     *
     * @return string
     */
    public function actionIndex()
    {
        $valueArr = $this->getTasks();
        $tasks = $valueArr['tasks'];
        $pagination = $valueArr['pagination'];

        $formModel = new TasksForm();
        if ($formModel->load(Yii::$app->request->post()) && $formModel->add()) {
            $formModel->text = "";
            return $this->refresh();
        }

        return $this->render('all', [
            'model' => $tasks,
            'pagination' => $pagination,
            'formModel' => $formModel,
        ]);
    }

    /**
     * Вывод активных задач
     *
     * @return string
     */
    public function actionActive()
    {
        $valueArr = $this->getTasks(0);
        $tasks = $valueArr['tasks'];
        $pagination = $valueArr['pagination'];

        $formModel = new TasksForm();
        if ($formModel->load(Yii::$app->request->post()) && $formModel->add()) {
            $formModel->text = "";
            return $this->refresh();
        }

        return $this->render('active', [
            'model' => $tasks,
            'pagination' => $pagination,
            'formModel' => $formModel,
        ]);
    }

    /**
     * Вывод завершенных задач
     *
     * @return string
     */
    public function actionDone()
    {
        $valueArr = $this->getTasks(1);
        $tasks = $valueArr['tasks'];
        $pagination = $valueArr['pagination'];

        $formModel = new TasksForm();
        if ($formModel->load(Yii::$app->request->post()) && $formModel->add()) {
            $formModel->text = "";
            return $this->refresh();
        }

        return $this->render('done', [
            'model' => $tasks,
            'pagination' => $pagination,
            'formModel' => $formModel,
        ]);
    }
}
