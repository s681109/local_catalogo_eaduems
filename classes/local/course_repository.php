<?php
namespace local_catalogo_eaduems\local;

defined('MOODLE_INTERNAL') || die();

class course_repository {
    private customfield_helper $customfields;

    public function __construct(?customfield_helper $customfields = null) {
        $this->customfields = $customfields ?? new customfield_helper();
    }

    public function get_visible_course(int $courseid): \stdClass {
        global $DB;

        return $DB->get_record_sql(
            "SELECT c.*, cc.name AS categoryname
               FROM {course} c
               JOIN {course_categories} cc ON cc.id = c.category
              WHERE c.id = :courseid
                AND c.id > 1
                AND c.visible = 1
                AND cc.visible = 1",
            ['courseid' => $courseid],
            MUST_EXIST
        );
    }

    public function get_catalog(array $filters, int $page, int $perpage): array {
        global $DB;

        [$where, $params] = $this->build_where($filters);
        $from = "FROM {course} c JOIN {course_categories} cc ON cc.id = c.category";
        $orderby = $this->get_sort_orderby($filters['sort'] ?? 'name');

        $total = $DB->count_records_sql("SELECT COUNT(1) {$from} WHERE {$where}", $params);
        $courses = $DB->get_records_sql(
            "SELECT c.*, cc.name AS categoryname {$from} WHERE {$where} ORDER BY {$orderby}",
            $params,
            $page * $perpage,
            $perpage
        );

        return [
            'total' => $total,
            'courses' => $courses,
        ];
    }

    public function get_visible_courses_by_ids(array $courseids): array {
        global $DB;

        if (empty($courseids)) {
            return [];
        }

        [$insql, $params] = $DB->get_in_or_equal($courseids, SQL_PARAMS_NAMED, 'favoritecourse');
        return $DB->get_records_sql(
            "SELECT c.*, cc.name AS categoryname
               FROM {course} c
               JOIN {course_categories} cc ON cc.id = c.category
              WHERE c.id {$insql}
                AND c.id > 1
                AND c.visible = 1
                AND cc.visible = 1
           ORDER BY c.fullname ASC",
            $params
        );
    }

    public function get_visible_categories(): array {
        global $DB;

        $categories = $DB->get_records_sql(
            "SELECT cc.id, cc.name, cc.parent, cc.path, cc.depth, cc.sortorder
               FROM {course_categories} cc
              WHERE cc.visible = 1
           ORDER BY cc.sortorder ASC"
        );

        if (empty($categories)) {
            return [];
        }

        $directcounts = $DB->get_records_sql_menu(
            "SELECT c.category, COUNT(1) AS visiblecoursecount
               FROM {course} c
               JOIN {course_categories} cc ON cc.id = c.category
              WHERE c.visible = 1
                AND c.id > 1
                AND cc.visible = 1
           GROUP BY c.category"
        );

        foreach ($categories as $category) {
            $category->directcoursecount = (int) ($directcounts[$category->id] ?? 0);
            $category->visiblecoursecount = 0;
            $category->haschildren = false;
        }

        foreach ($categories as $category) {
            $directcount = (int) ($directcounts[$category->id] ?? 0);
            if ($directcount <= 0) {
                continue;
            }

            foreach ($this->category_path_ids((string) $category->path) as $ancestorid) {
                if (isset($categories[$ancestorid])) {
                    $categories[$ancestorid]->visiblecoursecount += $directcount;
                }
            }
        }

        foreach ($categories as $category) {
            if ((int) $category->parent > 0 && isset($categories[$category->parent])) {
                $categories[$category->parent]->haschildren = true;
            }
        }

        return array_values(array_filter($categories, static function($category): bool {
            return (int) $category->visiblecoursecount > 0;
        }));
    }

    public function get_sort_options(): array {
        return [
            'name' => get_string('sort_name', 'local_catalogo_eaduems'),
            'category' => get_string('sort_category', 'local_catalogo_eaduems'),
            'recent' => get_string('sort_recent', 'local_catalogo_eaduems'),
        ];
    }

    private function build_where(array $filters): array {
        global $DB;

        $where = 'c.visible = 1 AND c.id > 1 AND cc.visible = 1';
        $params = [];

        if (!empty($filters['category'])) {
            $categoryids = $this->get_visible_category_filter_ids((int) $filters['category']);
            if (empty($categoryids)) {
                $where .= ' AND c.category = :categoryidmissing';
                $params['categoryidmissing'] = -1;
            } else {
                [$categorysql, $categoryparams] = $DB->get_in_or_equal($categoryids, SQL_PARAMS_NAMED, 'categoryfilter');
                $where .= " AND c.category {$categorysql}";
                $params = array_merge($params, $categoryparams);
            }
        }

        $search = trim((string) ($filters['search'] ?? ''));
        if ($search !== '') {
            $conditions = [
                $DB->sql_like('c.fullname', ':searchfullname', false),
                $DB->sql_like('c.shortname', ':searchshortname', false),
                $DB->sql_like('c.summary', ':searchsummary', false),
            ];
            $where .= ' AND (' . implode(' OR ', $conditions) . ')';
            $params['searchfullname'] = '%' . $search . '%';
            $params['searchshortname'] = '%' . $search . '%';
            $params['searchsummary'] = '%' . $search . '%';
        }

        foreach (['nivel', 'certificado'] as $field) {
            $value = (int) ($filters[$field] ?? 0);
            if ($value > 0) {
                $fieldinfo = $this->customfields->get_select_field_info($field);
                $where .= $this->customfields->filter_sql($field, $value, $fieldinfo, $params);
            }
        }

        return [$where, $params];
    }

    private function get_visible_category_filter_ids(int $categoryid): array {
        global $DB;

        $category = $DB->get_record('course_categories', [
            'id' => $categoryid,
            'visible' => 1,
        ], 'id, path', IGNORE_MISSING);

        if (!$category) {
            return [];
        }

        $like = $DB->sql_like('path', ':categorypath', false);
        $records = $DB->get_records_sql(
            "SELECT id
               FROM {course_categories}
              WHERE visible = 1
                AND (id = :categoryid OR {$like})",
            [
                'categoryid' => $categoryid,
                'categorypath' => $category->path . '/%',
            ]
        );

        return array_map('intval', array_keys($records));
    }

    private function category_path_ids(string $path): array {
        $ids = array_filter(explode('/', trim($path, '/')), static function($id): bool {
            return $id !== '';
        });

        return array_map('intval', $ids);
    }

    private function get_sort_orderby(string $sort): string {
        $orders = [
            'name' => 'c.fullname ASC',
            'category' => 'cc.sortorder ASC, cc.name ASC, c.fullname ASC',
            'recent' => 'c.timecreated DESC, c.fullname ASC',
        ];

        return $orders[$sort] ?? $orders['name'];
    }
}
