<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (empty($params['class'])) {
    $params['class'] = 'info';
}
$class = sprintf('alert alert-%s alert-dismissible fade show', $params['class']);
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="row">
    <div class="col-12">
        <div class="<?= h($class) ?>alert alert-warning alert-dismissible fade show" role="alert">
            <?= $message ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
