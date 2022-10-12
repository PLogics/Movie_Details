<?php
if (!empty($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=$id",
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
    <title>Details Movies Info</title>
</head>

<body>
    <div class="detailmain">
        <button onclick="history.go(-1)">Go Back</button>
        <div class="detailcontainer2">
            <?php if (empty($i['i']['imageUrl'])) {
            ?>
                <img src="./images/logo.png" class="detailimage">
            <?php
            } else {
            ?>
                <img src="<?php echo $decoded['title']['image']['url'] ?>" alt="Image Processing" class="detailimage">
            <?php
            }
            ?>
        </div>
        <div class="detailmovie-info">
            <div><label>Movie Title:</label><?php if (!empty($decoded['title']['title'])) echo $decoded['title']['title'] ?></div>
            <div><label>Title Type:</label><?php if (!empty($decoded['title']['titleType'])) echo $decoded['title']['titleType'] ?></div>
            <div><label>Rating:</label><?php if (!empty($decoded['ratings']['rating'])) echo $decoded['ratings']['rating'] ?></div>
            <div><label>Release Date:</label><?php if (!empty($decoded['releaseDate'])) echo $decoded['releaseDate'] ?></div>
            <p>Details:<?php if (!empty($decoded['plotSummary']['text'])) echo $decoded['plotSummary']['text'] ?></p>
        </div>
    </div>
</body>

</html>