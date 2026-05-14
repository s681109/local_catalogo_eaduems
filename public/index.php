<?php
require_once(__DIR__ . '/../../../config.php');

use local_catalogo_eaduems\local\config;
use local_catalogo_eaduems\local\course_repository;
use local_catalogo_eaduems\local\customfield_helper;

$categoryid = optional_param('category', 0, PARAM_INT);
$search = optional_param('search', '', PARAM_TEXT);
$nivel = optional_param('nivel', 0, PARAM_INT);
$certificado = optional_param('certificado', 0, PARAM_INT);
$sort = optional_param('sort', 'name', PARAM_ALPHANUMEXT);
$page = optional_param('page', 0, PARAM_INT);

$repository = new course_repository();
$customfields = new customfield_helper();
$sortoptions = $repository->get_sort_options();
if (!isset($sortoptions[$sort])) {
    $sort = 'name';
}

$url = new moodle_url('/local/catalogo_eaduems/public/index.php', [
    'category' => $categoryid,
    'search' => $search,
    'nivel' => $nivel,
    'certificado' => $certificado,
    'sort' => $sort,
]);

$perpage = config::courses_per_page();
$filters = [
    'category' => $categoryid,
    'search' => $search,
    'nivel' => $nivel,
    'certificado' => $certificado,
    'sort' => $sort,
];
$catalog = $repository->get_catalog($filters, $page, $perpage);
$categories = $repository->get_visible_categories();
$nivelfield = $customfields->get_select_field_info('nivel');
$certificadofield = $customfields->get_select_field_info('certificado');
$nivelfilteroptions = $customfields->get_used_select_options($nivelfield);
$certificadofilteroptions = $customfields->get_used_select_options($certificadofield);

$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_catalogo_eaduems'));
$PAGE->set_heading(get_string('pluginname', 'local_catalogo_eaduems'));
$PAGE->requires->css(new moodle_url('/local/catalogo_eaduems/styles.css'));

echo $OUTPUT->header();

$renderer = $PAGE->get_renderer('local_catalogo_eaduems');
$content = $renderer->render_catalog_index(
    $catalog['courses'],
    $catalog['total'],
    $filters,
    $categories,
    $nivelfilteroptions,
    $certificadofilteroptions,
    $sortoptions,
    $page,
    $perpage,
    $url
);
echo $renderer->render_shell(get_string('cataloghero_title', 'local_catalogo_eaduems'), $content);

echo $OUTPUT->footer();
