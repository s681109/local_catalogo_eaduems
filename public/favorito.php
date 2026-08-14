<?php
require_once(__DIR__ . '/../../../config.php');

use local_catalogo_eaduems\local\course_repository;
use local_catalogo_eaduems\local\favorite_service;

require_login();
require_sesskey();

if (isguestuser()) {
    redirect(new moodle_url('/login/index.php'));
}

$courseid = required_param('courseid', PARAM_INT);
$returnurl = optional_param('returnurl', '/local/catalogo_eaduems/public/index.php', PARAM_LOCALURL);
$repository = new course_repository();
$repository->get_visible_course($courseid);

$isfavorite = favorite_service::toggle($USER->id, $courseid);
$message = $isfavorite
    ? get_string('favoritesaved', 'local_catalogo_eaduems')
    : get_string('favoriteremoved', 'local_catalogo_eaduems');

redirect(new moodle_url($returnurl), $message, null, \core\output\notification::NOTIFY_SUCCESS);
