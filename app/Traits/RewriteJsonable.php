<?php
namespace App\Traits;

trait RewriteJsonable
{

    /**
     * Не преобразуем json utf-8 в unicode символы
     * @param mixed $value
     * @return string
     */
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Не преобразуем json utf-8 в unicode символы
     * @param int $options
     * @return string
     */
    public function toJson($options = JSON_UNESCAPED_UNICODE)
    {
        /** @noinspection PhpUndefinedClassInspection */
        /** @noinspection PhpUndefinedMethodInspection */
        return parent::toJson($options);
    }
}
