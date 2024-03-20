<!--- Autor Name ; Israel Ogunsua  --> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Word Finder</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
            <h1> Find Synomyns </h1>
            <form action="phpinfo.php" method="GET">
            <label for="word"> Enter Word:  </label>
            <input type="text" id="word" name="word" required>
            <button type="submit">Find Synonyms</button>
            </form>
    </div>

<?php
    // Show all information, defaults to INFO_ALL
    //phpinfo();

    //$synonyms =[];

    if ($_GET["word"]) {
        // Retrieve the word from the form
        $search_word = $_GET["word"];

        $thesaurus_content = file_get_contents("thesaurus.txt") or die("Unable to open file!");     
        // Split the content into an array of lines
        $lines = explode("\n", $thesaurus_content);

        // Loop through each line to find the search word
        foreach ($lines as $line) {
            // Split the line into parts separated by commas
            $parts = explode(",", $line);
            
            //echo "$parts[0] </br> ";
            // Check if the first part matches the search word
            if ($parts[0] == $search_word) {
                // Extract synonyms and limit to 20
                $synonyms = array_slice($parts, 1, 20);
                
                break;
            }

        }
        
        echo "
        <div class='main'>
            <div class= 'box'>
                <h3> Looking for word: <i> $search_word </i> </h3> 
                ";
            if (empty($synonyms)) { // Giving an error message if not found
                echo " <h2>The word '$search_word' not found in the thesaurus find something else.</h2>";
                
            } else {
                echo"
                <h3> Similar words for $search_word: </h3>";
                
                for ($i = 0; $i < count($synonyms); $i++) { 
                    echo "<a href=\"phpinfo.php?word=" . urlencode($synonyms[$i]) . "\"> " . $synonyms[$i] . " , </a>";
                }

            }
        echo "</div></div>";   
        
    }

?>
</body>
</html>
