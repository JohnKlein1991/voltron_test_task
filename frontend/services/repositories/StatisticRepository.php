<?php


namespace frontend\services\repositories;


use frontend\models\StatisticForm;
use Yii;

/**
 * Class StatisticRepository
 * @package frontend\services\repositories
 */
class StatisticRepository
{
    /**
     * @var \yii\db\Connection
     */
    private $connection;

    /**
     * StatisticRepository constructor.
     */
    public function __construct()
    {
        $this->connection = Yii::$app->getDb();
    }


    /**
     * @param $userId
     * @param $dateFrom
     * @param $dateTo
     * @param $companyId
     * @param $categoryId
     * @param $grouping
     * @return array
     * @throws \yii\db\Exception
     */
    public function getDataForStatistic($userId, $dateFrom, $dateTo, $companyId, $categoryId, $grouping)
    {
        $rawSqlQuery = $this->getRawSqlQuery($userId, $dateFrom, $dateTo, $companyId, $categoryId, $grouping);
        return $this->connection->createCommand($rawSqlQuery)->queryAll();
    }


    /**
     * @param $userId
     * @param $dateFrom
     * @param $dateTo
     * @param $companyId
     * @param $categoryId
     * @param $grouping
     * @return string
     */
    private function getRawSqlQuery($userId, $dateFrom, $dateTo, $companyId, $categoryId, $grouping)
    {
        $userWhere = "and mt.user_id = $userId";
        $companySelect = ($companyId == 0) ? "c.title as company," : "";
        $categorySelect = ($categoryId == 0) ? "mtc.title as category," : "";
        $companyWhere = $companyId ? "and c.id = ${companyId}" : "";
        $categoryWhere = $categoryId ? "and mtc.id = ${categoryId}" : "";
        $companyGroupBy = ($companyId == 0) ? "company," : "";
        $categoryGroupBy = ($categoryId == 0) ? "category," : "";
        if ($grouping === StatisticForm::$GROUP_BY_MONTHS_VALUE) {
            $dateSelect = "concat(year(mt.date),'-',month(mt.date)) as date,";
        } else {
            $dateSelect = "mt.date as date,";
        }
        $dateGroupBy = "date,";

        return "
            select {$dateSelect} {$companySelect} {$categorySelect} mt.type, sum(amount) as amount
            from money_transactions mt
            join companies c on mt.company_id = c.id
            join money_transactions_categories mtc on mt.category_id = mtc.id
            where mt.date between '{$dateFrom}' and '{$dateTo}'
            {$userWhere} {$companyWhere} {$categoryWhere}
            group by {$dateGroupBy} {$companyGroupBy} {$categoryGroupBy} mt.type;
        ";
    }
}