<?php
add_shortcode( 'qcmpt-module', 'buildQcmptModule' );
function buildQcmptModule( ) {

    $example_var = (get_theme_mod( 'qcmpt_text' )) ? get_theme_mod( 'qcmpt_text' ) : 'Test Text';

    ob_start();?>

    <div id="qcmpt-module" class="qa module">
        <div class="row">
            <div class="col">
                <h1><?php echo $example_var; ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col">Left</div>
            <div class="col">Right</div>
        </div>
    </div>

<?php
    return ob_get_clean();
}