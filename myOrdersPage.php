<!DOCTYPE html>
<html>

<?php
session_start();
include 'components/header.php';
require 'components/searchModal.php';
require 'vendor/autoload.php';
#require 'components/addUserModal.php';



$m = new MongoDB\Client ("mongodb://127.0.0.1/");
  $db = $m->AnorakHub;
  $collection = $db->orders;
  $ordersCursor = $collection->find();

?>


<body id="editordersPage">
    <section>
        <div class="container pt-5 my-5">
            <h4 class="my-5">Οι Παραγγελίες μου</h4>
            <div id="ordersTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="ordersTable_length"><label>Show <select
                                    name="ordersTable_length" aria-controls="ordersTable"
                                    class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="display table table-striped dataTable no-footer" id="ordersTable"
                            aria-describedby="ordersTable_info">
                            <!--table-hover-->
                            <thead>
                                <tr>
                                    <th class="sorting_disabled sorting_asc" rowspan="1" colspan="1" aria-label="email">
                                        Email
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Όνομα: activate to sort column ascending">Όνομα</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Επώνυμο: activate to sort column ascending">Επώνυμο</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Τηλέφωνο: activate to sort column ascending">Τηλέφωνο</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Πόλη: activate to sort column ascending">Πόλη</th>

                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Διέυθυνση: activate to sort column ascending">Διέυθυνση</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Ζιπ: activate to sort column ascending">ΤΚ</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Ημ.Παραγγελίας: activate to sort column ascending">Ημ.Παραγγελίας
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Προϊόντα: activate to sort column ascending">Προϊόντα</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Σύνολο: activate to sort column ascending">Σύνολο</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="ordersTable" rowspan="1" colspan="1"
                                        aria-label="Ενέργεια: activate to sort column ascending">Ενέργεια</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $X=0;
                                foreach($ordersCursor as $document){
                                    if($document["uemail"]== $_SESSION["uemail"]){
                                    $X++; ?>
                                <tr class="odd">
                                    <td class="sorting_1"><?=$document['uemail']?> </td>
                                    <td><?=$document['ufname']?></td>
                                    <td><?=$document['ulname']?></td>
                                    <td><?=$document['phone']?></td>
                                    <td><?=$document['city']?></td>
                                    <td><?=$document['address']?></td>
                                    <td><?=$document['zip']?></td>
                                    <td><?=$document['orderDate']?></td>
                                    <?php 
                                    $string = " ";
                                        foreach($document['productsBought'] as $p ){
                                            $string .= $p.",";
                                        }
                                    ?>
                                    <td><?=$string?></td>
                                    <td><?=$document['totalPrice']?></td>
                                    <td><?=$document['orderStatus']?></td>
                                    <td>
                                        <a type="button"
                                            href="dbServices/cancelOrder.php?orderNumber=<?=$document['orderNumber']?>"
                                            class="m-1 deleteBtn btn btn-sm btn-danger"
                                            title="Ακύρωση παραγγελίας">Cancel</a>
                                    </td>
                                </tr><?php 
                                    }
                                    } ?>
                                <tr>orders count: <?=$X?></tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="ordersTable_info" role="status" aria-live="polite">Showing 1 to
                            2 of 2 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="ordersTable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="ordersTable_previous"><a
                                        href="#" aria-controls="ordersTable" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="ordersTable"
                                        data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item next disabled" id="ordersTable_next"><a href="#"
                                        aria-controls="ordersTable" data-dt-idx="2" tabindex="0"
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