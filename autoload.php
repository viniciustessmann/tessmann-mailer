<?php
/**
 * Created by Vinícius Schlee Tessmann.
 * User: viniciustessmann
 * Date: 02/01/17
 * Time: 10:26
 */

$iterator = new RecursiveDirectoryIterator(__DIR__ . "/classes/");

foreach (new RecursiveIteratorIterator($iterator) as $fileName => $current) {
    if (!is_file($fileName)) {
        continue;
    }

    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    if ($ext != 'php') {
        continue;
    }

    include_once($fileName);
}
