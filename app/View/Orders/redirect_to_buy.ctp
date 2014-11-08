<?php

echo $this->Form->create('Order', array('action'=>'buy'));
echo $this->Form->end();
?>

<script type="text/javascript">
document.getElementById('OrderBuyForm').submit();
</script>