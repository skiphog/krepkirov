<?php

namespace App\Http\Controllers\Admin;

use App\Components\ExchangeComponent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;


class ExchangeController extends Controller
{

    public function run(Request $request)
    {
        if (!$this->auth()) {
            return $this->failure('Неверный логин или пароль.', 403);
        }

        if (!$request->has('mode') || !method_exists($this, $request->input('mode'))) {
            return $this->failure('Параметр для выгрузки не задан');
        }

        $method = $request->input('mode');

        return $this->$method();
    }

    /**
     * Шаг 1.
     * Отвечаем 1С об авторизации клиента
     */
    public function checkauth()
    {
        return 'success' . PHP_EOL . 'key' . PHP_EOL . md5(config('s.1c.password')) . PHP_EOL;
    }

    /**
     * Шаг 2.
     * Отвечаем 1С о поддержке архива ZIP
     */
    public function init()
    {
        return 'zip=yes' . PHP_EOL . 'file_limit=0' . PHP_EOL;
    }

    /**
     * Шаг 3.
     * Получаем файл выгрузки и распаковываем
     */
    public function file()
    {
        if (request()->input('type') === 'sale') {
            return 'success' . PHP_EOL;
        }

        $filename = request()->input('filename');

        /** @noinspection ReturnFalseInspection */
        $data = file_get_contents('php://input');

        return $this->storeFile($filename, $data);
    }

    /**
     * Шаг 4 и 5.
     * Получаем комманду из 1С какой файл будем парсить
     * Берем файл и вызываем соответствующий метод
     * 4. Парсим import
     * 5. Парсим offers
     */
    public function import()
    {
        $filename = request()->input('filename');


        if (($response = ExchangeComponent::run()->parse($filename)) === false) {
            return $this->failure('Не удалось загрузить разобрать файлы импорта');
        }

        return $this->echoHeader() . 'success' . PHP_EOL . $response . PHP_EOL;

    }

    /**
     * Шаг 6.
     * Выгружаем в 1С информацию о заказах
     */
    public function query()
    {
        return iconv('utf-8', 'cp1251', ExchangeComponent::run()->query());
    }

    /**
     * Шаг 7.
     * 1C после пуляет эту строку после приема заказов
     */
    public function success()
    {
        ExchangeComponent::run()->statusOne();
        return 'success' . PHP_EOL;
    }

    /**
     * Проверяет, авторизован пользователь или нет
     * @return bool
     */
    private function auth()
    {
        if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
            return config('s.1c.login') === $_SERVER['PHP_AUTH_USER'] && config('s.1c.password') === $_SERVER['PHP_AUTH_PW'];
        }

        return false;
    }

    /**
     * Генерация ошибки
     * @param string $txt Ошибка
     * @param int $code Код ошибки
     * @return string
     */
    private function failure($txt, $code = 200)
    {
        return response($this->echoHeader() . 'failure' . PHP_EOL . $txt . PHP_EOL, $code);
    }

    /**
     * Отправляет заголовки при Ошибке или Прогрессе
     */
    private function echoHeader()
    {
        header('Content-type: text/xml; charset=utf-8');
        return "\xEF\xBB\xBF";
    }

    private function storeFile($filename, $data)
    {
        Storage::put($filename, $data);

        if (!Storage::exists($filename)) {
            return $this->failure('Не удалось записать файл');
        }

        return $this->extractZip($filename);

    }

    /**
     * Функция для распаковки ZIP архива
     * @param $filename string в формате ZIP
     * @return bool Возвращаем статус операции
     */
    private function extractZip($filename)
    {

        $zip = new \ZipArchive();

        if ($zip->open(storage_path('app/') . $filename, \ZipArchive::CREATE) === false) {
            return $this->failure('Ошибка zip архива');
        }

        $zip->extractTo(storage_path('app/'));
        $zip->close();

        Storage::delete($filename);

        return 'success' . PHP_EOL;
    }
}
