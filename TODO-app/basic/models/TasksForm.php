<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 22.05.2018
 * Time: 19:51
 */

namespace app\models;


use yii\base\Model;

class TasksForm extends Model
{
    public $id, $date, $text, $task_status;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['text', 'string'],
            ['text', 'required', 'message' => 'Не заполнено поле "Задача"'],
            [ ['text'], 'string', 'max' => 255, 'tooLong' => 'Превышена длина текста задачи'],
        ];
    }

    /**
     * @return bool
     * Creating a task with status -
     */
    public function add()
    {
        if ($this->validate()) {
            $task = new Tasks();
            $task -> text = $this->text;
            $task -> date = date("Y-m-d H:i:s");
            $task -> task_status = 0;

            if ($task->save()) {
                return true;
            }
        }

        return false;
    }
}