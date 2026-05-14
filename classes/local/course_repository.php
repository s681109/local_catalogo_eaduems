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

    public function get_visible_categories(): array {
        global $DB;

        return $DB->get_records_sql(
            "SELECT cc.*
               FROM {course_categories} cc
              WHERE cc.visible = 1
                AND EXISTS (
                    SELECT 1
                      FROM {course} c
                     WHERE c.category = cc.id
                       AND c.visible = 1
                       AND c.id > 1
                )
           ORDER BY cc.sortorder ASC"
        );
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
            $where .= ' AND c.category = :categoryid';
            $params['categoryid'] = (int) $filters['category'];
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

    private function get_sort_orderby(string $sort): string {
        $orders = [
            'name' => 'c.fullname ASC',
            'category' => 'cc.sortorder ASC, cc.name ASC, c.fullname ASC',
            'recent' => 'c.timecreated DESC, c.fullname ASC',
        ];

        return $orders[$sort] ?? $orders['name'];
    }
}
