<div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ข้อมูลเบอร์</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">เลข <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input readonly id="name" class="form-control col-md-7 col-xs-12" name="name" type="text">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ประเภทเลข <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input readonly id="type" class="form-control col-md-7 col-xs-12" name="type" type="text">
                          </div>
                        </div>

                          <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">จำนวนเงินรางวัล <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="tel" id="price" name="price" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                    </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="submitEditNumber()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>