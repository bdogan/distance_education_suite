<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
$message = h($message);
}
?>
<p class="card-text <?= isset($params['class']) ? $params['class'] : '' ?>"><?= $message ?></p>
