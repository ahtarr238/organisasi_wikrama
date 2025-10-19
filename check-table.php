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

// Check table structure
try {
    $columns = DB::select('DESCRIBE work_programs');
    echo "Tabel work_programs struktur:
";
    foreach ($columns as $column) {
        echo "- {$column->Field}: {$column->Type} ({$column->Null})
";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
?>