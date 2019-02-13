<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Acme Inc.</title>
    </head>
    <body>
        <div id="content">
       <div id="header">
           <header>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/header.php'; ?>
             
        </header> 
           <div id="nav">
             <nav>
            <?php /* include $_SERVER['DOCUMENT_ROOT'].'/acme/common/nav.php'; */?>
            <?php echo $navList; ?> 
             </nav>
           </div>
       </div>
        <main>
            <h1>
                Welcome To Acme!
            </h1>
            <div id="container">
            <?php 
                if (isset($featureBuild)) {
                    echo $featureBuild;
                }
            ?>
<!--                <div id="review">
                    <h3>Acme Rocket Reviews</h3>
                        <ul>
                            <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                            <li>"That thing was fast!" (4/5)</li>
                            <li>"Talk about fast delivery." (5/5)</li>
                            <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                            <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                        </ul>
                </div>-->
                <div id="recipes">
                    <h3>Featured Recipes</h3>
                    <table>
                        <tr>
                            <td>
                                <img src="/acme/images/recipes/bbqsand.jpg" alt="bbq sandwich"> 
                            </td>
                            <td>
                                <img src="/acme/images/recipes/potpie.jpg" alt="potpie">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><a href="#" title="sandwich">Pulled RoadRunner BBQ</a></p>
                            </td>
                            <td>
                                <p><a href="#" title="pot pie">Roadrunner Pot Pie</a></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="/acme/images/recipes/soup.jpg" alt="roadrunner soup">
                            </td>
                            <td>
                                <img src="/acme/images/recipes/taco.jpg" alt="roadrunner taco">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><a href="#" title="Soup">Roadrunner Soup</a></p>
                            </td>
                            <td>
                                <p><a href="#" title="Tacos">Roadrunner tacos</a></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>