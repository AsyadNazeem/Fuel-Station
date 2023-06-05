<?php session_start(); ?>

<?php
if(!isset($_SESSION['user_id'])){
    header('Location: ../../login.php');
}
if($_SESSION['userType'] != 'SUPER-ADMIN'){
    header('Location: ../../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>


    <title>Fual Station Mannagement</title>

    <?php
    require_once('../../res/link.php');

    ?>

</head>

<body>
<div class="wrapper">
    <!-- Sidenav -->

    <?php
    require_once('../super-admin/res/sideNav_super.php');
    ?>

    <!-- END Sidenav -->

    <!-- Top nav -->
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <?php
            require_once('../super-admin/res/TopNav.php');
            ?>

        </nav>
        <!-- End Navbar -->

        <!-- Main Content -->
        <main class="content">
            <div class="container-fluid p-0">

                <div class="row">

                    <div class="container-fluid p-0">

                        <h1 class="h3 mb-3">Filling Station</h1>

                        <div class="row">
                            <div class="col-md-3 col-xl-2">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Options</h5>
                                    </div>

                                    <div class="list-group list-group-flush" role="tablist">
                                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                           href="#account" role="tab" aria-selected="true">
                                            Filling Stations
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                           href="#password" role="tab" aria-selected="false" tabindex="-1">
                                            Register Filling Station
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Privacy and safety
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Email notifications
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Massage notifications
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Widgets
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Your data
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Delete account
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9 col-xl-10">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <h5 class="card-title mb-0">Filling station</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#ID</th>
                                                        <th>Name</th>
                                                        <th>Company</th>
                                                        <th>Email</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>Garrett Winters</td>
                                                        <td>Good Guys</td>
                                                        <td>garrett@winters.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Ashton Cox</td>
                                                        <td>Levitz Furniture</td>
                                                        <td>ashton@cox.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Sonya Frost</td>
                                                        <td>Child World</td>
                                                        <td>sonya@frost.com</td>
                                                        <td><span class="badge bg-danger">Deleted</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Jena Gaines</td>
                                                        <td>Helping Hand</td>
                                                        <td>jena@gaines.com</td>
                                                        <td><span class="badge bg-warning">Inactive</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Charde Marshall</td>
                                                        <td>Price Savers</td>
                                                        <td>charde@marshall.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Haley Kennedy</td>
                                                        <td>Helping Hand</td>
                                                        <td>haley@kennedy.com</td>
                                                        <td><span class="badge bg-danger">Deleted</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Tatyana Fitzpatrick</td>
                                                        <td>Good Guys</td>
                                                        <td>tatyana@fitzpatrick.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Michael Silva</td>
                                                        <td>Red Robin Stores</td>
                                                        <td>michael@silva.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Angelica Ramos</td>
                                                        <td>The Wiz</td>
                                                        <td>angelica@ramos.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Jennifer Chang</td>
                                                        <td>Helping Hand</td>
                                                        <td>jennifer@chang.com</td>
                                                        <td><span class="badge bg-warning">Inactive</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Brenden Wagner</td>
                                                        <td>The Wiz</td>
                                                        <td>brenden@wagner.com</td>
                                                        <td><span class="badge bg-warning">Inactive</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Fiona Green</td>
                                                        <td>The Sample</td>
                                                        <td>fiona@green.com</td>
                                                        <td><span class="badge bg-warning">Inactive</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Prescott Bartlett</td>
                                                        <td>The Sample</td>
                                                        <td>prescott@bartlett.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Gavin Cortez</td>
                                                        <td>Red Robin Stores</td>
                                                        <td>gavin@cortez.com</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Howard Hatfield</td>
                                                        <td>Price Savers</td>
                                                        <td>howard@hatfield.com</td>
                                                        <td><span class="badge bg-warning">Inactive</span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-header">

                                                    <h5 class="card-title mb-0">Register New Filling Station</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label"
                                                                       for="inputFirstName">Username</label>
                                                                <input type="text" class="form-control"
                                                                       id="inputFirstName" placeholder="First name">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="inputLastName">Filling
                                                                    Staion Name</label>
                                                                <input type="text" class="form-control"
                                                                       id="inputLastName" placeholder="Last name">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputEmail4">Email</label>
                                                            <input type="email" class="form-control" id="inputEmail4"
                                                                   placeholder="Email">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputAddress">Address</label>
                                                            <input type="text" class="form-control" id="inputAddress"
                                                                   placeholder="1234 Main St">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputAddress2">Address
                                                                2</label>
                                                            <input type="text" class="form-control" id="inputAddress2"
                                                                   placeholder="Apartment, studio, or floor">
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="inputCity">City</label>
                                                                <input type="text" class="form-control" id="inputCity">
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label" for="inputState">State</label>
                                                                <select id="inputState" class="form-control">
                                                                    <option selected="">Colombo</option>
                                                                    <option>Gampaha</option>
                                                                    <option>Kaluthara</option>
                                                                    <option>Monaragama</option>
                                                                    <option>Rathnapura</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-2">
                                                                <label class="form-label" for="inputZip">Zip</label>
                                                                <input type="text" class="form-control" id="inputZip">
                                                            </div>

                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save changes
                                                        </button>
                                                    </form>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
    </div>


    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="footer"></footer>
    <!--End Footer -->
</div>
</div>
</body>

</html>