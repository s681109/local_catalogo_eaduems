<?php
namespace local_catalogo_eaduems\output;

defined('MOODLE_INTERNAL') || die();

use html_writer;
use moodle_url;
use plugin_renderer_base;

class renderer extends plugin_renderer_base {

    public function render_shell(string $title, string $content, bool $showhero = true): string {
        $output = html_writer::start_div('local-catalogo-eaduems');
        $output .= $this->render_shared_portal_header($showhero);
        $output .= html_writer::div($content, 'catalogo-eaduems-content');
        $output .= html_writer::end_div();

        return $output;
    }

    private function render_shared_portal_header(bool $showlogin = true): string {
        global $CFG, $OUTPUT;

        if (!function_exists('theme_eaduems_portal_get_shared_institutional_header_context')) {
            return '';
        }

        $templatepath = $CFG->dirroot . '/theme/eaduems_portal/templates/portal_header.mustache';
        if (!is_readable($templatepath)) {
            return '';
        }

        $context = theme_eaduems_portal_get_shared_institutional_header_context([
            'contextvariant' => 'catalog-index',
            'showquicklogin' => $showlogin,
            'showportaltools' => $showlogin && isloggedin() && !isguestuser(),
            'showdashboardbutton' => false,
            'showsearch' => true,
            'searchaction' => (new moodle_url('/course/search.php'))->out(false),
            'searchparam' => 'q',
            'searchplaceholder' => get_string('searchplaceholder', 'local_catalogo_eaduems'),
            'searchlabel' => get_string('search', 'local_catalogo_eaduems'),
            'searchbuttonlabel' => get_string('search', 'local_catalogo_eaduems'),
        ]);

        try {
            return html_writer::div(
                $OUTPUT->render_from_template('theme_eaduems_portal/portal_header', $context),
                'eaduems-portal catalogo-eaduems-portalheader'
            );
        } catch (\Throwable $exception) {
            return '';
        }
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
        global $OUTPUT, $USER;

        $favoriteids = isloggedin() && !isguestuser()
            ? \local_catalogo_eaduems\local\favorite_service::get_course_ids($USER->id)
            : [];

        $output = $this->render_catalog_navigation();
        $output .= html_writer::start_div('catalogo-eaduems-layout');
        $output .= html_writer::start_tag('section', ['class' => 'catalogo-eaduems-results', 'aria-label' => get_string('catalogresults', 'local_catalogo_eaduems')]);
        $output .= $this->render_results_header($total, $filters);
        $output .= $this->render_category_filter($filters, $categories);
        $output .= html_writer::div($this->render_category_sidebar($filters, $categories), 'catalogo-eaduems-mobile-categories');
        if (!empty($courses)) {
            $output .= html_writer::start_div('catalogo-eaduems-cards');
            foreach ($courses as $course) {
                $output .= $this->render_course_card($course, in_array((int) $course->id, $favoriteids, true), $url);
            }
            $output .= html_writer::end_div();
            $output .= $OUTPUT->paging_bar($total, $page, $perpage, $url);
        } else {
            $output .= $this->render_empty_state($filters);
        }
        $output .= html_writer::end_tag('section');

        $output .= html_writer::start_tag('aside', ['class' => 'catalogo-eaduems-sidebar']);
        $output .= $this->render_category_sidebar($filters, $categories);
        $output .= html_writer::end_tag('aside');
        $output .= html_writer::end_div();

        return $output;
    }

    public function render_course_card(\stdClass $course, bool $isfavorite = false, ?moodle_url $returnurl = null): string {
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
        $output .= $this->render_favorite_toggle($course->id, $isfavorite, $returnurl);
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
        $output = $this->render_catalog_navigation($course);
        $output .= html_writer::start_div('catalogo-eaduems-details-layout');
        $output .= html_writer::start_tag('article', ['class' => 'catalogo-eaduems-details-main']);
        $output .= $this->render_course_media($course, 'catalogo-eaduems-details-media');
        if ($categoryname !== '') {
            $output .= html_writer::tag('p', s($categoryname), ['class' => 'catalogo-eaduems-detailcategory']);
        }
        $output .= html_writer::tag('h2', s($course->fullname));
        $output .= $this->render_course_highlights($course, $metadata);
        $output .= $this->render_favorite_toggle($course->id, $this->course_is_favorite($course->id), new moodle_url('/local/catalogo_eaduems/public/detalhes.php', ['id' => $course->id]));
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

    private function render_catalog_navigation(?\stdClass $course = null, bool $isfavoritespage = false): string {
        global $USER;

        $homeurl = new moodle_url('/');
        $catalogurl = new moodle_url('/local/catalogo_eaduems/public/index.php');
        $favoritesurl = new moodle_url('/local/catalogo_eaduems/public/favoritos.php');
        $homecontent = html_writer::span('&#xf015;', 'catalogo-eaduems-homeicon', ['aria-hidden' => 'true']);
        $homecontent .= html_writer::span(s(get_string('homepage', 'local_catalogo_eaduems')));

        $output = html_writer::start_tag('nav', [
            'class' => 'catalogo-eaduems-breadcrumbs',
            'aria-label' => get_string('breadcrumblabel', 'local_catalogo_eaduems'),
        ]);
        $output .= html_writer::link($homeurl, $homecontent, ['class' => 'catalogo-eaduems-homebutton']);
        $output .= html_writer::span('›', 'catalogo-eaduems-breadcrumbseparator', ['aria-hidden' => 'true']);

        if ($course === null) {
            $output .= html_writer::tag('span', s(get_string('nav_catalog', 'local_catalogo_eaduems')), [
                'aria-current' => 'page',
            ]);
        } else {
            $output .= html_writer::link($catalogurl, get_string('nav_catalog', 'local_catalogo_eaduems'));
            $output .= html_writer::span('›', 'catalogo-eaduems-breadcrumbseparator', ['aria-hidden' => 'true']);
            $output .= html_writer::tag('span', s($course->fullname), [
                'aria-current' => 'page',
            ]);
        }

        if (isloggedin() && !isguestuser()) {
            $output .= html_writer::span('›', 'catalogo-eaduems-breadcrumbseparator', ['aria-hidden' => 'true']);
            if ($isfavoritespage) {
                $output .= html_writer::tag('span', s(get_string('favorites', 'local_catalogo_eaduems')), [
                    'aria-current' => 'page',
                ]);
            } else {
                $output .= html_writer::link($favoritesurl, get_string('favorites', 'local_catalogo_eaduems'));
            }
        }

        $output .= html_writer::end_tag('nav');

        return $output;
    }

    public function render_favorites_page(array $courses): string {
        $output = $this->render_catalog_navigation(null, true);
        $output .= html_writer::start_div('catalogo-eaduems-favoritespage');
        $output .= html_writer::tag('h2', s(get_string('favorites', 'local_catalogo_eaduems')));
        $output .= html_writer::tag('p', s(get_string('favoritesdesc', 'local_catalogo_eaduems')));
        if (empty($courses)) {
            $output .= html_writer::div(get_string('favoritesempty', 'local_catalogo_eaduems'), 'catalogo-eaduems-empty');
        } else {
            $output .= html_writer::start_div('catalogo-eaduems-cards');
            foreach ($courses as $course) {
                $output .= $this->render_course_card($course, true, new moodle_url('/local/catalogo_eaduems/public/favoritos.php'));
            }
            $output .= html_writer::end_div();
        }
        $output .= html_writer::end_div();

        return $output;
    }

    private function course_is_favorite(int $courseid): bool {
        global $USER;

        return isloggedin() && !isguestuser()
            && \local_catalogo_eaduems\local\favorite_service::is_favorite($USER->id, $courseid);
    }

    private function render_favorite_toggle(int $courseid, bool $isfavorite, ?moodle_url $returnurl = null): string {
        if (!isloggedin() || isguestuser()) {
            return '';
        }

        $actionurl = new moodle_url('/local/catalogo_eaduems/public/favorito.php');
        $returnurl = $returnurl ?? new moodle_url('/local/catalogo_eaduems/public/index.php');
        $label = $isfavorite
            ? get_string('removefavorite', 'local_catalogo_eaduems')
            : get_string('savefavorite', 'local_catalogo_eaduems');
        $classes = 'catalogo-eaduems-favoritebutton' . ($isfavorite ? ' is-favorite' : '');

        $output = html_writer::start_tag('form', [
            'action' => $actionurl->out(false),
            'class' => 'catalogo-eaduems-favoriteform',
            'method' => 'post',
        ]);
        $output .= html_writer::empty_tag('input', ['name' => 'courseid', 'type' => 'hidden', 'value' => $courseid]);
        $output .= html_writer::empty_tag('input', ['name' => 'returnurl', 'type' => 'hidden', 'value' => $returnurl->out(false)]);
        $output .= html_writer::empty_tag('input', ['name' => 'sesskey', 'type' => 'hidden', 'value' => sesskey()]);
        $output .= html_writer::tag('button', s($label), ['class' => $classes, 'type' => 'submit']);
        $output .= html_writer::end_tag('form');

        return $output;
    }

    private function render_category_filter(array $filters, array $categories): string {
        $currentcategory = (int) ($filters['category'] ?? 0);
        $search = trim((string) ($filters['search'] ?? ''));
        $output = html_writer::start_tag('form', [
            'action' => 'index.php',
            'method' => 'get',
            'class' => 'catalogo-eaduems-categoryfilter',
        ]);
        $output .= html_writer::label(get_string('search', 'local_catalogo_eaduems'), 'catalogo-eaduems-search', false, ['class' => 'visually-hidden']);
        $output .= html_writer::empty_tag('input', [
            'id' => 'catalogo-eaduems-search',
            'name' => 'search',
            'type' => 'search',
            'value' => $search,
            'placeholder' => get_string('catalogsearchplaceholder', 'local_catalogo_eaduems'),
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

        if ($currentcategory > 0) {
            foreach ($categories as $category) {
                if ((int) $category->id !== $currentcategory) {
                    continue;
                }

                $activecontent = html_writer::span(s(get_string('activefilter', 'local_catalogo_eaduems')), 'catalogo-eaduems-activefilter-label');
                $activecontent .= html_writer::span(s($category->name), 'catalogo-eaduems-activefilter-name');
                $output .= html_writer::div($activecontent, 'catalogo-eaduems-activefilter', [
                    'role' => 'status',
                ]);
                break;
            }
        }

        if ($search !== '') {
            $searchcontent = html_writer::span(s(get_string('searchactive', 'local_catalogo_eaduems', $search)), 'catalogo-eaduems-activefilter-name');
            $output .= html_writer::div($searchcontent, 'catalogo-eaduems-activefilter', [
                'role' => 'status',
            ]);
        }

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
                'label' => $prefix . $category->name . ' (' . (int) ($category->visiblecoursecount ?? 0) . ')',
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

    private function render_empty_state(array $filters): string {
        $hasfilters = !empty($filters['category']) || trim((string) ($filters['search'] ?? '')) !== '';
        if (!$hasfilters) {
            return html_writer::div(get_string('emptycatalog', 'local_catalogo_eaduems'), 'catalogo-eaduems-empty');
        }

        $output = html_writer::start_div('catalogo-eaduems-empty catalogo-eaduems-empty--filtered');
        $output .= html_writer::tag('h2', s(get_string('emptyfilteredtitle', 'local_catalogo_eaduems')));
        $output .= html_writer::tag('p', s(get_string('emptyfiltereddesc', 'local_catalogo_eaduems')));
        $output .= html_writer::link(new moodle_url('/local/catalogo_eaduems/public/index.php'), get_string('clearfilters', 'local_catalogo_eaduems'), [
            'class' => 'catalogo-eaduems-button catalogo-eaduems-button-secondary',
        ]);
        $output .= html_writer::end_div();

        return $output;
    }

    private function render_course_highlights(\stdClass $course, array $metadata): string {
        $rows = [
            'category' => get_string('category', 'local_catalogo_eaduems'),
            'duracao' => get_string('duration', 'local_catalogo_eaduems'),
            'nivel' => get_string('level', 'local_catalogo_eaduems'),
            'certificado' => get_string('certificate', 'local_catalogo_eaduems'),
            'publico' => get_string('publictarget', 'local_catalogo_eaduems'),
        ];
        $visiblefields = $this->get_visible_detail_metadata_fields(array_keys($rows));
        $items = '';

        foreach ($rows as $shortname => $label) {
            if ($shortname !== 'category' && !in_array($shortname, $visiblefields, true)) {
                continue;
            }

            $rawvalue = $shortname === 'category'
                ? (string) ($course->categoryname ?? '')
                : (string) ($metadata[$shortname] ?? '');
            $value = trim(html_to_text($rawvalue, 0, false));
            if ($value === '') {
                continue;
            }

            $items .= html_writer::start_tag('div');
            $items .= html_writer::tag('dt', s($label));
            $items .= html_writer::tag('dd', s($value));
            $items .= html_writer::end_tag('div');
        }

        if ($items === '') {
            return '';
        }

        $output = html_writer::start_tag('section', ['class' => 'catalogo-eaduems-highlights', 'aria-label' => get_string('coursehighlights', 'local_catalogo_eaduems')]);
        $output .= html_writer::tag('h3', s(get_string('coursehighlights', 'local_catalogo_eaduems')), ['class' => 'visually-hidden']);
        $output .= html_writer::tag('dl', $items);
        $output .= html_writer::end_tag('section');

        return $output;
    }

    private function render_course_media(\stdClass $course, string $class = 'catalogo-eaduems-cardmedia'): string {
        $image = \core_course\external\course_summary_exporter::get_course_image($course);
        if ($image) {
            return html_writer::img($image, s($course->fullname), ['class' => $class]);
        }

        $content = html_writer::span(
            s(get_string('courseimageplaceholder', 'local_catalogo_eaduems')),
            'catalogo-eaduems-fallbacklabel'
        );
        $content .= html_writer::span(
            s($this->course_initials($course->fullname)),
            'catalogo-eaduems-fallbackinitials'
        );

        return html_writer::div($content, $class . ' catalogo-eaduems-fallback', [
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
            $value = trim(html_to_text((string) ($metadata[$shortname] ?? ''), 0, false));
            if ($value === '') {
                continue;
            }
            $items .= html_writer::start_tag('li');
            $items .= html_writer::span(s($label), 'catalogo-eaduems-metakey');
            $items .= html_writer::span(s($value), 'catalogo-eaduems-metavalue');
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
}
