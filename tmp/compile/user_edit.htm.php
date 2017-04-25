<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>
<div class="span10">
	  
		  <div class="page-header">
            <h3><?php echo $this->_var['title']; ?></h3>
          </div>
		  
          <div class="row-fluid">
            <div class="span12">
	  
	  
	  
	  <form class="form-horizontal" method="post" action="?action=user&do=update&UserName=<?php echo $this->_var['row']['UserName']; ?>">
	  
	       <input type="text" name="id" value="<?php echo $this->_var['row']['id']; ?>" style="display:none;">
			<div class="control-group">
            <label for="input01" class="control-label">用户名：</label>
            <div class="controls">
              <input type="text" id="username" class="input-xlarge" name="<?php echo $this->_var['row']['UserName']; ?>" value="<?php echo $this->_var['row']['UserName']; ?>" readonly>
            </div>
          </div>

			<div class="control-group">
            <label for="input01" class="control-label">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label>
            <div class="controls">
              <input type="text" id="name" class="input-xlarge" name="Name" value="<?php echo $this->_var['row']['Name']; ?>">
            </div>
          </div>

          <div class="control-group">
              <label for="input01" class="control-label">部门：</label>
              <div class="controls">
                  <select name="Division">
                      <option value ="1STD10" selected="<?php echo $this->_var['row']['Division']; ?>"><?php echo $this->_var['row']['Division']; ?></option>
                      <option value ="1STD10">1STD10</option>
                      <option value="1STD20">1STD20</option>
                      <option value="1STD30">1STD30</option>
                      <option value="1STD50">1STD50</option>
                  </select>
              </div>
          </div>
          
		<div class="control-group">
            <label for="input01" class="control-label">手&nbsp;&nbsp;&nbsp;&nbsp;机：</label>
            <div class="controls">
              <input type="text" id="input01" name="MobilePhone" class="input-xlarge" value="<?php echo $this->_var['row']['MobilePhone']; ?>" >
            </div>
          </div>


		  <div class="control-group">
            <label for="input01" class="control-label">邮&nbsp;&nbsp;&nbsp;&nbsp;箱：</label>
            <div class="controls">
              <input type="text" id="input01" name="MailAddress" class="input-xlarge" value="<?php echo $this->_var['row']['MailAddress']; ?>" >
            </div>
          </div>


			

			<div class="form-actions">
            <button class="btn btn-success" type="submit" >保存</button>
			   <a class="btn" href="?action=user"><i class="icon-share"></i> 返回</a>		
          </div>   	
      </form>
		  
		  
	   
            </div>
          </div>
		  
		  
        </div>

		
<?php echo $this->fetch('foot.htm'); ?>