<?php
include_once('livedata.php');?>
<style>
.homeweathercompass {
    position: absolute;
    width: 175px;
    height: 175px;
    text-align: center;
    margin-top: -20px;
    margin-left: -20px;
    background: none;
    z-index: 1;
}
.text {
    z-index: 10;
    margin:auto 0;
    margin-top: 60px;
    text-align:center;
    background: none;
    font-family: 'weathertext', Helvetica, Arial;
    font-size: 26px;   
    background: none;
	color:#878a8c;
	
}
.windvalue {
    font-family: 'weathertext', Helvetica, Arial;
    font-size: 26px;
    background: none;
	color:#878a8c;
}
.homeweathercompass > .homeweathercompass-line {
    position: absolute;
    z-index: 10;
    left: 25px;
    right: 25px;
    top: 25px;
    bottom: 25px;
    margin: auto;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -o-border-radius: 100%;
    -ms-border-radius: 100%;
    border-left: 8px solid rgba(95, 96, 97, .5);
    border-top: 8px solid rgba(95, 96, 97, 0.8);
    border-right: 8px solid rgba(95, 96, 97, .5);
    border-bottom: 8px solid rgba(95, 96, 97, 0.8);
    clip-path: polygon(100% 0, 100% 100%, 100% 100%, 0 100%, 0 0);
    -webkit-clip-path: polygon(100% 0, 100% 100%, 100% 100%, 0 100%, 0 0);
    -moz-clip-path: polygon(100% 0, 100% 100%, 100% 100%, 0 100%, 0 0);
    -o-clip-path: polygon(100% 0, 100% 100%, 100% 100%, 0 100%, 0 0);
    -ms-clip-path: polygon(100% 0, 100% 100%, 100% 100%, 0 100%, 0 0);
}
.homeweathercompass > .homeweathercompass-line:before {
    content: "";
    position: absolute;
    left: 4px;
    right: 4px;
    top: 4px;
    bottom: 4px;
    margin: auto;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -o-border-radius: 100%;
    -ms-border-radius: 100%;
    background-color: none;
}
.thearrow {
    position: absolute;
    z-index: 200;
    top: 0;
    left: 50%;
    margin-left: -5px;
    width: 10px;
    height: 50%;
    transform-origin: 50% 100%;
    -webkit-transform-origin: 50% 100%;
    -moz-transform-origin: 50% 100%;
    -o-transform-origin: 50% 100%;
    -ms-transform-origin: 50% 100%;
}
.thearrow:after {
    content: '';
    position: absolute;
    left: 50%;
    top: 0%;
    height: 15px;
    width: 15px;
    background-color: #f26c4f;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -o-border-radius: 100%;
    -ms-border-radius: 100%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
}
.thearrow:before {
    content: '';
    width: 6px;
    height: 6px;
    position: absolute;
    z-index: 9;
    left: 2px;
    top: -3px;
    border: 2px solid #fff;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -o-border-radius: 100%;
    -ms-border-radius: 100%;
}
.homeweathercompass > .windirectiontext {
    display: block;
    margin:auto 0;
    margin-top: 0px;
    text-align:center;
    color:#878a8c;
    font-family: "Helvetica", Arial, "Lucida Grande", sans-serif;
    font-weight: 600;
    line-height: 12px;
    font-size: 12px;
    z-index: 10;  
   
}
.windirectiontext span {
    color: #F26C4F
}
@keyframes rotate {
    0% {
        transform: rotate(<?php echo $wind_degrees -12;?>deg);
        -webkit-transform: rotate(<?php echo $wind_degrees -12;?>deg);
        -moz-transform: rotate(<?php echo $wind_degrees -12;?>deg);
        -o-transform: rotate(<?php echo $wind_degrees -12;?>deg);
        -ms-transform: rotate(<?php echo $wind_degrees -12;?>deg);
    }
    50% {
        transform: rotate(<?php echo $wind_degrees -5;?>deg);
        -webkit-transform: rotate(<?php echo $wind_degrees -5;?>deg);
        -moz-transform: rotate(<?php echo $wind_degrees -5;?>deg);
        -o-transform: rotate(<?php echo $wind_degrees -5;?>deg);
        -ms-transform: rotate(<?php echo $wind_degrees -5;?>deg);
    }
    to {
        transform: rotate(<?php echo $wind_degrees;?>deg);
        -webkit-transform: rotate(<?php echo $wind_degrees;?>deg);
        -moz-transform: rotate(<?php echo $wind_degrees;?>deg);
        -o-transform: rotate(<?php echo $wind_degrees;?>deg);
        -ms-transform: rotate(<?php echo $wind_degrees;?>deg);
    }
}
.thearrow {
    animation: rotate 1.5s both ease-in;
    -webkit-animation: rotate 1.5s both ease-in;
    -moz-animation: rotate 1.5s both ease-in;
    -o-animation: rotate 1.5s both ease-in;
    -ms-animation: rotate 1.5s both ease-in;
}
.animated .thearrow {
    animation: rotate 1.5s both ease-in;
    -webkit-animation: rotate 1.5s both ease-in;
    -moz-animation: rotate 1.5s both ease-in;
    -o-animation: rotate 1.5s both ease-in;
    -ms-animation: rotate 1.5s both ease-in;
}

</style>
<div class="updatedtimedir"><span>Updated</span> <?php  echo $update;?></div>
<div class="averagedir"><span>Average</span> <?php echo abs($wind_degreesavg);?>&deg; </div>
<div class="homeweathercompass">
<div class="homeweathercompass-line">
<div class="thearrow rotate"></div>
</div>
<div class="text">  
<div class="windvalue" id="windvalue"><?php echo  $wind_degrees;?>°</div>
</div> 

<div class="windirectiontext">
  <?php echo "";
  //wind direction value output   
  if($wind_degrees<6){echo "Due <span>North<br></span></div>";}
  else if($wind_degrees<28){echo "North North <br><span>East</span></div>";}
  else if($wind_degrees<51){echo "North <span> East<br></span></div>";}
  else if($wind_degrees<75){echo "East North<br><span>East</span></div>";}
  else if($wind_degrees<95){echo "Due <span> East<br></span></div>";}
  else if($wind_degrees<119){echo "East South<br><span>East</span></div>";}
  else if($wind_degrees<140){echo "South <span> East</span></div>";}
  else if($wind_degrees<174){echo "South South<br><span>East</span></div>";}
  else if($wind_degrees<185){echo "Due <span> South</span></div>";}
  else if($wind_degrees<208){echo "South South<br><span>West</span></div>";}
  else if($wind_degrees<230){echo "South <span> West</span></div>";}
  else if($wind_degrees<254){echo "West South<br><span>West</span></div>";}
  else if($wind_degrees<275){echo "Due <span> West</span></div>";}
  else if($wind_degrees<298){echo "West North<br><span>West</span></div>";}
  else if($wind_degrees<320){echo "North <span> West</span></div>";} 
  else if($wind_degrees<354){echo "North North<br><span>West</span></div>";}    
  else if($wind_degrees<361){echo "Due <span> North</span></div>";}
   ?></span>
</div>
</div></div>
<script>
//homeweatherstation compass jquery June 7th 2016 //
window.onload = function() {
  var circle = document.querySelector('.homeweathercompass')
  var box = document.querySelector('.thearrow');
  box.classList.add('rotate');
  var el = document.querySelector("#windvalue");}
   </script>

