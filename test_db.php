<?php
require __DIR__."/vendor/autoload.php";
$app = require_once __DIR__."/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$policies = DB::table("policies")->get();
foreach($policies as $p) {
    echo "Policy ID: " . $p->id . "\n";
    echo substr($p->content, 0, 500) . "\n\n";
}

