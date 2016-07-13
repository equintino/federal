<?php
// data for template
$todo = Utils::getTodoByGetId();
$tooLate = $todo->getStatus() == Todo::STATUS_PENDING && $todo->getDueOn() < new DateTime();

?>
