<?php
$servername = "localhost";
$username = "id11520620_alexmagnus";
$password = "49915021";
$database = "id11520620_geoface";
function perform_query($query)
{

    $dsn = 'mysql:dbname=id11520620_geoface;host=localhost';
    try {
        $db = new PDO($dsn, 'id11520620_alexmagnus', '49915021');
        $rows = $db->query($query);
        return $rows;
    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred.</p>
        <?php
        return NULL;
    }
}


function db_connect()
{

    $dsn = 'mysql:dbname=id11520620_geoface;host=localhost';
    try {
        return new PDO($dsn, 'id11520620_alexmagnus', '49915021');
    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred.</p>
        <?php
    }
}

//printa tutte le nazioni del mondo per la scelta durante la registrazione
function countries()
{

    $query = "SELECT name FROM countries";
    $rows = perform_query($query);
    if ($rows->rowCount()) {
        foreach ($rows as $row) {
            $country = $row["name"];
            print "<option> $country </option>";
        }
    }

}

//registra l'utente
function register($username, $email, $password, $country)
{

    $db = db_connect();
    $hash = password_hash($password, PASSWORD_BCRYPT);

    $username2 = $db->quote($username);
    $email2 = $db->quote($email);
    $password2 = $db->quote($hash);
    $country2 = $db->quote($country);

    $query = "INSERT INTO people (Username, Password, email, Country, pic_path, score) VALUES ($username2, $password2, $email2, $country2, '$username.jpeg',0)";
    try {
        $db->query($query);
    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred.</p>
        <?php
    }
}

//verifica il login
function verify_login($username, $password)
{
    
    $db = db_connect();
    $username = $db->quote($username);
    $query = "SELECT Password FROM people WHERE Username = $username";
    $rows = $db->query($query);

    if ($rows) {

        foreach ($rows as $row) {
            //var_dump($row);
            $correct_password = $row["Password"];

            return password_verify($password, $correct_password);
        }
    } else {
       
        return FALSE;
    }
}

//reindirizza l'utente su una determinata pagina
function redirect($url, $flash_message = NULL)
{
    if ($flash_message) {
        $_SESSION["flash"] = $flash_message;
    }
    # session_write_close();
    header("Location: $url");
    die;
}

//verifica che esista una sessione attiva
function ensure_logged_in()
{
 if (!isset($_SESSION["name"])) {
        redirect("index.php", "You must log in before you can view that page.");
    }
}

//carica le 4 risposte su una persona casuale più il nome dell'immagine
function loadquestion()
{
    $question = array();

    $query = "SELECT Username FROM people order by rand() limit 1 ";
    $rows = perform_query($query);
    if ($rows->rowCount()) {
        foreach ($rows as $row) {
            array_push($question, $row["Username"]);
            //echo "<h1> $question[0] </h1>";
        }
    }
    $username = $question[0];
    $db = db_connect();

    $username = $db->quote($username);

    $query = "SELECT continents.code as a 
                FROM countries,continents,people 
                WHERE continents.code = countries.continent_code 
            and people.Country = countries.name
            and people.Username = $username ";
    $rows = perform_query($query);
    if ($rows->rowCount()) {
        foreach ($rows as $row) {
            array_push($question, $row["a"]);
        }
    }

    $continent = $question[1];

    $continent = $db->quote($continent);

    $query = "SELECT Country 
                FROM people
                WHERE Username = $username ";
    $rows = perform_query($query);
    if ($rows->rowCount()) {
        foreach ($rows as $row) {
            array_push($question, $row["Country"]);
        }
    }

    $nativeNation = $question[2];
    $nativeNation = $db->quote($nativeNation);


    $query = "SELECT name as a 
                FROM countries
                WHERE countries.continent_code = $continent  
                and countries.name != $nativeNation order by rand() limit 1 ";
    $rows = perform_query($query);
    if ($rows->rowCount()) {
        foreach ($rows as $row) {
            array_push($question, $row["a"]);
        }
    }

    $firstNation = $question[3];
    $firstNation = $db->quote($firstNation);
    $query = "SELECT name as a 
                FROM countries
                WHERE countries.continent_code = $continent and countries.name != $firstNation
                  and countries.name != $nativeNation order by rand() limit 1 ";
    $rows = perform_query($query);
    if ($rows->rowCount()) {
        foreach ($rows as $row) {
            array_push($question, $row["a"]);
            // echo "<h1> $question[3] </h1>";
        }
    }

    $query = "SELECT name as a 
                FROM countries
                WHERE countries.continent_code != $continent order by rand() limit 1 ";
    $rows = perform_query($query);
    if ($rows->rowCount()) {
        foreach ($rows as $row) {
            array_push($question, $row["a"]);
            //echo "<h1> $question[4] </h1>";
        }
    }
    return $question;

}

//salva la risposta su una certa domanda sul database
function saveAnswer($choice, $person1, $person2)
{

    $db = db_connect();

    $dbchoice = $db->quote($choice);
    $dbperson1 = $db->quote($person1);
    $dbperson2 = $db->quote($person2);

    $query = "INSERT INTO votes (person1, country, person2) VALUES ($dbperson1, $dbchoice, $dbperson2)";

    try {
        $rows = perform_query($query);
        if ($rows->rowCount()) {
            foreach ($rows as $row) {
                return $row;
            }
        }
    } catch (PDOException $ex) {
        return "error";
    }

}

//salva il punteggio finale ottenuto durante la partita
function saveScore($score, $user)
{

    $db = db_connect();
    $dbuser = $db->quote($user);
    $oldScore = getScore($user);
    $dbscore = $db->quote($score);

    if ($oldScore < $score) {

        $query = "UPDATE People
                SET score = $dbscore
                    WHERE Username = $dbuser";

        try {
            $rows = perform_query($query);
            if ($rows->rowCount()) {
                foreach ($rows as $row) {
                    return $row;
                }
            }
        } catch (PDOException $ex) {
            return "error";
        }
    }

}

//carica dal database il punteggio massimo ottenuto in una partita
function getScore($user)
{
    $score2 = 0;
    $db = db_connect();
    $dbuser = $db->quote($user);
    $query = "SELECT score FROM people WHERE Username = $dbuser";

    try {
        $rows = perform_query($query);
        if ($rows->rowCount()) {
            foreach ($rows as $row) {
                $score2 = $row["score"];
            }
        }
    } catch (PDOException $ex) {
        return "error";
    }

    return $score2;

}

//carica dal database tutte le assegnazioni che sono state fatte sulla nostra immagine
function getOrigins($user)
{

    $db = db_connect();
    $dbuser = $db->quote($user);
    $query = "SELECT country, COUNT(country) AS number FROM votes WHERE person1 = $dbuser GROUP BY country ORDER BY number DESC ";

    try {
        $rows = perform_query($query);
        if ($rows->rowCount()) {
            foreach ($rows as $row) {
                print "<p> <span id='originsName'>$row[country]: </span><span id='originsNumber'>$row[number]</span><span> votes</span></p>";
            }
        }
        else{
            print "<h2>no votes yet</h2>";
        }
    } catch (PDOException $ex) {
        return "error";
    }

}
?>
