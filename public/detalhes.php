<?php
require_once(__DIR__ . '/../../../config.php');

use local_catalogo_eaduems\local\course_repository;
use local_catalogo_eaduems\local\customfield_helper;

$id = required_param('id', PARAM_INT);
$repository = new course_repository();
$customfields = new customfield_helper();
$course = $repository->get_visible_course($id);
$metadata = $customfields->get_course_metadata($course->id);

$PAGE->set_url(new moodle_url('/local/catalogo_eaduems/public/detalhes.php', ['id' => $id]));
$PAGE->set_context(context_system::instance());
$PAGE->set_title($course->fullname);
$PAGE->set_heading($course->fullname);
$PAGE->requires->css(new moodle_url('/local/catalogo_eaduems/styles.css', ['v' => filemtime(__DIR__ . '/../styles.css') ?: time()]));

echo $OUTPUT->header();

$renderer = $PAGE->get_renderer('local_catalogo_eaduems');
$content = $renderer->render_course_details($course, $metadata);
echo $renderer->render_shell($course->fullname, $content, false);

echo $OUTPUT->footer();
