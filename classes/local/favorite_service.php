<?php
namespace local_catalogo_eaduems\local;

defined('MOODLE_INTERNAL') || die();

class favorite_service {
    private const TABLE = 'local_catalogo_eaduems_fav';

    public static function is_favorite(int $userid, int $courseid): bool {
        global $DB;

        return $DB->record_exists(self::TABLE, ['userid' => $userid, 'courseid' => $courseid]);
    }

    public static function toggle(int $userid, int $courseid): bool {
        global $DB;

        $record = $DB->get_record(self::TABLE, ['userid' => $userid, 'courseid' => $courseid]);
        if ($record) {
            $DB->delete_records(self::TABLE, ['id' => $record->id]);
            return false;
        }

        $DB->insert_record(self::TABLE, (object) [
            'userid' => $userid,
            'courseid' => $courseid,
            'timecreated' => time(),
        ]);
        return true;
    }

    public static function get_course_ids(int $userid): array {
        global $DB;

        return array_map('intval', array_values($DB->get_records_menu(self::TABLE, ['userid' => $userid], 'timecreated DESC', 'id, courseid')));
    }
}
