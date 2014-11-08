<section id="backend_item_links">
<?php 
echo $this->Html->link('Video Games',array('controller'=>'backend','action'=>'vg_index')); 
echo $this->Html->link('Platforms', array('controller'=>'backend', 'action'=>'platform_index'));
echo $this->Html->link('Consoles',array('controller'=>'backend','action'=>'console_index'));
echo $this->Html->link('Trading Card Games',array('controller'=>'backend','action'=>'tcg_index'));
echo $this->Html->link('Tcg Brands',array('controller'=>'backend','action'=>'tcg_brand_index'));
echo $this->Html->link('Tcg Expansions', array('controller'=>'backend', 'action'=>'tcg_expansion_index'));
echo $this->Html->link('Video Game Genres', array('controller'=>'backend', 'action'=>'vg_genre_index'));
?>
</section>