<?php
require_once(__DIR__ . '/../../../config.php');

use local_catalogo_eaduems\local\course_repository;
use local_catalogo_eaduems\local\favorite_service;

require_login();

if (isguestuser()) {
    redirect(new moodle_url('/login/index.php'));
}

$repository = new course_repository();
$courses = $repository->get_visible_courses_by_ids(favorite_service::get_course_ids($USER->id));

$PAGE->set_url(new moodle_url('/local/catalogo_eaduems/public/favoritos.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('favorites', 'local_catalogo_eaduems'));
$PAGE->set_heading(get_string('favorites', 'local_catalogo_eaduems'));
$PAGE->requires->css(new moodle_url('/local/catalogo_eaduems/styles.css', ['v' => filemtime(__DIR__ . '/../styles.css') ?: time()]));

echo $OUTPUT->header();
$renderer = $PAGE->get_renderer('local_catalogo_eaduems');
echo $renderer->render_shell(get_string('favorites', 'local_catalogo_eaduems'), $renderer->render_favorites_page($courses), true);
echo $OUTPUT->footer();
