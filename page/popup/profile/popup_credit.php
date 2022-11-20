<!-- Add -->
<div id="myModalAddCredit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มจำนวนเงิน</h5>
                    <text>คุณ </text><text id="creditupName"/>
                    <button type="button" class="close" onclick="location.reload()" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left" enctype="multipart/form-data">
                  <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">จำนวนเงิน <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="creditAdd" name="creditAdd" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backmamu('myModalAddCredit')" >กลับไปเมนูหลัก</button>
                    <button type="button" onclick="submitAddCredit()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
<!-- Delete -->
<div id="myModalDelCredit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ลดจำนวนเงิน</h5>
                    <text>คุณ </text><text id="creditDownName"/>
                    <button type="button" class="close" onclick="location.reload()" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left" enctype="multipart/form-data">
                  <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">จำนวนเงิน <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="creditDelete" name="creditDelete" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backmamu('myModalDelCredit')" >กลับไปเมนูหลัก</button>
                    <button type="button" onclick="submitdelCredit()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>