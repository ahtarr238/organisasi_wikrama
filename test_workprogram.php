<?php
require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;

// Setup database connection
$db = new DB();
$db->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'port'      => '3308',
    'database'  => 'db_organisasi',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);
$db->setAsGlobal();
$db->bootEloquent();

try {
    // Coba mengakses model WorkProgram
    $totalProgram = \App\Models\WorkProgram::count();
    echo "Total program: " . $totalProgram . "
";

    $programAktif = \App\Models\WorkProgram::where('status', 'on_going')->count();
    echo "Program aktif: " . $programAktif . "
";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
?>