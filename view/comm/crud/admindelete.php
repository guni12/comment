<?php

namespace Anax\View;

/**
 * View to delete a member.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

$posts = url("comm");

?>

<?= $form ?>

<p><span class="button"><a href="<?= $posts ?>">Medlemssidan</a></span></p>
