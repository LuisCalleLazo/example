<?php


use JasperPHP\JasperPHP;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reporte', function()
{
    $jasper = new JasperPHP;
    $input = storage_path("app/reports/ReportDemo.jrxml");
    echo $input;
    $output = storage_path("app/resultReports");

    // Definir los parámetros
    $params = array(
        "LogoEmpresa" => storage_path("app/images/logo_empresa.png")
    );

    $db_connection = [
        'driver' => 'generic',
        'username' => 'sa',
        'password' => '78824luis',
        'host' => '127.0.0.1',
        'database' => 'AutoJapDB',
        'jdbc_url' => 'jdbc:sqlserver://127.0.0.1;databaseName=AutoJapDB;encrypt=false',
        'jdbc_driver' => 'com.microsoft.sqlserver.jdbc.SQLServerDriver',
    ];

    $jasper->process(
        $input,
        $output,
        array("pdf", "docx"),
        $params,
        $db_connection
    )->execute();
});
