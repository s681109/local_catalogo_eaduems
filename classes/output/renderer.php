<?php
namespace local_catalogo_eaduems\output;

defined('MOODLE_INTERNAL') || die();

use html_writer;
use moodle_url;
use plugin_renderer_base;

class renderer extends plugin_renderer_base {

    public function render_shell(string $title, string $content, bool $showhero = true): string {
        $output = html_writer::start_div('local-catalogo-eaduems');
        $output .= $this->render_topbar();
        $output .= $this->render_navbar();
        if ($showhero) {
            $output .= html_writer::start_div('catalogo-eaduems-hero');
            $output .= html_writer::start_div('catalogo-eaduems-hero-inner');
            $output .= html_writer::tag('span', s(get_string('cataloghero_kicker', 'local_catalogo_eaduems')), ['class' => 'catalogo-eaduems-kicker']);
            $output .= html_writer::tag('h1', s($title));
            $output .= html_writer::tag('p', s(get_string('cataloghero_subtitle', 'local_catalogo_eaduems')), ['class' => 'catalogo-eaduems-subtitle']);
            $output .= html_writer::end_div();
            $output .= html_writer::end_div();
        }
        $output .= html_writer::div($content, 'catalogo-eaduems-content');
        $output .= html_writer::end_div();

        return $output;
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
            $output .= html_writer::tag('p', s(get_string('authenticatedactions_desc', 'local_catalogo_eaduems')));
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
        foreach ($this->category_options($categories) as $value => $optionlabel) {
            $attrs = ['value' => (string) $value];
            if ((string) $value === $current) {
                $attrs['selected'] = 'selected';
            }
            $output .= html_writer::tag('option', s($optionlabel), $attrs);
        }
        $output .= html_writer::end_tag('select');
        $output .= html_writer::tag('button', s(get_string('filter', 'local_catalogo_eaduems')), ['type' => 'submit']);
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
            $classes = 'catalogo-eaduems-categoryitem';
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
            $options[$category->id] = $category->name;
        }

        return $options;
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
            'nivel' => get_string('level', 'local_catalogo_eaduems'),
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
