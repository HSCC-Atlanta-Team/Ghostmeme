<?php


$caps=["<div class='grid-item'>
<button>
    <img src='_9f4h399uytrtyuio98uytr.jpg'></img>
</button>
</div>
","<div class='grid-item'>
<button>
    <img src='_joi0dbg45owplttu2vbm.png'></img>
</button>
</div>
","<div class='grid-item'>
<button>
    <img src='_39hgwz10mrktkgui.png'></img>
</button>
</div>
","<div class='grid-item'>
<button>
    <img src='_30htif3biw2bbsjwtfr35weut8fh.png'></img>
</button>
</div>
","<div class='grid-item'>
<button>
    <img src='_ke1dnvevtfrdc676dcr7.jpg'></img>
</button>
</div>
","<div class='grid-item'>
<button>
    <img src='_8rhwdq0u4039nhfp0t59.png'></img>
</button>
</div>"];
shuffle($caps);
$caps=array_values($caps);
echo $caps;



echo '<div class="grid-container" required>';
foreach($caps as $cappy){
    echo $cappy;
}
echo '</div>';


?>





<html>
    <head>
        <title>Login to Ghostmeme</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <form class="captcha" >
      
    <style>
    .grid-container {
    display: inline-grid;
    grid-template-columns: auto auto auto;
    background-color: #2196F3;
    padding: 5px;
    }

    .grid-item {
    background-color: rgba(25, 255, 55, 0.8);
    border: 3px solid rgba(0, 0, 0, 0);
    padding: 0px;
    font-size: 0px;
    text-align: center;
    }

    button {
        width: 150px;
        height: 120px;
        font-size: 30px;
        font-weight: 3px;
    }

    img {
        height: 100px;
        padding:0px
    }
    </style>
 <label>Find the $fruit</label>

<div class="grid-container">
    <div class="grid-item">
        <button>
            <img src="_9f4h399uytrtyuio98uytr.jpg"></img>
        </button>
    </div>
    <div class="grid-item">
        <button>
            <img src="_joi0dbg45owplttu2vbm.png"></img>
        </button>
    </div>
    <div class="grid-item">
        <button>
            <img src="_39hgwz10mrktkgui.png"></img>
        </button>
    </div>
    <div class="grid-item">
        <button>
            <img src="_30htif3biw2bbsjwtfr35weut8fh.png"></img>
        </button>
    </div>
    <div class="grid-item">
        <button>
            <img src="_ke1dnvevtfrdc676dcr7.jpg"></img>
        </button>
    </div>
    <div class="grid-item">
        <button>
            <img src="_8rhwdq0u4039nhfp0t59.png"></img>
        </button>
    </div>
        
    </div>

            
    </body>
</html>