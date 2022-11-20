<div id="myModalChangePassword" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขรหัสผ่าน</h5>
                    <text>คุณ </text><text id="changeName"/>
                    <button type="button" class="close" onclick="location.reload()" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left" enctype="multipart/form-data">
                  <div class="item form-group">
                    <label for="passwordnew" class="control-label col-md-3">Password New</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="passwordnew" type="password" name="passwordnew" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                  </div>
                  <div class="item form-group">
                    <label for="passwordnew2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password New</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="passwordnew2" type="password" name="passwordnew2" data-validate-linked="passwordnew" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                  </div> 
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backmamu('myModalChangePassword')" >กลับไปเมนูหลัก</button>
                    <button type="button" onclick="submitChangePassword()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>