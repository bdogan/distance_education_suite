<?php
/**
 * Default layout
 *
 * @var \App\View\AppView $this
 * @var \Cake\ORM\Query $lessonTopics
 */

$lessons = $lessonTopics->order([ 'lesson ASC', 'subject ASC' ])->indexBy('lesson')->map(function ($l) { return $l->lesson; });
$cursor = 0;
?>
<div class="accordion" id="accordionExample">
	
            <?php foreach ($lessons as $key => $lesson): ?>
                <?php
                    $_lessonTopics = $lessonTopics->filter(function ($l) use ($lesson) { return $l->lesson === $lesson; });
                    if (!$_lessonTopics->count()) continue;
                ?>
  <div>
    <div id="heading<?=$cursor;?>">
        <button class="btn btn-link classbtn" type="button" data-toggle="collapse" data-target="#collapse<?=$cursor;?>" aria-expanded="true" aria-controls="collapse<?=$cursor;?>">
			<p><?=$lesson?> <span>[ <?=$_lessonTopics->count()?> Konu İşlendi ]</span></p>        
        </button>
    </div> 
                   
    <div id="collapse<?=$cursor;?>" class="collapse" aria-labelledby="heading<?=$cursor;?>" data-parent="#accordionExample">
	    <div class="dersler">
	    <ul>
	  		<?php foreach ($_lessonTopics as $lessonTopic): ?>
	  		<li><a href="<?=$this->Url->build([ 'controller' => 'LessonTopics', 'action' => 'view', $lessonTopic->id ]);?>"><?=$lessonTopic->subject?></a></li>
            <?php endforeach; ?>
	    </ul>
	    </div>
    </div>
                <?php
                    $cursor++;
                ?>
           <?php endforeach; ?>
  </div>
</div>