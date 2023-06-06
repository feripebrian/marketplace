<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3>MASTER DATA CATEGORY</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <div class="dt-buttons btn-group flex-wrap">
                        <h4>Add Category</h4>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" class="form-horizontal form-input" id="form-category">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="category_code" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <input type="text" name="category_code" id="category_code" class="form-control" placeholder="Category Code" required autofocus>
                                </div>
                                <div class="col-sm-3 pesan">
                                    <p class="text-muted pesan-text"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <input type="text" name="category" id="category" class="form-control" placeholder="Category" required>
                                </div>
                                <div class="col-sm-3 pesan">
                                    <p class="text-muted pesan-text"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="custom-control custom-radio" style="margin-right: 10px;">
                                    <input class="custom-control-input" type="radio" id="status1" name="status" value="1">
                                    <label for="status1" class="custom-control-label">Active</label>
                                </div>
                                <div class="custom-control custom-radio" style="margin-right: 10px;">
                                    <input class="custom-control-input" type="radio" id="status2" name="status" value="0">
                                    <label for="status2" class="custom-control-label">Non Active</label>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                                <button type="submit" name="save-category" id="save-category" class="btn btn-info">Save</button>
                            </div>
                            <!-- /.card-footer -->
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
<script src="../assets/js/form_validation/form_validation_category.js"></script>