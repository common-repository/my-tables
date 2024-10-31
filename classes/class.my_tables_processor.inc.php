<?php

class my_tables_processor
{
    /**
     * Ordered List of columns to report
     * CaSe SEnsiTive
     */
    private $required_fields = array(
        'Name',
        'Engine',
        'Rows',
        #'Avg_row_length',
        'Index_length',
        'Auto_increment',
        'Create_time',
        'Collation',
        'Comment',
    );

    /**
     * Helper to convert uniformed PHP array data into Basic HTML Table
     *
     * @param array $data
     *
     * @return string
     */
    public function html_table($data = array(), $heads = array())
    {
        $styles = array();
        $theads = array();
        foreach ($heads as $cell) {
            $cell_word = strtolower($cell);
            $styles[] = $cell_word;

            $cell_name = ucwords(implode(' ', explode('_', $cell)));
            $theads[] = "<td class='{$cell_word}'>{$cell_name}</td>";
        }

        $rows = array();
        foreach ($data as $row) {
            $cells = array();

            $styles_index = -1;
            foreach ($row as $cell) {
                ++$styles_index;
                $cells[] = "<td class='{$styles[$styles_index]}'>{$cell}</td>";
            }
            $rows[] = "<tr>" . implode('', $cells) . "</tr>";
        }

        return "
<table class='my-tables wp-list-table widefat striped'>

	<thead><tr>" . implode('', $theads) . "</tr></thead>
	<tbody>" . implode('', $rows) . "</tbody>
</table>";
    }

    public function table_columns()
    {
        return $this->required_fields;
    }

    /**
     * Filters a list of columns
     */
    public function table_status()
    {
        global $wpdb;
        $tables = $wpdb->get_results("SHOW TABLE STATUS;");

        $data = array();
        foreach ($tables as $table) {
            $row = array();
            foreach ($this->required_fields as $column) {
                $row[$column] = $table->$column;
            }
            $data[] = $row;
        }
        return $data;
    }

    public function table_sizes()
    {
        $sizes_sql = "
SELECT
	ROUND(KBS/POWER(1024,1), 2) KBs,
	ROUND(KBS/POWER(1024,2), 2) MBs,
	table_name
FROM
(
	SELECT
		table_name, SUM(index_length) KBS
	FROM information_schema.tables
	WHERE
		table_schema = DATABASE()
	GROUP BY table_name
) A
ORDER BY
	KBS DESC
;";
        global $wpdb;
        $tables = $wpdb->get_results($sizes_sql);
        $data = array();
        foreach ($tables as $table) {
            $data[] = (array)$table;
        }
        return $data;
    }

    public function columns_sizes()
    {
        $columns = array('In KBs', 'In MBs', 'Table Name');
        return $columns;
    }
}
