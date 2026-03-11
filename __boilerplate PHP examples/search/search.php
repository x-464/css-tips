<?php

    include "db_connect.php";

    // helper function to automation highlighting
    function highlight($rString, $query){
        // turns the query into an array of it's words
        $words = explode(" ", $query);

        // goes around each word
        foreach($words as $word){
            // surrounds that word in rString (results string) with <mark> (browser auto highlights)
            $rString = str_ireplace($word, "<mark>$word</mark>", $rString);
        };

        // returns string with highlights
        return $rString;
    };

    // gets the query from the URL
    $query = isset($_GET["q"]) ? trim($_GET["q"]) : "";

    // FULLTEXT won't query with strings less than 3 characters
    if (strlen($query) < 3){
        exit("query too short");
    }

    // prefixes each word with + and suffixes with *
    // + means word must exist in results (required)
    // * means the result only needs to start with this (wildcard)
    $boolQuery = "+" . str_replace(" ", "* +", $query) . "*";

    // SQL to get rows where the name and description match user query
    // uses boolean mode to do wildcard searching
    $stmt = $pdo->prepare("SELECT id, name, description, price, 
    MATCH(name, description) AGAINST(? IN BOOLEAN MODE) AS relevance 
    FROM searchdata 
    WHERE MATCH(name, description) AGAINST(? IN BOOLEAN MODE) 
    ORDER BY relevance DESC");

    $stmt->execute([$boolQuery, $boolQuery]);

    $results = $stmt->fetchall();

    // makes sure there is a result
    if (empty($results)){
        echo "no results";
    }
    else{
        // echos back HTML to show to the user
        // uses highlight function to highlight queried words
        foreach($results as $result){
            echo "<div class='itemName'>" . highlight($result["name"], $query) . "</div>";
            echo "<div class='itemDesc'>" . highlight($result["description"], $query) . "</div>";
            echo "<div class='itemPrice'>$" . highlight(number_format($result["price"], 2), $query) . "</div>";
        }
    }
?>