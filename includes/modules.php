<?php

function qcmptLoadShortcodes() {
    require __DIR__.'/modules/qcmpt-module.php';
}
add_action('init', 'qcmptLoadShortcodes');