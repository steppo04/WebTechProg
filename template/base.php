<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title> 
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    
    <header>
        <h1>spotted bro</h1>
    </header>
    <nav>
        
    </nav>
    <main>
        
    </main><aside>
        <section>
           <?php require_once 'bootstrap.php';
                echo $dbh->getUsers();
           ?>
        </section>
        <section>
            
        </section>
    </aside>
    <footer>
        <p>Tecnologie Web - A.A. 2025/2026</p>
    </footer>

</body>
</html>