<div class="row">
    <?php if(isset($error)){?>
    <div class="card-panel teal lighten-2"><?php echo $error;?></div>
    <?php }elseif(isset($message)){?>
    <div class="card-panel teal lighten-2"><?php echo $message;?></div>
    <?php }?>
</div>