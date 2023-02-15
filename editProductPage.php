<!DOCTYPE html>
<html>

<?php
session_start();
include 'components/header.php';
require 'components/searchModal.php';
require 'vendor/autoload.php';
require 'components/addProductModal.php';
#require 'components/editProductModal.php';


$m = new MongoDB\Client ("mongodb://127.0.0.1/");
  $db = $m->AnorakHub;
  $collection = $db->products;
  $productsCursor = $collection->find();

?>


<body id="editProductPage">
    <section>
        <div class="container pt-5 my-5">
            <h4 class="my-5">Διαχείριση Προϊόντων</h4>
            <a type="button" onclick="document.getElementById('addProductModal').style.display='block'"
                class="m-1 viewBtn btn btn-sm btn-secondary" title="Προσθήκη Προϊόντος">Προσθήκη
                Προϊόντος</a>
            <div id="productsTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="productsTable_length"><label>Show <select
                                    name="productsTable_length" aria-controls="productsTable"
                                    class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="productsTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                    class="form-control form-control-sm" placeholder=""
                                    aria-controls="productsTable"></label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="display table table-striped dataTable no-footer" id="productsTable"
                            aria-describedby="productsTable_info">
                            <!--table-hover-->
                            <thead>
                                <tr>
                                    <th class="sorting_disabled sorting_asc" rowspan="1" colspan="1"
                                        aria-label="Κωδικός Προϊόντος">
                                        Κωδικός Προϊόντος
                                    </th>


                                    <th class="sorting" tabindex="0" aria-controls="productsTable" rowspan="1"
                                        colspan="1" aria-label="Όνομα: activate to sort column ascending">Όνομα</th>
                                    <th class="sorting" tabindex="0" aria-controls="productsTable" rowspan="1"
                                        colspan="1" aria-label="Τιμή: activate to sort column ascending">Τιμή</th>
                                    <th class="sorting" tabindex="0" aria-controls="productsTable" rowspan="1"
                                        colspan="1" aria-label="Απόθεμα: activate to sort column ascending">Απόθεμα
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="productsTable" rowspan="1"
                                        colspan="1" aria-label="Κατηγορία: activate to sort column ascending">Κατηγορία
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="productsTable" rowspan="1"
                                        colspan="1" aria-label="Ενέργεια: activate to sort column ascending">Ενέργεια
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $X=0;
                                foreach($productsCursor as $document){
                                    $X++; ?>
                                <tr class="odd">
                                    <td class="sorting_1"><?=$document['productCode']?> </td>
                                    <td><?=$document['name']?></td>
                                    <td><?=$document['price']?>€</td>
                                    <td><?=$document['stock']?></td>
                                    <td><?=$document['productIs']?></td>
                                    <td><a type="button"
                                            href="components/editProductForm.php?productCode=<?=$document['productCode']?>"
                                            class="m-1 viewBtn btn btn-sm btn-secondary"
                                            title="Επεξεργασία Χρήστη">Edit</a>
                                        <a type="button" href="#" class="m-1 deleteBtn btn btn-sm btn-danger"
                                            title="Διαγραφή Χρήστη">Delete</a>
                                    </td>
                                </tr><?php 
                                    } ?>
                                <tr>products count: <?=$X?></tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="productsTable_info" role="status" aria-live="polite">Showing 1 to
                            2 of 2 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="productsTable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="productsTable_previous"><a
                                        href="#" aria-controls="productsTable" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="productsTable"
                                        data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item next disabled" id="productsTable_next"><a href="#"
                                        aria-controls="productsTable" data-dt-idx="2" tabindex="0"
                                        class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </section>

</body>
<?php
include 'components/footer.php';
?>

</html>