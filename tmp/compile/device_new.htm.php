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
              <label for="input01" class="control-label">类别（Type）：</label>
              <div class="controls">
                  <input type="text" id="input01" name="Type" class="input-xlarge" value="<?php echo $this->_var['row']['Type']; ?>" >
              </div>
          </div>
          <div class="control-group">
              <label for="input02" class="control-label">种类（Category）：</label>
              <div class="controls">
                  <input type="text" id="input02" name="Category" class="input-xlarge" value="<?php echo $this->_var['row']['Category']; ?>" >
              </div>
          </div>
          <div class="control-group">
              <label for="input03" class="control-label">供应商（Vendor）：</label>
              <div class="controls">
                  <input type="text" id="input03" name="Vendor" class="input-xlarge" value="<?php echo $this->_var['row']['Vendor']; ?>" >
              </div>
          </div>
          <div class="control-group">
              <label for="input04" class="control-label">设备ID（ProductID）：</label>
              <div class="controls">
                  <input type="text" id="input04" name="ProductID" class="input-xlarge" value="<?php echo $this->_var['row']['ProductID']; ?>">
              </div>
          </div>
          <div class="control-group">
              <label for="input05" class="control-label">设备名称（Name）：</label>
              <div class="controls">
                  <input type="text" id="input05" name="ProductName" class="input-xlarge" value="<?php echo $this->_var['row']['ProductName']; ?>" >
              </div>
          </div>
          <div class="control-group">
              <label for="input01" class="control-label">版本（XorA）：</label>
              <div class="controls">
                  <label class="checkbox inline">
                      <input type="radio"   name="XorA" value="X" <?php if ($this->_var['row']['XorA'] == "X"): ?>checked<?php endif; ?>	/> X
                  </label>
                  <label class="checkbox inline">
                      <input type="radio"  name="XorA" value="A" <?php if ($this->_var['row']['XorA'] == "A"): ?>checked<?php endif; ?>	/> A
                  </label>
              </div>
          </div>
          <div class="control-group">
              <label for="input01" class="control-label">状态（Status）：</label>
              <div class="controls">
                  <label class="checkbox inline">
                      <input type="radio"   name="Status" value="In Lab !!" <?php if ($this->_var['row']['Status'] == " In Lab ! ! "): ?>checked<?php endif; ?>/>In Lab !!
                  </label>
                  <label class="checkbox inline">
                      <input type="radio"  name="Status" value="退库" <?php if ($this->_var['row']['Status'] == "退库"): ?>checked<?php endif; ?>	/>退库
                  </label>
                  <label class="checkbox inline">
                      <input type="radio"   name="Status" value="Bad !!" <?php if ($this->_var['row']['Status'] == " Bad ! ! "): ?>checked<?php endif; ?>	/>Bad !!
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