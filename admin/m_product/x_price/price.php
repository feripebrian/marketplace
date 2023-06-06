<?php
$price = query("SELECT * FROM md_price ORDER BY product_code ASC");
$no = 1;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3>MASTER DATA PRICE</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <div class="dt-buttons btn-group flex-wrap">
                        <button class="btn btn-secondary bg-gradient-info" type="button">
                            <span>Add New</span>
                        </button>
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
                                <th>Prodduct Des</th>
                                <th>Prodduct Cat</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($price as $pri) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $pri['product_code']; ?></td>
                                    <td><?= $pri['product_des']; ?></td>
                                    <td><?= $pri['product_cat']; ?></td>
                                    <td><?= $pri['price']; ?></td>
                                    <td>
                                        <?= $stat = $pri['status'];
                                        if ($stat == 1) {
                                            echo 'Aktif';
                                        } else if ($stat == 0) {
                                            echo 'Non Aktif';
                                        }
                                        ?>
                                    </td>
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
                                <th>Prodduct Des</th>
                                <th>Prodduct Cat</th>
                                <th>Price</th>
                                <th>Status</th>
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