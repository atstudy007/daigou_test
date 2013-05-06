	<div class="blank10"></div>
    <div class="notfound_404_body">
       <div class="notfound_404_pic">
        <?php $msg_pics = array('error'=>'wrong.jpg','success'=>'right.jpg','info'=>'info.jpg'); ?>
        <img src="images/<?php echo $msg_pics[$level]; ?>">
       </div>
    
       <div class="notfound_404_right">
          <h1><?php echo $message; ?></h1>
          <div class="notfound_404_button">
          	 <?php if ($link): ?>
             <?php foreach ($link as $_link): ?>
             <div class="msg_btn"><a href="<?php echo $_link['url']; ?>"><?php echo $_link['label']; ?></a></div>
             <?php endforeach; ?>
             <?php else :?>
             <div class="msg_btn"><a href="<?php echo site_url(''); ?>">Go Home</a></div>
          	 <?php endif; ?>
          </div>
       </div>
       <div class="clear"></div>
    </div>
</div>