<?php

namespace frontend\services;

use frontend\models\MoneyTransaction;
use frontend\services\repositories\StatisticRepository;

/**
 * Class StatisticService
 * @package frontend\services
 */
class StatisticService
{
    /**
     * @var StatisticRepository
     */
    private $repository;

    /**
     * StatisticService constructor.
     * @param StatisticRepository $repository
     */
    public function __construct(StatisticRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param array $data
     * @param $userId
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function getDataForStatisticTable($data = [], $userId)
    {
        // значения по умолчанию, при переходе на страницу
        $dateFrom = $data['date_from'] ?? date('Y-m-d');
        $dateTo = $data['date_to'] ?? date('Y-m-d');
        $grouping = $data['group_by'] ?? 'day';
        $categoryId = $data['category_id'] ?? 0;
        $companyId = $data['company_id'] ?? 0;

        $rawData = $this->repository->getDataForStatistic($userId, $dateFrom, $dateTo, $companyId, $categoryId, $grouping);
        return $this->prepareRawDataForStatistic($rawData);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function prepareRawDataForStatistic($data)
    {

        foreach ($data as $key => $item) {
            if ($item['type'] == MoneyTransaction::$TYPE_REVENUE) {
                $data[$key]['type'] = 'Доход';
            } else if ($item['type'] == MoneyTransaction::$TYPE_EXPENSE) {
                $data[$key]['type'] = 'Расход';
            }
        }
        return $data;
    }
}