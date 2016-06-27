<div class="row">
    <?php if(isset($error)){?>
    <div class="card-panel teal lighten-2"><?php echo htmlentities($error);?></div>
    <?php }elseif(isset($message)){?>
    <div class="card-panel teal lighten-2"><?php echo htmlentities($message);?></div>
    <?php }?>
</div>