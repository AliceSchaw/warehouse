<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span12">
	  
		  <div class="page-header">
            <h3>更改信息</h3>
          </div>
		  
          <div class="row-fluid">
            <div class="span12">
	  
	  <form class="form-horizontal" method="post" action="?action=user&do=updatepass&username=<?php echo $this->_var['row']['UserName']; ?>">
			<input type="text" name="id" value="<?php echo $this->_var['row']['id']; ?>" style="display:none;"/>

			<div class="control-group">
            <label for="input01" class="control-label">工号：</label>
            <div class="controls">
              <input type="text" value="<?php echo $this->_var['row']['UserName']; ?>" id="input01" class="input-xlarge" name="username" readonly>
            </div>
          </div>


			<div class="control-group">
            <label for="input01" class="control-label">姓名：</label>
            <div class="controls">
              <input type="text" value="<?php echo $this->_var['row']['Name']; ?>" id="input02" class="input-xlarge" name="name" >
            </div>
          </div>
          
		
          
          <div class="control-group">
            <label for="input01" class="control-label">密码：</label>
            <div class="controls">
              <input type="password"   id="input03" class="input-xlarge" name="password">
            </div>
          </div>

		    <div class="control-group">
            <label for="input01" class="control-label">确认密码：</label>
            <div class="controls">
              <input type="password"   id="input04" class="input-xlarge" name="password2">
            </div>
          </div>

          <div class="form-actions">
            <button class="btn btn-success" type="submit">保 存</button>
			<a class="btn" href="?action=user"><i class="icon-share"></i> 返回</a>
            

          </div>
          			
      </form>
		  
		  
	   
            </div>
          </div>
		  
		  
        </div>

		
<?php echo $this->fetch('foot.htm'); ?>





