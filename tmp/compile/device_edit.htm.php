<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span12">

    <div class="page-header">
        <h3>更新设备信息</h3>
    </div>

    <div class="row-fluid">
        <div class="span12">

            <form class="form-horizontal" method="post" action="?action=address&do=updata">
                <input type="text" name="id" value="<?php echo $this->_var['row']['ProductID']; ?>" style="display:none;"/>

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
                        <input type="text" id="input04" name="ProductID" class="input-xlarge" value="<?php echo $this->_var['row']['ProductID']; ?>"  readonly>
                    </div>
                </div>
                <div class="control-group">
                    <label for="input05" class="control-label">设备名称（Name）：</label>
                    <div class="controls">
                        <input type="text" id="input05" name="ProductName" class="input-xlarge" value="<?php echo $this->_var['row']['ProductName']; ?>" >
                    </div>
                </div>
             <div class="control-group">
              <label for="input06" class="control-label">版本（XorA）：</label>
              <div class="controls">
                 <input type="text" id="input06" name="REV" class="input-xlarge" value="<?php echo $this->_var['row']['REV']; ?>" >
              </div>
             </div>
			<div class="control-group">
              <label for="input06" class="control-label">设备不良现象：</label>
              <div class="controls">
                 <textarea rows="4" id="input06" name="BadEvent" class="input-xlarge" ><?php echo $this->_var['row']['BadEvent']; ?></textarea>
              </div>
             </div>
			 <div class="control-group">
              <label for="input06" class="control-label">设备不良原因：</label>
              <div class="controls">
                 <textarea rows="4" id="input06" name="BadSource" class="input-xlarge" ><?php echo $this->_var['row']['BadSource']; ?></textarea>
              </div>
             </div>
			  <div class="control-group">
              <label for="input06" class="control-label">设备记录日期：</label>
              <div class="controls">
                 <input type="text" id="input06" name="BadDate" class="input-xlarge" value="<?php echo $this->_var['row']['BadDate']; ?>" >
              </div>
             </div>
			 <div class="control-group">
              <label for="input06" class="control-label">使用寿命：</label>
              <div class="controls">
                 <input type="text" id="input06" name="Badlife" class="input-xlarge" value="<?php echo $this->_var['row']['Badlife']; ?>" >
              </div>
             </div>
			 <div class="control-group">
              <label for="input06" class="control-label">记录人：</label>
              <div class="controls">
                 <input type="text" id="input06" name="Recorder" class="input-xlarge" value="<?php echo $this->_var['row']['Recorder']; ?>" >
              </div>
             </div>
             <div class="control-group">
                    <label for="input01" class="control-label">状态（Status）：</label>

                    <div class="controls">
                        <label class="checkbox inline">
                            <input type="radio"   name="Status" value="未借出" <?php if ($this->_var['row']['Status'] == '未借出'): ?>checked<?php endif; ?>/>未借出
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





