<?php
$product = query("SELECT * FROM md_product ORDER BY product_code ASC");
$no = 1;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3>MASTER DATA PRODUCT</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <div class="dt-buttons btn-group flex-wrap">
                        <button class="btn btn-secondary bg-gradient-info" type="button" data-toggle="modal" data-target="#add_pro">
                            <span>New Product</span>
                        </button>
                        <div class="modal fade" id="add_pro">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">New Product</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- form start -->
                                        <form class="form-horizontal">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="productcode" class="col-sm-2 col-form-label">Product Code</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="p_code" class="form-control" id="productcode" placeholder="Product Code">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="productdes" class="col-sm-2 col-form-label">Product Description</label>
                                                    <div class="col-sm-10">
                                                        <input type="test" name="p_des" class="form-control" id="productdes" placeholder="Product Description">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="productcat" class="col-sm-2 col-form-label">Product Category</label>
                                                    <div class="col-sm-10">
                                                        <select name="category" class="form-control select2bs4" style="width: 100%;" id="productcat" placeholder="Product Category">
                                                            <option>Alabama</option>
                                                            <option>Alaska</option>
                                                            <option>California</option>
                                                            <option>Delaware</option>
                                                            <option>Tennessee</option>
                                                            <option>Texas</option>
                                                            <option>Washington</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Sign in</button>
                                                <button type="submit" class="btn btn-default float-right">Cancel</button>
                                            </div>
                                            <!-- /.card-footer -->
                                        </form>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- <button class="btn btn-secondary buttons-html5" type="button">
                            <span>CSV</span>
                        </button> -->
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Code</th>
                                <th>Product Des</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($product as $pro) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $pro['product_code']; ?></td>
                                    <td><?= $pro['product_des']; ?></td>
                                    <td><?= $pro['product_cat']; ?></td>
                                    <td><?= $pro['price']; ?></td>
                                    <td>
                                        <div class="dt-buttons btn-group flex-wrap">
                                            <button class="btn btn-secondary bg-gradient-info" type="button">
                                                <span>View</span>
                                            </button>
                                            <button class="btn btn-secondary bg-gradient-warning" type="button">
                                                <span>Edit</span>
                                            </button>
                                            <button class="btn btn-secondary bg-gradient-danger" type="button">
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Product Code</th>
                                <th>Product Des</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>