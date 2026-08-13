<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_catalogo_eaduems', get_string('pluginname', 'local_catalogo_eaduems'));

    $settings->add(new admin_setting_configtext(
        'local_catalogo_eaduems/coursesperpage',
        get_string('settings_coursesperpage', 'local_catalogo_eaduems'),
        get_string('settings_coursesperpage_desc', 'local_catalogo_eaduems'),
        10,
        PARAM_INT
    ));

    $settings->add(new admin_setting_heading(
        'local_catalogo_eaduems/herosettings',
        get_string('settings_hero_heading', 'local_catalogo_eaduems'),
        ''
    ));

    $settings->add(new admin_setting_configtext(
        'local_catalogo_eaduems/hero_title',
        get_string('settings_hero_title', 'local_catalogo_eaduems'),
        get_string('settings_hero_title_desc', 'local_catalogo_eaduems'),
        get_string('cataloghero_title', 'local_catalogo_eaduems'),
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtextarea(
        'local_catalogo_eaduems/hero_subtitle',
        get_string('settings_hero_subtitle', 'local_catalogo_eaduems'),
        get_string('settings_hero_subtitle_desc', 'local_catalogo_eaduems'),
        get_string('cataloghero_subtitle', 'local_catalogo_eaduems'),
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_heading(
        'local_catalogo_eaduems/detailsettings',
        get_string('settings_details_heading', 'local_catalogo_eaduems'),
        ''
    ));

    $settings->add(new admin_setting_configmulticheckbox(
        'local_catalogo_eaduems/detailmetadatafields',
        get_string('settings_detailmetadatafields', 'local_catalogo_eaduems'),
        get_string('settings_detailmetadatafields_desc', 'local_catalogo_eaduems'),
        [
            'duracao' => 1,
            'nivel' => 1,
            'publico' => 1,
            'certificado' => 1,
            'professor_tutor' => 1,
        ],
        [
            'duracao' => get_string('duration', 'local_catalogo_eaduems'),
            'nivel' => get_string('level', 'local_catalogo_eaduems'),
            'publico' => get_string('publictarget', 'local_catalogo_eaduems'),
            'certificado' => get_string('certificate', 'local_catalogo_eaduems'),
            'professor_tutor' => get_string('teacher', 'local_catalogo_eaduems'),
        ]
    ));

    $ADMIN->add('localplugins', $settings);
}
