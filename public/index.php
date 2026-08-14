<?php
require_once(__DIR__ . '/../../../config.php');

use local_catalogo_eaduems\local\config;
use local_catalogo_eaduems\local\course_repository;

$categoryid = optional_param('category', 0, PARAM_INT);
$search = trim(optional_param('search', '', PARAM_TEXT));
$page = optional_param('page', 0, PARAM_INT);

$repository = new course_repository();

$urlparams = ['category' => $categoryid];
if ($search !== '') {
    $urlparams['search'] = $search;
}
$url = new moodle_url('/local/catalogo_eaduems/public/index.php', $urlparams);

$perpage = config::courses_per_page();
$filters = [
    'category' => $categoryid,
    'search' => $search,
    'sort' => 'name',
];
$catalog = $repository->get_catalog($filters, $page, $perpage);
$categories = $repository->get_visible_categories();

$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_catalogo_eaduems'));
$PAGE->set_heading(get_string('pluginname', 'local_catalogo_eaduems'));
$PAGE->requires->css(new moodle_url('/local/catalogo_eaduems/styles.css', ['v' => filemtime(__DIR__ . '/../styles.css') ?: time()]));

echo $OUTPUT->header();

$renderer = $PAGE->get_renderer('local_catalogo_eaduems');
$content = $renderer->render_catalog_index(
    $catalog['courses'],
    $catalog['total'],
    $filters,
    $categories,
    $page,
    $perpage,
    $url
);
echo $renderer->render_shell(
    get_string('cataloghero_title', 'local_catalogo_eaduems'),
    $content,
    true
);

echo $OUTPUT->footer();
