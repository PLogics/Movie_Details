<?php
if (!empty($_REQUEST['search'])) {
    $search = $_REQUEST['search'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q='$search'",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: imdb8.p.rapidapi.com",
            "X-RapidAPI-Key: ef3a744889msh54543f67e8243f4p1c80f1jsn0c15bde67a47"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $decoded = json_decode($response, true);
    }
} else {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q='g'",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: imdb8.p.rapidapi.com",
            "X-RapidAPI-Key: ef3a744889msh54543f67e8243f4p1c80f1jsn0c15bde67a47"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $decoded = json_decode($response, true);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/mdbstyle.css">
    <title>Movies Info</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="row height d-flex align-items-center">
                <div class="col-md-12">
                    <form method="get" action="">
                        <div class="search">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control" placeholder="Type movie" name="search" />
                            <input type="submit" class="bt1" value="Search" />
                    </form>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="main1">
            <div class="main2">

                <?php
                foreach ($decoded as $val) {
                    if (is_array($val) || is_object($val)) {
                        foreach ($val as $i) {
                ?>

                            <div class="container2">
                                <a href="info.php?id=<?php echo $i['id'] ?>">
                                    <?php if (empty($i['i']['imageUrl'])) {
                                    ?>
                                        <img src="./images/logo.png" class="image">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="<?php if (!empty($i['i']['imageUrl'])) echo $i['i']['imageUrl'] ?>" alt="Image Processing" class="image">
                                    <?php
                                    }
                                    ?>
                                </a>
                                <div class="movie-info">
                                    <div><label>Movie Title: </label><?php if (!empty($i['l'])) echo $i['l'] ?></div>
                                    <div><label>Rank: </label><?php if (!empty($i['rank'])) echo $i['rank'] ?></div>
                                    <div><label>Actors & Actoress: </label><?php if (!empty($i['s'])) echo $i['s'] ?></div>
                                    <div><label>Year: </label><?php if (!empty($i['y'])) echo $i['y'] ?></div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </section>
</body>

</html>