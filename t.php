<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="teststyle.css">
</head>
<body>
    <main>
        <div class="banner"></div> <!-- banner mettre un bg-image-->
        <div class="content">
            <div class="col">
                <div class="row">
                    <div class="projet">
                        <img src="" alt="" class="logodep" width="200" height="200">
                        <div class="infoproj">
                            <h1 class="title">Poitiers</h1>
                            <h3>86 Vienne • En cours</h3>
                        </div>
                    </div>
                    <p class="descri">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores deserunt repudiandae est enim magni praesentium sunt excepturi iste aliquam, ipsam earum molestias nisi temporibus quaerat eum, porro quisquam, eveniet libero!</p>
                </div>
                <div class="row">
                    <div class="frame"></div>
                </div>
            </div>
            <hr style='width: 65%;background:black;height:2px;'>
            <br>
            <div class="warps-container">
                <h1 style='text-align:center'>Warps</h1>
                <div class="warps">
                    <h5 class="warp">Poitiers:Lycee_Nelson_Mandela</h5>
                    <h5 class="warp">Poitiers:Lycee_Bois_d_Amour</h5>
                    <h5 class="warp">Poitiers:Centre_ville</h5>
                    <h5 class="warp">Poitiers:Lycee_Victor_Hugo</h5>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
<style>
    body {
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #fff;
}
main {
    margin-top: 170px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.banner {
    width: 100%;
    height: 250px;
    /* background-color: #525252; */
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url(marseille.png);
    background-size: cover;
    background-position: center;
}
.content {
    padding: 0 10%;
    z-index: 2;
    border-radius: 50px;
}
.col {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    height: 500px;
    margin: 1rem 0;
    padding: 20px;
border-radius: 50px;
background: #ffffff;
box-shadow:  20px 20px 60px #d9d9d9,
             -20px -20px 60px #ffffff;
    transform: translateY(-30px);
}
.projet {
    display: flex;
    flex-direction: row;
    /* border: 1px solid #000; */
    align-items: center;
    padding: 10px;
}
.logodep {
    border: 3px solid #000;
    border-radius: 1.625rem;
    grid-column: 0.3;
}
.infoproj {
    grid-column: .65;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: start;
    padding: 5%;
}
.infoproj .title {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 1rem;
}

.row {
    width: 100%;
    display: flex;
    flex-direction: column;
    /* background-color: lightgray; */
    /* border: 1px solid #000; */
    /* align-items: center; */
    /* justify-content: center; */
}
.descri {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 5%;
}
.frame {
    width: 600px;
    height: 450px;
    border: 1px solid #000;
    background-color: beige;
    position: relative;
    margin: auto;
    border-radius: 1.625rem;
}

.warps-container {
    width: 30%;
    height: 220px;
    box-shadow: 20px 20px 60px #d9d9d9,
             -20px -20px 60px #ffffff;
             padding: 20px;
             border-radius: 1.625rem;
}
.warps {
    overflow-y: scroll;
}
.warp {
    padding: 15px;
    border: 1px solid #000;
    margin: 0;
}
.warp:first-child {
    border-top-left-radius: 1.625rem;
    border-top-right-radius: 1.625rem;
}
.warp:last-child {
    border-bottom-left-radius: 1.625rem;
    border-bottom-right-radius: 1.625rem;
}
</style>