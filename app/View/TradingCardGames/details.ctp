<?php echo $this->element('backend_menu');?>
<section id="backend_content">
<section class="item_details">
<div>
<b>Name:</b> <?php echo $tcg['Product']['name']; ?>
</div>
<div>
<b>Price:</b> <?php echo $tcg['Product']['price']; ?>
</div>
<div>
<b>Image File:</b> <?php echo $tcg['Product']['main_image_url']; ?>
</div>
<div>
<b>Brand: </b><?php echo $tcg['TcgBrand']['name']; ?>
</div>
<div>
<b>Expansion: </b><?php echo (isset($tcg['TcgExpansionMembership']['TcgExpansion']['name']) ? $tcg['TcgExpansionMembership']['TcgExpansion']['name'] : '') ?>
</div>
<div>
<b>Date Entry Created:</b> <?php echo $tcg['Product']['created']; ?>
</div>
<div>
<b>Last Modified:</b> <?php echo $tcg['Product']['modified']; ?>
</div>
<div>
<div><b>Description details:</b></div>
<?php echo $tcg['Product']['description']; ?>
</div>
</section>
</section>