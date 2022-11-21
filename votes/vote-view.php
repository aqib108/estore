<html>
    
    <head>
        <title>Search Vote</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>

    <body>

        <div class="container form-container">
            <header>
                <h1>Vote Details</h1>
            </header>
            <div id="form">
                <div class="fish" id="fish"></div>
                <div class="fish" id="fish2"></div>
                <br>
                <a href="/votes?search=true" class="btn btn-info pull-right">New Search</a>
                <table id="waterform" class="table table-striped table-responsive">
                    <thead>
                        <th>Block Number</th>
                        <th>Serial Number</th>
                        <th>Family Number</th>
                        <th>Name</th>
                        <th>Father/Husband Name</th>
                        <th>NIC Number</th>
                        <th>Age</th>
                        <th>Address</th>
                    </thead>
                    <tbody>
                        <?php 
                            $nic = $_POST["nic"];

                            $conn = mysqli_connect("localhost", "techeofr_vote", 'D@u+8~?e?YjT', "techeofr_votes") or die("Connection Error: " . mysqli_error($conn));

                            $getQuery = "Select * from voters where nic=".$nic;
                            $getQuery = mysqli_query($conn, $getQuery);
                            
                            $result = mysqli_fetch_assoc($getQuery);
                        ?>
                        <tr>
                            <td><?php echo $result['block_number'];?></td>
                            <td><?php echo $result['s_number'];?></td>
                            <td><?php echo $result['f_number'];?></td>
                            <td><?php echo $result['name'];?></td>
                            <td><?php echo $result['fh_name'];?></td>
                            <td><?php echo $result['nic'];?></td>
                            <td><?php echo $result['age'];?></td>
                            <td><?php echo $result['village'].','.$result['tehcil'].','.$result['district'];?></td>
                        </tr>
                    </tbody>
                </table>
                <tbody>
                    
                </tbody>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $('#waterform').DataTable({
                "searching": false,
                "paging":   false,
                "ordering": false,
                "info":     false
            });
        </script>
    </body>
</html>