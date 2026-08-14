<?php
defined('MOODLE_INTERNAL') || die();

function xmldb_local_catalogo_eaduems_upgrade(int $oldversion): bool {
    global $DB;

    if ($oldversion < 2026081500) {
        $table = new xmldb_table('local_catalogo_eaduems_fav');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_index('usercourse_uix', XMLDB_INDEX_UNIQUE, ['userid', 'courseid']);
        $table->add_index('course_ix', XMLDB_INDEX_NOTUNIQUE, ['courseid']);

        if (!$DB->get_manager()->table_exists($table)) {
            $DB->get_manager()->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2026081500, 'local', 'catalogo_eaduems');
    }

    return true;
}
