<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    echo "Checking schema for billets...\n";
    $schema = DB::select('SHOW CREATE TABLE billets')[0]->{'Create Table'};
    echo "Current Schema:\n$schema\n";

    echo "\nAttempting to drop unique index...\n";
    Schema::table('billets', function ($table) {
        $table->dropUnique('billets_id_commande_id_voyage_unique');
    });
    echo "Success!\n";
} catch (\Exception $e) {
    echo "\nERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
