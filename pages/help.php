<div class="wrap">
    <h2>Basic Status of My Tables</h2>

    <p>Plugin helping WordPress Developers - by <a href="http://bimal.org.np/">Bimal Poudel</a> | <code>SHOW TABLE
            STATUS;</code> in: <a href="http://dev.mysql.com/doc/refman/5.7/en/show-table-status.html">MySQL</a> | <a
                href="https://mariadb.com/kb/en/mariadb/show-table-status/">MariaDB</a>.</p>

    <?php
    $mtp = new my_tables_processor();
    $tables = $mtp->table_status();
    $columns = $mtp->table_columns();
    echo $mtp->html_table($tables, $columns);
    ?>

    <h3>Sizes per table</h3>
    <div>
        <p>The list is sorted by table size. <a
                    href="https://gist.github.com/bimalpoudel/16d3539bed6e55879c00ff1c71ac63ff#file-sizes-per-tables-sql">View
                SQL Details</a>.</p>
    </div>
    <?php
    $mtp = new my_tables_processor();
    $tables = $mtp->table_sizes();
    $columns = $mtp->columns_sizes();
    echo $mtp->html_table($tables, $columns);
    ?>

    <h3>Optimization Tips</h3>
    <p>When you finished debugging or troubleshooting your website; disable this plugin for <a
                href="http://goo.gl/IF6jV2">micro-optimization reasons</a>.</p>
    <h3>General Considerations (External Links)</h3>
    <ol>
        <li>Determine which storage engine is good for you?</li>
        <li>Homogeneous collation, <a href="https://dev.mysql.com/doc/refman/5.7/en/charset-collation-effect.html">Effect
                of Collation</a></li>
        <li>Less index data (or reindexing required)</li>
        <li><a href="http://dev.mysql.com/doc/refman/5.7/en/optimization.html">Optimizing MySQL</a></li>
    </ol>
</div>
