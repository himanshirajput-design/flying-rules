<?php
require __DIR__."/vendor/autoload.php";
$app = require_once __DIR__."/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function slugify($text) {
    $text = preg_replace("~[^\pL\d]+~u", "-", $text);
    $text = iconv("utf-8", "us-ascii//TRANSLIT", $text);
    $text = preg_replace("~[^-\w]+~", "", $text);
    $text = trim($text, "-");
    $text = preg_replace("~-+~", "-", $text);
    $text = strtolower($text);
    return $text;
}

$policies = DB::table("policies")->get();
foreach($policies as $p) {
    $html = $p->content;
    
    // Add ids to h2, h3, h4, h5 based on their text
    $html = preg_replace_callback("/<(h[2-5])>(.*?)<\/\1>/s", function($matches) {
        $tag = $matches[1];
        $text = strip_tags($matches[2]);
        $id = slugify($text);
        return "<$tag id=\"$id\">" . $matches[2] . "</$tag>";
    }, $html);
    
    // Clean up empty paragraphs
    $html = str_replace("<p><br></p>", "", $html);
    
    DB::table("policies")->where("id", $p->id)->update(["content" => $html]);
}
echo "Fixed IDs.\n";

