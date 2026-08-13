<?php
namespace local_catalogo_eaduems\local;

defined('MOODLE_INTERNAL') || die();

class customfield_helper {
    public const COMPONENT = 'core_course';
    public const AREA = 'course';

    public function get_course_metadata(int $courseid): array {
        $metadata = [];
        $handler = \core_customfield\handler::get_handler(self::COMPONENT, self::AREA);
        $instancesdata = $handler->get_instance_data($courseid);

        foreach ($instancesdata as $data) {
            $shortname = $data->get_field()->get('shortname');
            $value = $data->export_value();
            $metadata[$shortname] = $value;
        }

        return $metadata;
    }

    public function get_select_field_info(string $shortname): array {
        global $DB;

        $field = $DB->get_record_sql(
            "SELECT f.id, f.configdata
               FROM {customfield_field} f
               JOIN {customfield_category} cfc ON cfc.id = f.categoryid
              WHERE cfc.component = :component
                AND cfc.area = :area
                AND f.shortname = :shortname",
            [
                'component' => self::COMPONENT,
                'area' => self::AREA,
                'shortname' => $shortname,
            ],
            IGNORE_MISSING
        );

        if (!$field) {
            return [];
        }

        $config = json_decode($field->configdata ?? '', true);
        if (!is_array($config) || empty($config['options'])) {
            return [];
        }

        $labels = [];
        $options = preg_split('/\R/', (string) $config['options']);
        foreach ($options as $index => $label) {
            $label = trim($label);
            if ($label !== '') {
                $labels[$index + 1] = $label;
            }
        }

        $defaultindex = 0;
        if (!empty($config['defaultvalue'])) {
            foreach ($labels as $index => $label) {
                if ((string) $label === (string) $config['defaultvalue']) {
                    $defaultindex = (int) $index;
                    break;
                }
            }
        }

        return [
            'id' => (int) $field->id,
            'shortname' => $shortname,
            'labels' => $labels,
            'defaultindex' => $defaultindex,
        ];
    }

    public function get_used_select_options(array $fieldinfo): array {
        global $DB;

        if (empty($fieldinfo['id']) || empty($fieldinfo['labels'])) {
            return [];
        }

        $usedvalues = $DB->get_fieldset_sql(
            "SELECT DISTINCT d.intvalue
               FROM {customfield_data} d
               JOIN {course} c ON c.id = d.instanceid
               JOIN {course_categories} cc ON cc.id = c.category
              WHERE d.fieldid = :fieldid
                AND d.intvalue > 0
                AND c.visible = 1
                AND c.id > 1
                AND cc.visible = 1
           ORDER BY d.intvalue ASC",
            ['fieldid' => $fieldinfo['id']]
        );

        $options = [];
        foreach ($usedvalues as $value) {
            $value = (int) $value;
            if (isset($fieldinfo['labels'][$value])) {
                $options[$value] = $fieldinfo['labels'][$value];
            }
        }

        if (!empty($fieldinfo['defaultindex']) && isset($fieldinfo['labels'][$fieldinfo['defaultindex']])) {
            $options[$fieldinfo['defaultindex']] = $fieldinfo['labels'][$fieldinfo['defaultindex']];
        }

        ksort($options);
        return $options;
    }

    public function filter_sql(string $shortname, int $value, array $fieldinfo, array &$params): string {
        if ($value <= 0 || empty($fieldinfo['id'])) {
            return '';
        }

        $prefix = preg_replace('/[^a-z0-9_]/', '', $shortname);
        $defaultsql = '';
        if (!empty($fieldinfo['defaultindex']) && (int) $fieldinfo['defaultindex'] === $value) {
            $defaultsql = " OR NOT EXISTS (
                SELECT 1
                  FROM {customfield_data} {$prefix}missing
                 WHERE {$prefix}missing.instanceid = c.id
                   AND {$prefix}missing.fieldid = :{$prefix}missingfieldid
            )";
            $params[$prefix . 'missingfieldid'] = $fieldinfo['id'];
        }

        $params[$prefix . 'component'] = self::COMPONENT;
        $params[$prefix . 'area'] = self::AREA;
        $params[$prefix . 'field'] = $shortname;
        $params[$prefix . 'value'] = $value;

        return " AND (EXISTS (
            SELECT 1
              FROM {customfield_data} d{$prefix}
              JOIN {customfield_field} f{$prefix} ON f{$prefix}.id = d{$prefix}.fieldid
              JOIN {customfield_category} c{$prefix} ON c{$prefix}.id = f{$prefix}.categoryid
             WHERE d{$prefix}.instanceid = c.id
               AND c{$prefix}.component = :{$prefix}component
               AND c{$prefix}.area = :{$prefix}area
               AND f{$prefix}.shortname = :{$prefix}field
               AND d{$prefix}.intvalue = :{$prefix}value
        ){$defaultsql})";
    }
}
