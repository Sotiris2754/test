<!DOCTYPE html>
<html>
<head>
	<script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- <script src="https://raw.githack.com/AR-js-org/AR.js/3.4.5/aframe/build/aframe-ar-nft.js"></script> -->
  <!-- <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script> -->

	<title>Test 0.1V</title>
	<script src="behavior.js"></script>
	<?php require "sqlite.php" ?>

</head>

<style>
	#myDiv{

  position: absolute;
/*  background-color: black;*/
  top:50px;
  z-index: 5;
  color: black;
/*  text-align: center;*/
	}
	ul {
  list-style: none;
  padding: 0;
  margin: 0;
	}
	h4{
	display:table;
	padding: 5px;
  margin: 5px 0;
  background-color: #FA6B4F;
  border-radius: 5px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, .7);
	}
	li{
	display:list-item;
	padding: 2px;
  margin: 5px 0;
  background-color: #F3C5BC60;
  border-radius: 5px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, .7);
	}
</style>

<script>
	fetchContent(); // LOAD JSON FILE !!
	retrieveData();
	console.log();

</script>

<body onload="loadExhibit()" ></body>

	
	<div id="myDiv"></div> <!--ΑΝ ΜΕΤΑΚΙΝΗΣΩ ΤΟ DIV ΔΕΝ ΘΑ ΛΕΙΤΟΥΡΓΕΙ ΣΩΣΤΑ Η ΕΜΦΑΝΙΣΗ ΤΗΣ ΛΙΣΤΑΣ -->
	

 <a-scene id="scene">

				<a-assets>

					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>
					<a-asset-itme id="stand" src="museum_case/scene.gltf"></a-asset-itme>

				</a-assets>


<a-sky color="lightblue"></a-sky>

<a-box class="clickable" onclick="addBases()" color="green" position="1 0 -2"></a-box>

<a-box class="clickable" onclick="removeBases()" color="red" position="-1 0 -2"></a-box>



<!-- 	<a-entity id="1" show-list gltf-model="#stand" class="clickable" position="-16 -.5 -2.5" rotation="0 -90 0"></a-entity>

	<a-entity id="2" show-list gltf-model="#stand" class="clickable" position="-2 -.5 -7" rotation="0 -90 0"></a-entity>

	<a-entity id="3" show-list gltf-model="#stand" class="clickable" position="1.2 -.5 -7" rotation="0 90 0"></a-entity>

	<a-entity id="4" show-list gltf-model="#stand" class="clickable" position="14.5 -.5 -2.5" rotation="0 90 0"></a-entity> -->

<!-- 	<a-entity id="5" show-list gltf-model="#stand" class="clickable" position="-2 -.5 -10" rotation="0 -90 0"></a-entity>

	<a-entity id="6" show-list gltf-model="#stand" class="clickable" position="1.2 -.5 -10" rotation="0 90 0"></a-entity> -->



		<!-- <a-box id="1" show-list class="clickable" color="yellow" position="-16 0 -2.5" rotation="0 -90 0"></a-box> 

		<a-box id="2" show-list onclick="myFunction()" class="clickable" color="red" position="-2 0 -7" rotation="0 -90 0"></a-box> Έχω βάλει ελληνικά id και με κενό!!! 

		 <a-box id="3" show-list class="clickable" color="green" position="1 0 -7" rotation="0 90 0"></a-box> 
		 
		 <a-box id="4" show-list class="clickable" color="blue" position="14.5 0 -2.5" rotation="0 90 0"></a-box> -->

	<a-camera wasd-controls="acceleration:40" id="camera">
		
			<a-entity  raycaster="objects:.clickable" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere;radius:0.03" material="color:orange;" position="0 0 -2.5;"  animation__color=" property:material.color; from:#FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
		
	</a-camera>
<a-entity gltf-model="#building" scale="2 2 2" position="-15 -0.5 17" rotation="0 90 0"></a-entity>

</a-scene> 

<script>


</script>
</body>
</html>





