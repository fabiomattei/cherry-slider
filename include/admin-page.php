<?php

// Add the admin options page
add_action('admin_menu', 'rc_cs_cherry_slider_add_page');

function rc_cs_cherry_slider_add_page() {
    add_options_page(
        __('Cherry Slider', 'cherryslidersettings'),
        __('Cherry Slider', 'cherryslidersettings'),
        'manage_options',                               // access level required to see the page
        'rc-cs-cherry-slider',                          // menu slug
        'rc_cs_cherry_slider_options_page_callback'     // callback function
    );
}

// Draw the options page
function rc_cs_cherry_slider_options_page_callback() {
    ?>
    <div class="wrap">
        <h2>Cherry Slider Settings</h2>
        <form action="options.php" method="post">
            <?php
                settings_fields('rccsoptiongroup');            // refers to option group
                do_settings_sections('rc-cs-cherry-slider');   // refers to page slug or id
                submit_button();
            ?>
        </form>
    </div>
<?php
}


function rc_cs_init() {
    // activating settings
    register_setting(
        'rccsoptiongroup',                                // option group
        'rc_cs_options',                                  // option name, determine the name of the setting stored in the database
        'rc_cs_cherry_slider_validate_options'            // callback function for validation
    );

    add_settings_section(
        'rc_cs_cherry_slider_section',                     // id
        __('Settings', 'cherryslidersettings'),            // Section title
        'rc_cs_cherry_slider_section_callback',            // callback function
        'rc-cs-cherry-slider'                              // page id
    );

    add_settings_field(
        'rc_cs_cherry_slider_setting_input',             // id
        __('Speed', 'cherryslidersettings'),             // lable to show in the form associated to the field
        'rc_cs_cherry_slider_setting_input_callback',    // callback function
        'rc-cs-cherry-slider',                           // page id
        'rc_cs_cherry_slider_section'                    // section id
    );

    add_settings_field(
        'rc_cs_cherry_slider_transition',                // id
        __('Transition', 'cherryslidersettings'),        // lable to show in the form associated to the field
        'rc_cs_cherry_slider_transition_callback',       // callback function
        'rc-cs-cherry-slider',                           // page id
        'rc_cs_cherry_slider_section'                    // section id
    );

    add_settings_field(
        'rc_cs_cherry_slider_easing',                    // id
        __('Easing', 'cherryslidersettings'),            // lable to show in the form associated to the field
        'rc_cs_cherry_slider_easing_callback',           // callback function
        'rc-cs-cherry-slider',                           // page id
        'rc_cs_cherry_slider_section'                    // section id
    );

}

add_action('admin_init', 'rc_cs_init');

// Explanations about this section
function rc_cs_cherry_slider_section_callback() {
    echo '<p>Enter your can tune the Cherry Slider plug-in.</p>';
}

// Display and fill the form field
function rc_cs_cherry_slider_setting_input_callback() {
    //get option 'text_string' value from the database
    $options = get_option( RCSL_OPTIONS_STRING );
    $speed = $options['speed'];
    // echo the field
    echo "<input id='speed' name='rc_cs_options[speed]' type='text' value='{$speed}' />";
}

function rc_cs_cherry_slider_transition_callback() {
    $options = get_option( RCSL_OPTIONS_STRING );
    if( !isset( $options['transition'] ) ) $options['transition'] = 'fade';
    ?>
    <select name="rc_cs_options[transition]">
        <option value="fade" <?php selected( $options['transition'], 'fade' ); ?>>fade</option>
        <option value="horizontal" <?php selected( $options['transition'], 'horizontal' ); ?>>horizontal</option>
        <option value="vertical" <?php selected( $options['transition'], 'vertical' ); ?>>vertical</option>
        <option value="kenburns" <?php selected( $options['transition'], 'kenburns' ); ?>>kenburns</option>
    </select>
    <?php
}

function rc_cs_cherry_slider_easing_callback() {
    $options = get_option( RCSL_OPTIONS_STRING );
    if( !isset( $options['easing'] ) ) $options['easing'] = 'swing';
    ?>
    <select name="rc_cs_options[easing]">
        <option value="swing" <?php selected( $options['easing'], 'swing' ); ?>>swing</option>
        <option value="linear" <?php selected( $options['easing'], 'linear' ); ?>>linear</option>
        <option value="easeInQuad" <?php selected( $options['easing'], 'easeInQuad' ); ?>>easeInQuad</option>
    </select>
    <?php
}

// Validate input
function rc_cs_cherry_slider_validate_options( $input ) {
    $valid = array();
    $valid['speed'] = preg_replace( '/[^0-9]/', '', $input['speed'] );
    $valid['transition'] = preg_replace( '/[^a-zA-Z]/', '', $input['transition'] );
    $valid['easing'] = preg_replace( '/[^a-zA-Z]/', '', $input['easing'] );
    return $valid;
}
