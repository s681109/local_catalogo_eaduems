<?php
namespace local_catalogo_eaduems\local;

defined('MOODLE_INTERNAL') || die();

class config {
    public const DEFAULT_COURSES_PER_PAGE = 10;

    public static function courses_per_page(): int {
        $configured = (int) get_config('local_catalogo_eaduems', 'coursesperpage');

        if ($configured <= 0) {
            return self::DEFAULT_COURSES_PER_PAGE;
        }

        return min($configured, 100);
    }
}
