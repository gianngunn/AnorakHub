<!DOCTYPE html>
<html>

<?php
session_start();
include 'components/header.php';
require 'components/searchModal.php';
require 'vendor/autoload.php';
require 'components/addUserModal.php';
require 'components/editUserModal.php';


$m = new MongoDB\Client ("mongodb://127.0.0.1/");
  $db = $m->AnorakHub;
  $collection = $db->users;
  $usersCursor = $collection->find();

?>


<body id="editUsersPage">
    <section>
        <div class="container pt-5 my-5">
            <h4 class="my-5">Διαχείριση χρηστών</h4>
            <a type="button" onclick="document.getElementById('addUserModal').style.display='block'"
                class="m-1 viewBtn btn btn-sm btn-secondary" title="Προσθήκη Χρήστη">Προσθήκη
                Χρήστη</a>
            <div id="usersTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="usersTable_length"><label>Show <select
                                    name="usersTable_length" aria-controls="usersTable"
                                    class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="usersTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                    class="form-control form-control-sm" placeholder=""
                                    aria-controls="usersTable"></label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="display table table-striped dataTable no-footer" id="usersTable"
                            aria-describedby="usersTable_info">
                            <!--table-hover-->
                            <thead>
                                <tr>
                                    <th class="sorting_disabled sorting_asc" rowspan="1" colspan="1" aria-label="email">
                                        Email
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1"
                                        aria-label="Όνομα: activate to sort column ascending">Όνομα</th>
                                    <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1"
                                        aria-label="Επώνυμο: activate to sort column ascending">Επώνυμο</th>
                                    <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1"
                                        aria-label="Τηλέφωνο: activate to sort column ascending">Τηλέφωνο</th>
                                    <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1"
                                        aria-label="Ηλικία: activate to sort column ascending">Ηλικία</th>
                                    <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1"
                                        aria-label="Ενέργεια: activate to sort column ascending">Ενέργεια</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $X=0;
                                foreach($usersCursor as $document){
                                    $X++; ?>
                                <tr class="odd">
                                    <td class="sorting_1"><?=$document['uemail']?> </td>
                                    <td><?=$document['firstName']?></td>
                                    <td><?=$document['lastName']?></td>
                                    <td><?=$document['phone']?></td>
                                    <td><?=$document['age']?></td>
                                    <td><a type="button"
                                            onclick="document.getElementById('editUserModal').style.display='block'"
                                            class="m-1 viewBtn btn btn-sm btn-secondary"
                                            title="Επεξεργασία Χρήστη">Edit</a>
                                        <a type="button"
                                            href="dbServices/deleteUser.php?uemail=<?=$document['uemail']?>"
                                            class="m-1 deleteBtn btn btn-sm btn-danger"
                                            title="Διαγραφή Χρήστη">Delete</a>
                                    </td>
                                </tr><?php 
                                    } ?>
                                <tr>users count: <?=$X?></tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="usersTable_info" role="status" aria-live="polite">Showing 1 to
                            2 of 2 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="usersTable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="usersTable_previous"><a
                                        href="#" aria-controls="usersTable" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="usersTable"
                                        data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item next disabled" id="usersTable_next"><a href="#"
                                        aria-controls="usersTable" data-dt-idx="2" tabindex="0"
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