<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlToView = url("comm");



?><h1>Ta bort ditt inlägg</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Till medlemssidan</a>
</p>
