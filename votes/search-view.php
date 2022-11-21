<html>
    
    <head>
        <title>Search Vote</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>

    <body>

        <div class="container form-container">
            <header>
                <h1>Search Vote</h1>
            </header>

            <div id="form">
                <div class="fish" id="fish"></div>
                <div class="fish" id="fish2"></div>

                <form id="waterform" name="frmContact" frmContact"" method="post"
            action="" enctype="multipart/form-data"
            onsubmit="return validateContactForm()">
                    
                    <div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="formgroup" id="email-form">
                        <label for="email">NIC Number*</label>
                        <input type="number" class="input-field" name="nic" id="nic" required />
                    </div>

                    <input type="submit" name="search" class="btn btn-submit"
                    value="Search" />
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript">
        </script>
    </body>
</html>