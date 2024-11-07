<?php
$rss_url = 'https://www.vox.com/rss/index.xml';

$xml = simplexml_load_file($rss_url);

if ($xml === false) {
    die('Error loading RSS feed.');
}

$namespaces = $xml->getNamespaces(true);
$entries = $xml->entry;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vox RSS Feed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        .rss-item {
            background-color: white;
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .rss-item h2 {
            margin: 0;
            font-size: 1.5em;
            color: #3498db;
        }
        .rss-item p {
            font-size: 1em;
            color: #555;
        }
        .rss-item a {
            color: #3498db;
            text-decoration: none;
        }
        .rss-item a:hover {
            text-decoration: underline;
        }
        .rss-item img {
            max-width: 50%;
            height: auto;
        }
    </style>
</head>
<body>

<h1>Vox RSS Feed</h1>

<?php
foreach ($entries as $entry) {
    $title = (string)$entry->title;
    $link = (string)$entry->link['href'];
    $author = (string)$entry->author->name;
    $published = (string)$entry->published;
    $summary = (string)$entry->summary;
    $content = (string)$entry->content;
    
    echo '<div class="rss-item">';
    echo '<h2><a href="' . $link . '" target="_blank">' . $title . '</a></h2>';
    echo '<p><strong>Author:</strong> ' . $author . '</p>';
    echo '<p><strong>Published:</strong> ' . $published . '</p>';
    echo '<p><strong>Summary:</strong> ' . $summary . '</p>';

    if (preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches)) {
        $image_url = $matches[1];
        echo '<img src="' . $image_url . '" alt="Image related to article">';
    }
    
    echo '</div>';
}
?>

</body>
</html>