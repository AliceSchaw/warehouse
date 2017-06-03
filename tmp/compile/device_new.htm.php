<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span12">
	  
		  <div class="page-header">
            <h3>新增设备</h3>
          </div>
		  
          <div class="row-fluid">
            <div class="span12">
	  
	  
	  
	  <form class="form-horizontal" method="post" action="?action=address&do=add" align="left">


  <div class="control-group">
            <label for="input01" class="control-label">Type：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="Type" value="<?php echo $this->_var['row']['Type']; ?>">
            </div>
          </div>
          

      <div class="control-group">
            <label for="input01" class="control-label">Interface：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="Interface" value="<?php echo $this->_var['row']['Interface']; ?>">
            </div>
          </div>
          
          
          <div class="control-group">
            <label for="input01" class="control-label">Category：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="Category" value="<?php echo $this->_var['row']['Category']; ?>">
            </div>
          </div>
          
          <div class="control-group">
            <label for="input01" class="control-label">Vendor：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="Vendor" value="<?php echo $this->_var['row']['Vendor']; ?>">
            </div>
          </div>
          
          <div class="control-group">
            <label for="input01" class="control-label">ProductID：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="ProductID" value="<?php echo $this->_var['row']['ProductID']; ?>"> 
            </div>
          </div>
          
          <div class="control-group">
            <label for="input01" class="control-label">REV：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="REV" value="<?php echo $this->_var['row']['REV']; ?>"> 
            </div>
          </div>
          <div class="control-group">
            <label for="input01" class="control-label">FW：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="FW" value="<?php echo $this->_var['row']['FW']; ?>"> 
            </div>
          </div>
          <div class="control-group">
            <label for="input01" class="control-label">工具室料号：</label>
            <div class="controls">
               <input type="text" id="input01" class="input-xlarge" name="工具室料号" value="<?php echo $this->_var['row']['工具室料号']; ?>"> 
            </div>
          </div>
          <div class="control-group">
            <label for="input01" class="control-label">PropertyNum：</label>
            <div class="controls">
               <input type="text" id="input01" class="input-xlarge" name="PropertyNum" value="<?php echo $this->_var['row']['PropertyNum']; ?>"> 
            </div>
          </div>   
           <div class="control-group">
            <label for="input01" class="control-label">DP/N：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="DPN" value="<?php echo $this->_var['row']['DPN']; ?>"> 
            </div>
          </div>
          <div class="control-group">
            <label for="input01" class="control-label">ModelNum：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="ModelNum" value="<?php echo $this->_var['row']['ModelNum']; ?>"> 
            </div>
          </div>
          <div class="control-group">
            <label for="input01" class="control-label">Source：</label>
            <div class="controls">
              <input type="text" id="input01" class="input-xlarge" name="Source" value="<?php echo $this->_var['row']['Source']; ?>"> 
            </div>
          </div>  
          <div class="control-group">
            <label for="input01" class="control-label">ProductName：</label>
            <div class="controls">
               <input type="text" id="input01" class="input-xlarge" name="ProductName" value="<?php echo $this->_var['row']['ProductName']; ?>"> 
            </div>
          </div> 

          <div class="control-group">
            <label for="input01" class="control-label">UserName：</label>
            <div class="controls">
               <input type="text" id="input01" class="input-xlarge" name="UserName" value="<?php echo $this->_var['row']['UserName']; ?>"> 
            </div>
          </div> 
          <div class="control-group">
            <label for="input01" class="control-label">Sign：</label>
            <div class="controls">
               <input type="text" id="input01" class="input-xlarge" name="Sign" value="<?php echo $this->_var['row']['Sign']; ?>"> 
            </div>
          </div>
			<div class="control-group">
            <label for="input01" class="control-label">Belong：</label>
            <div class="controls">
               <input type="text" id="input01" class="input-xlarge" name="Belong" value="<?php echo $this->_var['row']['Belong']; ?>"> 
            </div>
          </div>
          <div class="control-group">
              <label for="input01" class="control-label">状态（Status）：</label>
              <div class="controls">
                  <label class="checkbox inline">
                      <input type="radio"   name="Status" value="未借出" <?php if ($this->_var['row']['Status'] == "未借出"): ?>checked<?php endif; ?>/>未借出
                  </label>
				  <label class="checkbox inline">
                      <input type="radio"   name="Status" value="已借出" <?php if ($this->_var['row']['Status'] == "已借出"): ?>checked<?php endif; ?>	/>已借出
                  </label>
                  <label class="checkbox inline">
                      <input type="radio"  name="Status" value="退库" <?php if ($this->_var['row']['Status'] == "退库"): ?>checked<?php endif; ?>	/>退库
                  </label>
                  <label class="checkbox inline">
                      <input type="radio"   name="Status" value="已损坏" <?php if ($this->_var['row']['Status'] == "已损坏"): ?>checked<?php endif; ?>	/>已损坏
                  </label>
              </div>
          </div>






          <div class="form-actions">
              <button class="btn btn-success" type="submit">保 存</button>
              <a class="btn" href="?action=address"><i class="icon-share"></i> 返回</a>

          </div>

      </form>



            </div>
          </div>


</div>
		
<?php echo $this->fetch('foot.htm'); ?>