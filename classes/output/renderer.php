<?php
namespace local_catalogo_eaduems\output;

defined('MOODLE_INTERNAL') || die();

use html_writer;
use moodle_url;
use plugin_renderer_base;
use core\session\manager;

class renderer extends plugin_renderer_base {

    public function render_shell(string $title, string $content, bool $showhero = true): string {
        $output = html_writer::start_div('local-catalogo-eaduems');
        $output .= $this->render_portal_header($showhero);

        $output .= html_writer::div($content, 'catalogo-eaduems-content');
        $output .= html_writer::end_div();

        return $output;
    }

    private function render_portal_header(bool $showlogin = true): string {
        $quicklogin = $showlogin ? $this->get_portal_quicklogin_context() : [];
        $output = html_writer::start_div('eaduems-portal catalogo-eaduems-portalheader');
        $output .= html_writer::start_tag('header', [
            'class' => 'eaduems-portal-mainheader',
            'aria-label' => 'Cabeçalho do portal EAD/UEMS',
        ]);
        $output .= html_writer::start_div('eaduems-portal-mainheader-inner');
        $output .= html_writer::link(new moodle_url('/'),
            html_writer::span('E', 'eaduems-portal-brandmark', ['aria-hidden' => 'true']) .
            html_writer::span(
                html_writer::tag('strong', 'EAD/UEMS') . html_writer::span('Portal de cursos online'),
                'eaduems-portal-brandtext'
            ),
            ['class' => 'eaduems-portal-brand']
        );

        if (!empty($quicklogin)) {
            $output .= html_writer::start_tag('form', [
                'class' => 'eaduems-portal-headerlogin',
                'action' => $quicklogin['loginurl'],
                'method' => 'post',
            ]);
            $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'logintoken', 'value' => $quicklogin['logintoken']]);
            $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'wantsurl', 'value' => $quicklogin['wantsurl']]);
            $output .= html_writer::label($quicklogin['usernameplaceholder'], 'catalogo-eaduems-header-username', false, ['class' => 'visually-hidden']);
            $output .= html_writer::span(
                html_writer::span('&#xf007;', '', ['aria-hidden' => 'true']) .
                html_writer::empty_tag('input', [
                    'id' => 'catalogo-eaduems-header-username',
                    'type' => 'text',
                    'name' => 'username',
                    'autocomplete' => 'username',
                    'placeholder' => $quicklogin['usernameplaceholder'],
                ]),
                'eaduems-portal-loginfield'
            );
            $output .= html_writer::label($quicklogin['passwordplaceholder'], 'catalogo-eaduems-header-password', false, ['class' => 'visually-hidden']);
            $output .= html_writer::span(
                html_writer::span('&#xf023;', '', ['aria-hidden' => 'true']) .
                html_writer::empty_tag('input', [
                    'id' => 'catalogo-eaduems-header-password',
                    'type' => 'password',
                    'name' => 'password',
                    'autocomplete' => 'current-password',
                    'placeholder' => $quicklogin['passwordplaceholder'],
                ]),
                'eaduems-portal-loginfield'
            );
            $output .= html_writer::tag('button', '&#xf054;', [
                'class' => 'eaduems-portal-loginbutton',
                'type' => 'submit',
                'aria-label' => $quicklogin['loginbutton'],
            ]);
            $output .= html_writer::start_div('eaduems-portal-loginlinks');
            $output .= html_writer::link($quicklogin['forgotpasswordurl'], $quicklogin['forgotpassword'], ['class' => 'eaduems-portal-forgot']);
            if (!empty($quicklogin['cancreateaccount'])) {
                $output .= html_writer::link($quicklogin['signupurl'], $quicklogin['createaccount'], ['class' => 'eaduems-portal-createaccount']);
            }
            $output .= html_writer::end_div();
            $output .= html_writer::end_tag('form');
        } else if ($showlogin && isloggedin() && !isguestuser()) {
            $output .= $this->render_portal_usernav();
        }

        $output .= html_writer::end_div();
        $output .= html_writer::end_tag('header');
        $output .= html_writer::start_tag('nav', [
            'class' => 'eaduems-portal-navbar',
            'aria-label' => 'Navegação principal do portal',
        ]);
        $output .= html_writer::start_div('eaduems-portal-navbar-inner');
        $output .= html_writer::link(new moodle_url('/', ['redirect' => 0]), 'Página inicial', ['class' => 'eaduems-portal-navhome']);
        $output .= html_writer::link(new moodle_url('/local/catalogo_eaduems/public/index.php'), 'Catálogo');
        $output .= html_writer::start_tag('form', [
            'class' => 'eaduems-portal-navsearch',
            'action' => (new moodle_url('/course/search.php'))->out(false),
            'method' => 'get',
        ]);
        $output .= html_writer::label('Buscar cursos', 'catalogo-eaduems-nav-search', false, ['class' => 'visually-hidden']);
        $output .= html_writer::empty_tag('input', [
            'id' => 'catalogo-eaduems-nav-search',
            'type' => 'search',
            'name' => 'q',
            'placeholder' => 'Buscar cursos...',
        ]);
        $output .= html_writer::tag('button', '&#xf002;', ['type' => 'submit', 'aria-label' => 'Buscar']);
        $output .= html_writer::end_tag('form');
        $output .= html_writer::end_div();
        $output .= html_writer::end_tag('nav');
        $output .= html_writer::end_div();

        return $output;
    }

    private function render_portal_usernav(): string {
        global $OUTPUT, $PAGE;

        $renderer = $PAGE->get_renderer('core');
        $primary = new \theme_eaduems_portal\output\navigation\primary($PAGE);
        $primarymenu = $primary->export_for_template($renderer);

        $output = html_writer::start_div('eaduems-portal-usernav catalogo-eaduems-usernav');
        $output .= $OUTPUT->navbar_plugin_output();
        $output .= html_writer::start_div('d-flex align-items-stretch usermenu-container', ['data-region' => 'usermenu']);
        if (!empty($primarymenu['user'])) {
            $output .= $OUTPUT->render_from_template('core/user_menu', $primarymenu['user']);
        }
        $output .= html_writer::end_div();
        $output .= $OUTPUT->edit_switch();
        $output .= html_writer::end_div();

        return $output;
    }

    private function get_portal_quicklogin_context(): array {
        global $CFG, $PAGE, $SESSION;

        if (isloggedin() && !isguestuser()) {
            return [];
        }

        $loginurl = new moodle_url('/login/index.php');
        $forgotpasswordurl = new moodle_url('/login/forgot_password.php');
        $signupurl = new moodle_url('/login/signup.php');
        $wantsurl = $PAGE->url->out(false);
        $SESSION->wantsurl = $wantsurl;

        return [
            'loginurl' => $loginurl->out(false),
            'forgotpasswordurl' => $forgotpasswordurl->out(false),
            'signupurl' => $signupurl->out(false),
            'logintoken' => manager::get_login_token(),
            'wantsurl' => $wantsurl,
            'cancreateaccount' => !empty($CFG->registerauth),
            'usernameplaceholder' => 'Usuário',
            'passwordplaceholder' => 'Senha',
            'loginbutton' => 'Acessar',
            'forgotpassword' => 'Esqueci minha senha',
            'createaccount' => 'Criar conta',
        ];
    }

    public function render_course_placeholder(): string {
        $output = html_writer::start_div('catalogo-eaduems-card');
        $output .= html_writer::div('', 'catalogo-eaduems-cardmedia', ['aria-hidden' => 'true']);
        $output .= html_writer::start_div('catalogo-eaduems-cardbody');
        $output .= html_writer::tag('h2', s(get_string('cataloghero_title', 'local_catalogo_eaduems')));
        $output .= html_writer::tag('p', s(get_string('emptycatalog', 'local_catalogo_eaduems')));
        $output .= html_writer::link(new moodle_url('/local/catalogo_eaduems/public/detalhes.php'), get_string('viewdetails', 'local_catalogo_eaduems'), [
            'class' => 'catalogo-eaduems-button',
        ]);
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();

        return $output;
    }

    public function render_catalog_index(
        array $courses,
        int $total,
        array $filters,
        array $categories,
        int $page,
        int $perpage,
        moodle_url $url
    ): string {
        global $OUTPUT;

        $output = html_writer::start_div('catalogo-eaduems-layout');
        $output .= html_writer::start_tag('section', ['class' => 'catalogo-eaduems-results', 'aria-label' => get_string('catalogresults', 'local_catalogo_eaduems')]);
        $output .= $this->render_results_header($total, $filters);
        $output .= $this->render_category_filter($filters, $categories);
        $output .= html_writer::div($this->render_category_sidebar($filters, $categories), 'catalogo-eaduems-mobile-categories');
        if (!empty($courses)) {
            $output .= html_writer::start_div('catalogo-eaduems-cards');
            foreach ($courses as $course) {
                $output .= $this->render_course_card($course);
            }
            $output .= html_writer::end_div();
            $output .= $OUTPUT->paging_bar($total, $page, $perpage, $url);
        } else {
            $output .= $this->render_empty_state();
        }
        $output .= html_writer::end_tag('section');

        $output .= html_writer::start_tag('aside', ['class' => 'catalogo-eaduems-sidebar']);
        $output .= $this->render_category_sidebar($filters, $categories);
        $output .= html_writer::end_tag('aside');
        $output .= html_writer::end_div();

        return $output;
    }

    public function render_course_card(\stdClass $course): string {
        $summary = shorten_text(trim(html_to_text((string) $course->summary, 0, false)), 170);
        $detailsurl = new moodle_url('/local/catalogo_eaduems/public/detalhes.php', ['id' => $course->id]);
        $categoryname = $course->categoryname ?? '';

        $output = html_writer::start_tag('article', ['class' => 'catalogo-eaduems-card']);
        $output .= $this->render_course_media($course);
        $output .= html_writer::start_div('catalogo-eaduems-cardbody');
        if ($categoryname !== '') {
            $output .= html_writer::tag('p', s($categoryname), ['class' => 'catalogo-eaduems-cardcategory']);
        }
        $output .= html_writer::tag('h2', s($course->fullname));
        $output .= html_writer::tag('p', s($summary !== '' ? $summary : get_string('summaryempty', 'local_catalogo_eaduems')), [
            'class' => 'catalogo-eaduems-cardsummary',
        ]);
        $output .= html_writer::start_div('catalogo-eaduems-cardfooter');
        $output .= html_writer::link($detailsurl, get_string('viewdetails', 'local_catalogo_eaduems'), [
            'class' => 'catalogo-eaduems-button',
        ]);
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        $output .= html_writer::end_tag('article');

        return $output;
    }

    public function render_details_placeholder(): string {
        $output = html_writer::start_div('catalogo-eaduems-details');
        $output .= html_writer::start_div('catalogo-eaduems-details-main');
        $output .= html_writer::tag('h2', s(get_string('details', 'local_catalogo_eaduems')));
        $output .= html_writer::tag('p', s(get_string('cataloghero_subtitle', 'local_catalogo_eaduems')));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div('catalogo-eaduems-actions');
        $output .= html_writer::link(new moodle_url('/login/signup.php'), get_string('createaccount', 'local_catalogo_eaduems'), [
            'class' => 'catalogo-eaduems-button catalogo-eaduems-button-primary',
        ]);
        $output .= html_writer::link(new moodle_url('/login/index.php'), get_string('alreadyhaveaccount', 'local_catalogo_eaduems'), [
            'class' => 'catalogo-eaduems-button catalogo-eaduems-button-secondary',
        ]);
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();

        return $output;
    }

    public function render_course_details(\stdClass $course, array $metadata): string {
        global $USER;

        $categoryname = $course->categoryname ?? '';
        $output = html_writer::start_div('catalogo-eaduems-details-layout');
        $output .= html_writer::start_tag('article', ['class' => 'catalogo-eaduems-details-main']);
        $output .= $this->render_course_media($course, 'catalogo-eaduems-details-media');
        if ($categoryname !== '') {
            $output .= html_writer::tag('p', s($categoryname), ['class' => 'catalogo-eaduems-detailcategory']);
        }
        $output .= html_writer::tag('h2', s($course->fullname));
        $output .= html_writer::tag('h3', s(get_string('courseabout', 'local_catalogo_eaduems')), ['class' => 'catalogo-eaduems-sectiontitle']);
        $output .= $this->render_course_summary($course);
        $output .= html_writer::tag('h3', s(get_string('coursecontent', 'local_catalogo_eaduems')), ['class' => 'catalogo-eaduems-sectiontitle']);
        $output .= $this->render_course_sections($course, $metadata);
        $output .= html_writer::end_tag('article');

        $output .= html_writer::start_tag('aside', ['class' => 'catalogo-eaduems-details-side']);
        $metadatahtml = $this->render_metadata($metadata);
        if ($metadatahtml !== '') {
            $output .= html_writer::start_div('catalogo-eaduems-metacard');
            $output .= html_writer::tag('h2', s(get_string('coursemetadata', 'local_catalogo_eaduems')));
            $output .= $metadatahtml;
            $output .= html_writer::end_div();
        }

        $output .= html_writer::start_div('catalogo-eaduems-actioncard');
        $output .= html_writer::tag('h2', s(get_string('courseactions', 'local_catalogo_eaduems')));
        if (!isloggedin() || isguestuser()) {
            $output .= html_writer::tag('p', s(get_string('visitoractions_desc', 'local_catalogo_eaduems')));
            $output .= html_writer::link(new moodle_url('/login/signup.php'), get_string('createaccount', 'local_catalogo_eaduems'), [
                'class' => 'catalogo-eaduems-button catalogo-eaduems-button-primary',
            ]);
            $output .= html_writer::link(new moodle_url('/login/index.php'), get_string('alreadyhaveaccount', 'local_catalogo_eaduems'), [
                'class' => 'catalogo-eaduems-button catalogo-eaduems-button-secondary',
            ]);
        } else {
            $courseurl = new moodle_url('/course/view.php', ['id' => $course->id]);
            $buttontext = is_enrolled(\context_course::instance($course->id), $USER)
                ? get_string('continuecourse', 'local_catalogo_eaduems')
                : get_string('accesscourse', 'local_catalogo_eaduems');
            $output .= html_writer::link($courseurl, $buttontext, [
                'class' => 'catalogo-eaduems-button catalogo-eaduems-button-primary',
            ]);
        }
        $output .= $this->render_whatsapp_share($course);
        $output .= html_writer::end_div();

        $output .= html_writer::end_tag('aside');
        $output .= html_writer::end_div();

        return $output;
    }

    private function render_category_filter(array $filters, array $categories): string {
        $output = html_writer::start_tag('form', [
            'action' => 'index.php',
            'method' => 'get',
            'class' => 'catalogo-eaduems-categoryfilter',
        ]);
        $output .= html_writer::label(get_string('category', 'local_catalogo_eaduems'), 'catalogo-eaduems-category', false, ['class' => 'visually-hidden']);
        $output .= html_writer::start_tag('select', ['id' => 'catalogo-eaduems-category', 'name' => 'category']);
        $current = (string) ($filters['category'] ?? 0);
        $attrs = ['value' => '0'];
        if ($current === '0' || $current === '') {
            $attrs['selected'] = 'selected';
        }
        $output .= html_writer::tag('option', get_string('allcategories', 'local_catalogo_eaduems'), $attrs);
        foreach ($this->category_options($categories) as $value => $option) {
            $attrs = [
                'value' => (string) $value,
                'class' => $option['isparent'] ? 'catalogo-eaduems-category-parentoption' : 'catalogo-eaduems-category-childoption',
            ];
            if ((string) $value === $current) {
                $attrs['selected'] = 'selected';
            }
            $output .= html_writer::tag('option', s($option['label']), $attrs);
        }
        $output .= html_writer::end_tag('select');
        $filtercontent = html_writer::span('&#xf0b0;', 'catalogo-eaduems-actionicon', ['aria-hidden' => 'true']);
        $filtercontent .= html_writer::span(s(get_string('filter', 'local_catalogo_eaduems')));
        $output .= html_writer::tag('button', $filtercontent, ['type' => 'submit']);
        $clearcontent = html_writer::span('&#xf00d;', 'catalogo-eaduems-actionicon', ['aria-hidden' => 'true']);
        $clearcontent .= html_writer::span(s(get_string('clearfilter', 'local_catalogo_eaduems')));
        $output .= html_writer::link(new moodle_url('/local/catalogo_eaduems/public/index.php'), $clearcontent, [
            'class' => 'catalogo-eaduems-clearfilter',
        ]);
        $output .= html_writer::end_tag('form');

        return $output;
    }

    private function render_category_sidebar(array $filters, array $categories): string {
        $currentcategory = (int) ($filters['category'] ?? 0);
        $output = html_writer::start_div('catalogo-eaduems-sidebarintro');
        $output .= html_writer::tag('h2', s(get_string('coursecategories', 'local_catalogo_eaduems')));
        $output .= html_writer::end_div();

        if (empty($categories)) {
            return $output;
        }

        $items = '';
        foreach ($categories as $category) {
            $coursecount = (int) ($category->visiblecoursecount ?? 0);
            $categoryurl = new moodle_url('/local/catalogo_eaduems/public/index.php', ['category' => $category->id]);
            $classes = 'catalogo-eaduems-categoryitem catalogo-eaduems-categorydepth-' . $this->category_visual_depth($category);
            if (!empty($category->haschildren)) {
                $classes .= ' is-parent';
            }
            if ((int) $category->id === $currentcategory) {
                $classes .= ' is-active';
            }

            $linkcontent = html_writer::span(s($category->name), 'catalogo-eaduems-categoryname');
            $linkcontent .= html_writer::span((string) $coursecount, 'catalogo-eaduems-categorycount');
            $items .= html_writer::tag('li', html_writer::link($categoryurl, $linkcontent), ['class' => $classes]);
        }

        $output .= html_writer::tag('ul', $items, ['class' => 'catalogo-eaduems-categorylist']);

        return $output;
    }

    private function render_select(string $id, string $name, string $label, string $alllabel, array $options, string $current, bool $includeall = true): string {
        if (empty($options) && !$includeall) {
            return '';
        }

        $output = html_writer::label($label, $id);
        $output .= html_writer::start_tag('select', ['id' => $id, 'name' => $name]);
        if ($includeall) {
            $attrs = ['value' => '0'];
            if ($current === '0' || $current === '') {
                $attrs['selected'] = 'selected';
            }
            $output .= html_writer::tag('option', $alllabel, $attrs);
        }
        foreach ($options as $value => $optionlabel) {
            $attrs = ['value' => (string) $value];
            if ((string) $value === $current) {
                $attrs['selected'] = 'selected';
            }
            $output .= html_writer::tag('option', s($optionlabel), $attrs);
        }
        $output .= html_writer::end_tag('select');

        return $output;
    }

    private function category_options(array $categories): array {
        $options = [];
        foreach ($categories as $category) {
            $depth = $this->category_visual_depth($category);
            $prefix = $depth > 0 ? str_repeat('-- ', $depth) : '';
            $options[$category->id] = [
                'label' => $prefix . $category->name,
                'isparent' => !empty($category->haschildren),
                'depth' => $depth,
            ];
        }

        return $options;
    }

    private function category_visual_depth(\stdClass $category): int {
        return max(0, (int) ($category->depth ?? 1) - 1);
    }

    private function render_results_header(int $total, array $filters): string {
        $count = $total === 1
            ? get_string('singlecoursefound', 'local_catalogo_eaduems')
            : get_string('coursesfound', 'local_catalogo_eaduems', $total);

        $output = html_writer::start_div('catalogo-eaduems-resultsheader');
        $output .= html_writer::tag('h2', s($count));
        $output .= html_writer::tag('p', s(get_string('catalogresults_desc', 'local_catalogo_eaduems')));
        $output .= html_writer::end_div();

        return $output;
    }

    private function render_empty_state(): string {
        return html_writer::div(get_string('emptycatalog', 'local_catalogo_eaduems'), 'catalogo-eaduems-empty');
    }

    private function render_course_media(\stdClass $course, string $class = 'catalogo-eaduems-cardmedia'): string {
        $image = \core_course\external\course_summary_exporter::get_course_image($course);
        if ($image) {
            return html_writer::img($image, s($course->fullname), ['class' => $class]);
        }

        return html_writer::div(s($this->course_initials($course->fullname)), $class . ' catalogo-eaduems-fallback', [
            'role' => 'img',
            'aria-label' => get_string('courseimagefallback', 'local_catalogo_eaduems', $course->fullname),
        ]);
    }

    private function render_course_summary(\stdClass $course): string {
        $context = \context_course::instance($course->id);
        $summary = trim((string) $course->summary);
        if ($summary === '') {
            return html_writer::tag('p', s(get_string('summaryempty', 'local_catalogo_eaduems')));
        }

        $summary = file_rewrite_pluginfile_urls($summary, 'pluginfile.php', $context->id, 'course', 'summary', 0);
        return html_writer::div(format_text($summary, $course->summaryformat, [
            'context' => $context,
            'overflowdiv' => true,
        ]), 'catalogo-eaduems-summary');
    }

    private function render_metadata(array $metadata): string {
        $rows = [
            'duracao' => get_string('duration', 'local_catalogo_eaduems'),
            'nível' => get_string('level', 'local_catalogo_eaduems'),
            'publico' => get_string('publictarget', 'local_catalogo_eaduems'),
            'certificado' => get_string('certificate', 'local_catalogo_eaduems'),
            'professor_tutor' => get_string('teacher', 'local_catalogo_eaduems'),
        ];
        $visiblefields = $this->get_visible_detail_metadata_fields(array_keys($rows));

        $items = '';
        foreach ($rows as $shortname => $label) {
            if (!in_array($shortname, $visiblefields, true)) {
                continue;
            }
            if (empty($metadata[$shortname]) || trim(html_to_text((string) $metadata[$shortname], 0, false)) === '') {
                continue;
            }
            $items .= html_writer::start_tag('li');
            $items .= html_writer::tag('strong', s($label));
            $items .= html_writer::span(s(trim(html_to_text((string) $metadata[$shortname], 0, false))));
            $items .= html_writer::end_tag('li');
        }

        if ($items === '') {
            return '';
        }

        return html_writer::tag('ul', $items, ['class' => 'catalogo-eaduems-metadata']);
    }

    private function render_course_sections(\stdClass $course, array $metadata): string {
        global $CFG;

        require_once($CFG->dirroot . '/course/lib.php');

        $fallback = $this->metadata_display($metadata, 'conteudo');
        $context = \context_course::instance($course->id);
        $format = \course_get_format($course);
        $sections = $format->get_sections();
        $items = [];

        foreach ($sections as $section) {
            if (empty($section->section) || empty($section->visible) || empty($section->uservisible)) {
                continue;
            }

            $title = $format->get_section_name($section);
            if ($title === '') {
                $title = get_string('coursesection', 'local_catalogo_eaduems', $section->section);
            }

            $summary = '';
            if (!empty($section->summary)) {
                $summarytext = file_rewrite_pluginfile_urls(
                    $section->summary,
                    'pluginfile.php',
                    $context->id,
                    'course',
                    'section',
                    $section->id
                );
                $summary = format_text($summarytext, $section->summaryformat, [
                    'context' => $context,
                    'overflowdiv' => true,
                ]);
            }

            $items[] = [
                'number' => count($items) + 1,
                'title' => $title,
                'summary' => $summary,
            ];
        }

        if (!empty($items)) {
            $output = html_writer::start_tag('ol', ['class' => 'catalogo-eaduems-sections']);
            foreach ($items as $item) {
                $output .= html_writer::start_tag('li');
                $output .= html_writer::span((string) $item['number'], 'catalogo-eaduems-sectionnumber');
                $output .= html_writer::start_div('catalogo-eaduems-sectioncontent');
                $output .= html_writer::tag('h4', s($item['title']));
                if ($item['summary'] !== '') {
                    $output .= html_writer::div($item['summary'], 'catalogo-eaduems-sectionsummary');
                }
                $output .= html_writer::end_div();
                $output .= html_writer::end_tag('li');
            }
            $output .= html_writer::end_tag('ol');

            return $output;
        }

        if ($fallback !== '') {
            return html_writer::div($fallback, 'catalogo-eaduems-summary');
        }

        return html_writer::div(get_string('coursecontent_empty', 'local_catalogo_eaduems'), 'catalogo-eaduems-empty');
    }

    private function metadata_display(array $metadata, string $shortname): string {
        if (empty($metadata[$shortname]) || trim((string) $metadata[$shortname]) === '') {
            return '';
        }

        return (string) $metadata[$shortname];
    }

    private function get_visible_detail_metadata_fields(array $defaultfields): array {
        $config = get_config('local_catalogo_eaduems', 'detailmetadatafields');
        if ($config === false || $config === null || $config === '') {
            return $defaultfields;
        }

        $fields = [];
        if (is_array($config)) {
            foreach ($config as $key => $enabled) {
                if ($enabled) {
                    $fields[] = $key;
                }
            }
        } else {
            $decoded = @unserialize((string) $config);
            if (is_array($decoded)) {
                foreach ($decoded as $key => $enabled) {
                    if ($enabled) {
                        $fields[] = $key;
                    }
                }
            } else {
                $fields = preg_split('/\s*,\s*/', (string) $config, -1, PREG_SPLIT_NO_EMPTY);
            }
        }

        return array_values(array_intersect($defaultfields, $fields));
    }

    private function render_whatsapp_share(\stdClass $course): string {
        $shareurl = (new moodle_url('/local/catalogo_eaduems/public/detalhes.php', ['id' => $course->id]))->out(false);
        $message = get_string('sharemessage', 'local_catalogo_eaduems', (object) [
            'fullname' => $course->fullname,
            'url' => $shareurl,
        ]);
        $whatsappurl = 'https://api.whatsapp.com/send?text=' . rawurlencode($message);

        return html_writer::link($whatsappurl, get_string('sharewhatsapp', 'local_catalogo_eaduems'), [
            'class' => 'catalogo-eaduems-share',
            'target' => '_blank',
            'rel' => 'noopener noreferrer',
        ]);
    }

    private function course_initials(string $coursename): string {
        $words = preg_split('/\s+/', trim(strip_tags($coursename)));
        $initials = '';
        foreach ($words as $word) {
            if ($word === '') {
                continue;
            }
            $initials .= \core_text::strtoupper(\core_text::substr($word, 0, 1));
            if (\core_text::strlen($initials) >= 2) {
                break;
            }
        }

        return $initials !== '' ? $initials : 'EU';
    }

    private function render_topbar(): string {
        global $PAGE, $USER;

        $output = html_writer::start_div('catalogo-eaduems-topbar');
        $output .= html_writer::tag('strong', s(get_string('pluginname', 'local_catalogo_eaduems')), ['class' => 'catalogo-eaduems-brand']);

        if (isloggedin() && !isguestuser()) {
            $logouturl = new moodle_url('/login/logout.php', ['sesskey' => sesskey()]);
            $dashboardurl = new moodle_url('/my/');
            $output .= html_writer::start_div('catalogo-eaduems-user');
            $output .= html_writer::span(s(get_string('loggedinas', 'local_catalogo_eaduems', fullname($USER))), 'catalogo-eaduems-username-display');
            $output .= html_writer::link($dashboardurl, get_string('mycourses', 'local_catalogo_eaduems'));
            $output .= html_writer::link($logouturl, get_string('logout'));
            $output .= html_writer::end_div();
        } else {
            $wantsurl = $PAGE->url instanceof moodle_url ? $PAGE->url->out_as_local_url(false) : '/local/catalogo_eaduems/public/index.php';
            $output .= html_writer::start_tag('form', [
                'class' => 'catalogo-eaduems-login',
                'method' => 'post',
                'action' => (new moodle_url('/login/index.php'))->out(false),
            ]);
            $output .= html_writer::label(get_string('username', 'local_catalogo_eaduems'), 'catalogo-eaduems-username', false, ['class' => 'visually-hidden']);
            $output .= html_writer::empty_tag('input', [
                'id' => 'catalogo-eaduems-username',
                'name' => 'username',
                'type' => 'text',
                'placeholder' => get_string('username', 'local_catalogo_eaduems'),
                'autocomplete' => 'username',
            ]);
            $output .= html_writer::label(get_string('password', 'local_catalogo_eaduems'), 'catalogo-eaduems-password', false, ['class' => 'visually-hidden']);
            $output .= html_writer::empty_tag('input', [
                'id' => 'catalogo-eaduems-password',
                'name' => 'password',
                'type' => 'password',
                'placeholder' => get_string('password', 'local_catalogo_eaduems'),
                'autocomplete' => 'current-password',
            ]);
            $output .= html_writer::empty_tag('input', [
                'name' => 'logintoken',
                'type' => 'hidden',
                'value' => \core\session\manager::get_login_token(),
            ]);
            $output .= html_writer::empty_tag('input', [
                'name' => 'wantsurl',
                'type' => 'hidden',
                'value' => $wantsurl,
            ]);
            $output .= html_writer::tag('button', s(get_string('login', 'local_catalogo_eaduems')), ['type' => 'submit']);
            $output .= html_writer::link(new moodle_url('/login/forgot_password.php'), get_string('recoverpassword', 'local_catalogo_eaduems'), [
                'class' => 'catalogo-eaduems-loginlink catalogo-eaduems-loginlink-muted',
            ]);
            $output .= html_writer::link(new moodle_url('/login/signup.php'), get_string('signup', 'local_catalogo_eaduems'), [
                'class' => 'catalogo-eaduems-loginlink catalogo-eaduems-loginlink-accent',
            ]);
            $output .= html_writer::end_tag('form');
        }

        $output .= html_writer::end_div();

        return $output;
    }

    private function render_navbar(): string {
        $links = [
            [
                'url' => new moodle_url('/local/catalogo_eaduems/public/index.php'),
                'label' => get_string('nav_catalog', 'local_catalogo_eaduems'),
            ],
            [
                'url' => new moodle_url('/course/'),
                'label' => get_string('nav_allcourses', 'local_catalogo_eaduems'),
            ],
        ];

        $output = html_writer::start_tag('nav', [
            'class' => 'catalogo-eaduems-nav',
            'aria-label' => get_string('navaria', 'local_catalogo_eaduems'),
        ]);
        foreach ($links as $link) {
            $output .= html_writer::link($link['url'], $link['label']);
        }
        $output .= html_writer::end_tag('nav');

        return $output;
    }
}

