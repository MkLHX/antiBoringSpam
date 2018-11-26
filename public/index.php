<?php require '../backEnd.php'; ?>
<?php require '../inc/header.php'; ?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10 text-center my-5">
                <h1>Welcome To Anti Boring Spam!</h1>
                <h2>The <strong>free</strong> removing <strong>spam tool</strong></h2>
            </div>
            <div class="col-10">
                <?php
                if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
                    echo
                        '<div class="col text-center">' .
                        '<h1><strong class="text-danger">Need both email and password!!</strong></h1>' .
                        '</div>';
                }
                if (isset($imapResponse) && !isset($boxContent)) {
                    echo
                        '<h3>Scanning for : ' . $_SESSION['email'] . '</h3>' .
                        '<h4>Inbox structure</h4>' .
                        '<div class="row">';
                    foreach ($imapResponse as $response) {
                        $label = $response['label'];
                        $status = $response['status'];
                        echo
                            "<div class='card m-1 col-2 shadow'>" .
                            "<div class='card-body'>" .
                            "<h5 class='card-title'><i class='fas fa-check'></i> $label</h5>" .
                            "<h6 class='card-subtitle mb-2 text-muted'></h6>" .
                            "<p class='card-text'><i class='fas fa-envelope'></i> $status->unseen / <i class='fas fa-envelope-open'></i> $status->messages</p>" .
                            "<a href='?box=$label' class='card-link text-center btn btn-info'>Go to</a>" .
                            "</div>" .
                            "</div>";
                    }
                    echo '</div>';
                }

                if (isset($boxContent)) {
                    foreach ($boxContent as $content) {
                        var_dump($content);
                    }
                }
                ?>
            </div>
        </div>
    </div>

<?php require '../inc/footer.php'; ?>