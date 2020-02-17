<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * StatisticForm
 */
class StatisticForm extends Model
{
    /**
     * @var int
     */
    public static $ALL_COMPANIES_VALUE = 0;
    /**
     * @var string
     */
    public static $ALL_COMPANIES_TITLE = 'Все компании';
    /**
     * @var int
     */
    public static $ALL_CATEGORIES_VALUE = 0;
    /**
     * @var string
     */
    public static $ALL_CATEGORIES_TITLE = 'Все категории';
    /**
     * @var
     */
    public $date_from;
    /**
     * @var
     */
    public $date_to;
    /**
     * @var
     */
    public $group_by;
    /**
     * @var
     */
    public $category_id;
    /**
     * @var
     */
    public $company_id;

    /**
     * @var string
     */
    public static $GROUP_BY_MONTHS_VALUE = 'month';
    /**
     * @var string
     */
    public static $GROUP_BY_DAYS_VALUE = 'day';


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_from', 'date_to', 'group_by'], 'required', 'message' => 'Обязательное поле'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Некорректный формат'],
            [['date_from', 'date_to'], 'validateDates'],
            ['group_by', 'in', 'range' => [self::$GROUP_BY_DAYS_VALUE, self::$GROUP_BY_MONTHS_VALUE], 'message' => "Некорректное значение"],
            ['category_id', 'integer', 'message' => "Некорректное значение"],
            ['category_id', 'validateCategoryId'],
            ['company_id', 'integer', 'message' => "Некорректное значение"],
            ['company_id', 'validateCompanyId'],
        ];
    }

    /**
     *
     */
    public function validateDates()
    {
        if (strtotime($this->date_from) > strtotime($this->date_to)) {
            $this->addError('date_from', '"Дата до" не должна быть позднее "Дата после"');
            $this->addError('date_to', '"Дата до" не должна быть позднее "Дата после"');
        }
    }

    /**
     * @param $attribute
     */
    public function validateCategoryId($attribute)
    {
        $data = MoneyTransactionsCategory::getCategoriesByUserId(Yii::$app->user->id);
        $data = ArrayHelper::getColumn($data, 'id');

        if (intval($this->$attribute) !== self::$ALL_CATEGORIES_VALUE && !in_array($this->$attribute, $data)) {
            $this->addError($attribute, 'Некорректное значение');
        }
    }

    /**
     * @param $attribute
     */
    public function validateCompanyId($attribute)
    {
        $data = Company::getCompaniesByUserId(Yii::$app->user->id);
        $data = ArrayHelper::getColumn($data, 'id');
        if (intval($this->$attribute) !== self::$ALL_COMPANIES_VALUE && !in_array($this->$attribute, $data)) {
            $this->addError($attribute, 'Некорректное значение');
        }
    }
}
