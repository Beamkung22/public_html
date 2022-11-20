<div id="myModalEdit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขข้อมูลส่วนตัว</h5>
                    <text>คุณ </text><text id="editname"/>
                    <button type="button" class="close" onclick="location.reload()" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ชื่อ-สกุล <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="newname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="newname" placeholder="ชื่อนามสกุล" required="required" type="text">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="newemail" name="newemail" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">เบอร์โทร <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="tel" id="newtel" name="newtel" required="required" data-validate-length-range="8,10" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newaccountno">เลขบัญชี <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="newaccountno" name="newaccountno" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">สถานะ<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="newstatus" name="newstatus" class="form-control" required>
                            <option value="">กรุณาเลือกสถานะ..</option>
                        </select>  
                            </div>    
                        </div>
                        <div id="classChange" class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ระดับ<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="newclass" name="newclass" class="form-control" required>
                            <option value="">กรุณาเลือกระดับ..</option>
                          </select>  
                        </div>    
                        </div>
                    </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backmamu('myModalEdit')" >กลับไปเมนูหลัก</button>
                    <button type="button" onclick="submitEditProfile()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>