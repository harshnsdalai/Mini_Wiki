<?php

$result = "";
$error = "";
$query = "";

if (isset($_GET['wiki'])) {

    $query = $_GET['wiki'];
    $wiki = ucwords($_GET["wiki"]);
    $wiki = str_replace(' ', '_', $wiki);
    $wikiURL = "https://en.wikipedia.org/wiki/" . $wiki;
    
    $file_headers = @get_headers("https://en.wikipedia.org/wiki/" . $wiki);

    if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $error = "This could not be found. Sorry xD";
    } else {

        $wikiPage = file_get_contents($wikiURL);
        $wiki1 = explode("<p>", $wikiPage);
        $wiki2 = explode("</p>", $wiki1[1]);
        $result = strip_tags($wiki2[0]);
    }

    if(strlen($query) === 0) {
        $error = "Search something";
    }
}


?>

<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="shortcut icon" href="wiki_icon.jpg" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>Hello, World !</title>

    <style>
        html {
            background: url("wiki.jpg");
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: none;
            color: white;
        }

        h1 {
            font-size: 3em;
        }

        h2 {
            font-size: 2.5em;
            padding-bottom: 0px;
        }

        h3 {
            font-size: 1em;
            line-height: 1.618em;
        }

        p {
            font-size: 0.8em;
            line-height: 1.618em;
        }

        @media all and (min-width: 960px) {
            body {
                font-size: 18px;
            }
        }

        @media all and (max-width: 959px) and (min-width: 600px) {
            body {
                font-size: 16px;
            }
        }

        @media all and (max-width: 599px) and (min-width: 20px) {
            body {
                font-size: 13px;
            }

        }

        input.form-control,
        .btn {
            border-radius: 30px;
        }

        .btn {
            text-transform: uppercase;
        }

        .center {
            text-align: center;
            position: relative;
            top: 20vh;
            margin: 9px;
        }

        .answer {
            position: relative;
            margin: auto;
            left: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row center">

            <div class="col-md-4 offset-md-4">

                <h1>Mini Wiki</h1>

                <form method="GET">

                    <div class="form-group">

                        <label for="wiki">What do you want to search?</label>
                        <input type="text" class="form-control" id="text" aria-describedby="text" placeholder="Search for Boat, Albert einstein ..." name="wiki" value="<?php if (isset($_GET["wiki"])) {
                                                                                                                                                                            echo $_GET["wiki"];
                                                                                                                                                                        } ?>" required>
                    </div>

                    <button type="submit" class="btn btn-warning">Submit</button>

                </form>
            </div>
        </div>
        <div class="row center" style="margin:auto;margin-top: 50px;">
            <?php
            if ($query) { ?>
                <div class="card text-left">
                    <div class="card-body">
                        <h5 class="card-title text-secondary"> <?php echo $query ?> </h5>
                        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                        <p class="card-text text-dark"> <?php echo $result ?> </p>
                            <a href="<?php echo $wikiURL ?>" rel="noopener noreferrer" class="card-link"> View on Wikipedia </a>
                    </div>
                </div>
            <?php } else if ($error) {
                echo ('<div class="alert alert-warning answer" role="alert">' . $error . '</div>');
            }
            ?>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>

</html>