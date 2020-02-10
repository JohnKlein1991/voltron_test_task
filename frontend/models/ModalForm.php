<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Специальная модель для валидации модальных форм для категорий и компаний
 * , т.к. во всех случаях необходимо только одно поле - title
 *
 */
class ModalForm extends Model
{
    public $title;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required', 'message' => 'Обязательное поле'],
            [['title'], 'string', 'max' => 250, 'message' => 'Название должно быть строкой не более 250 символов'],
        ];
    }
}
