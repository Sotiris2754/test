<!DOCTYPE html>
<html>
<head>
	<script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
	<title>test json</title>
	<script src="behavior.js"></script>
</head>

<style>
	#myDiv{
  position: relative;
/*  background-color: black;*/
  top:100px;
  z-index: 5;
  color: black;
/*  text-align: center;*/
	}
</style>

<script>
	fetchContent(); // LOAD JSON FILE !!

	let basePos;

	AFRAME.registerComponent("b", {

	init: function(){
	var myDiv = document.querySelector("#myDiv");

		 this.el.addEventListener('click',function(){
		 	myDiv.innerHTML = displayDescription();
		 	basePos=this.object3D.position;

		 	
		 	if(myDiv.style.visibility==="hidden"){
		 		myDiv.style.visibility = "visible";
		 	}
		 	else{
		 		myDiv.style.visibility= "hidden";
		 	}
		 })
	},
});


	function displayDescription(){
		
		var text="";
		text+= "<ul>";

		for(var i=0; i<data.exhibits.length; i++){
			
			text+= "<li> <i id="+data.exhibits[i].id+" onclick='placeExhibit(this)'> "+data.exhibits[i].title+ "</i>" + ": ";
			text+= data.exhibits[i].description+ " <br></li>";
		}
		text+= "</ul>";
		//console.log(text);
		return text;
	}


function placeExhibit(entity){

		var id = entity.getAttribute('id');
		
		var exhibit = document.createElement('a-entity');
		//console.log(id);

		exhibit.setAttribute('position',basePos.x +" " + basePos.y+1 +" " + basePos.z); // exhibit.setAttribute('position', { x: basePos.x, y: basePos.y + 1, z: basePos.z });
		exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
		exhibit.setAttribute('scale',data.exhibits[id].scale);
		scene.appendChild(exhibit);

}	

</script>

<body onload="loadExhibit()" ></body>

	
		  <div id="myDiv" style="visibility: hidden;" >

		  </div> 
	
<a-scene id="scene">

				<a-assets>

					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>

				</a-assets>


<a-sky color="lightblue"></a-sky>



		 <a-box id="base1" b class="clickable" color="red" position="-3 0 -5"></a-box> 

		 <a-box id="base2" b class="clickable" color="green" position="1 0 -5"></a-box>

			<a-camera id="camera">
		
			<a-entity  raycaster="objects:.clickable" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere; radius-inner:0.01; radius-outer:0.03; radius:0.03" material="color:orange;" position="0 0 -2.5;"  animation__color=" property:material.color; from:##FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
		
	</a-camera>

</a-scene>
</body>
</html>





