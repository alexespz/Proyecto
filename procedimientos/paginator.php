<?php
try {
    // Find out how many items are in the table
    $total = $dbh->query('SELECT COUNT(*) FROM table')->fetchColumn();

    // How many items to list per page
    $limit = 20;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // Display the paging information
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    // Prepare the paged query
    $stmt = $dbh->prepare('
        SELECT
            *
        FROM
            table
        ORDER BY
            name
        LIMIT
            :limit
        OFFSET
            :offset
    ');

    // Bind the query params
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Do we have any results?
    if ($stmt->rowCount() > 0) {
        // Define how we want to fetch the results
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($stmt);

        // Display the results
        foreach ($iterator as $row) {
            echo '<p>', $row['name'], '</p>';
        }

    } else {
        echo '<p>No results could be displayed.</p>';
    }

} catch (Exception $e) {
    echo '<p>', $e->getMessage(), '</p>';
}







class Paginator{

    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    public function __construct($conn, $query){
        $this->_conn = $conn;
        $this->_query = $query;

        $rs = $this->_conn->query($this->_query);
        $this->_total = $rs->num_rows;

    }

    public function getData($limit = 10, $page = 1 ) {
        $this->_limit = $limit;
        $this->_page = $page;

        if( $this->_limit == 'all' ){
            $query = $this->_query;
        }else{
            $query = $this->_query."LIMIT".(($this->_page - 1) * $this->_limit).", $this->_limit";
        }
        $rs = $this->_conn->query($query);

        while($row = $rs->fetch_assoc()) {
            $results[] = $row;
        }

        $result = new stdClass();
        $result->page = $this->_page;
        $result->limit = $this->_limit;
        $result->total = $this->_total;
        $result->data = $results;

        return $result;
    }

    public function createLinks($links, $list_class){
        if($this->_limit == 'all'){
            return '';
        }

        $last = ceil( $this->_total / $this->_limit );

        $start = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html = '<ul class="'.$list_class.'">';

        $class = ($this->_page == 1) ? "disabled" : "";
        $html .= '<li class="'.$class.'"><a href="?limit='.$this->_limit.'&page='.($this->_page - 1).'">&laquo;</a></li>';

        if($start > 1){
            $html .= '<li><a href="?limit='.$this->_limit.'&page=1">1</a></li>';
            $html .= '<li class="disabled"><span>...</span></li>';
        }

        for($i = $start ; $i <= $end; $i++){
            $class = ($this->_page == $i) ? "active" : "";
            $html .= '<li class="'.$class.'"><a href="?limit='.$this->_limit.'&page='.$i.'">'.$i.'</a></li>';
        }

        if($end < $last){
            $html .= '<li class="disabled"><span>...</span></li>';
            $html .= '<li><a href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
        }

        $class = ($this->_page == $last) ? "disabled" : "";
        $html .= '<li class="'.$class.'"><a href="?limit='.$this->_limit.'&page='.($this->_page + 1).'">&raquo;</a></li>';
        $html .= '</ul>';

        return $html;
    }

}