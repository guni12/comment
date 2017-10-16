<?php

namespace Anax\View;

/**
 * View to display all posts.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

//var_dump($items);
?>

<?php if (!$items) : ?>
    <p>Inga kommentarer i databasen.</p>
<?php
    return;
endif;
?>

<?= $items ?>
<p></p>
