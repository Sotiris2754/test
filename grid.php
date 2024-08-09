<!DOCTYPE html>
<html>
<head>
	<!-- ---------------- -->
	
	<!-- Versions of the building. Default version 1.0.4-->
	<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>

	<!-- <script src="aframe-master.js"></script> -->
  <script src="js/aframe-gui.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


	<title>3V Grid</title>
	<script src="OptBehavior.js"></script>



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
	

	let thesi;
	const worldPosition = new THREE.Vector3();
	let tile;
	let counter=0;
	let transparent = 100;
	// insertTilesToDatabase();


AFRAME.registerComponent('image-hover', {
	init: function(){
		var kid = this.el;
		let image = document.querySelector('#imagePreview');
		var parent = kid.parentNode;
		let size = parent.children.length;

		let container = document.querySelectorAll("a-gui-flex-container");

		const kidArray1 = Array.from(container[0].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
		let index1 = kidArray1.indexOf(kid);

		const kidArray2 = Array.from(container[1].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
		let index2 = kidArray2.indexOf(kid);



		kid.addEventListener('mouseenter', function(){

			// console.log(parent.children.length);
			// console.log(kidArray2);
			if(size==3){
				image.setAttribute('visible',true);
				var pos = parent.getAttribute('position');
				var rot = parent.getAttribute('rotation');

				// var value = kid.getAttribute('value');
				image.setAttribute('position', pos.x + ' ' + (pos.y + 1.1) + ' ' + pos.z);
				image.setAttribute('rotation', rot.x + ' ' + rot.y + ' ' + rot.z);
				// console.log(index2);
				switch(index1) {
				  case 0:
				    image.setAttribute('src','#image1');

				    break;

				  case 1:
				    
				    image.setAttribute('src','#image2');
				    
				    break;

				  case 2:
				  // Add more cases as needed
				  	image.setAttribute('src','#image3');
				  	break;
				}				
			}
			if(size>5){
				console.log(index2);

				image.setAttribute('visible',true);
				var pos = parent.getAttribute('position');
				var rot = parent.getAttribute('rotation');

				// var value = kid.getAttribute('value');
				image.setAttribute('position', pos.x  + ' ' + (pos.y + 0.5) + ' ' + (pos.z + 1.2));
				image.setAttribute('rotation', rot.x + ' ' + rot.y + ' ' + rot.z);
				// console.log(index2);
				switch(index2) {
				  case 0:
				     //Keno image
				  	image.setAttribute('src','');
				    break;

				  case 1:
				    
				    // console.log("megali 3d");
				    image.setAttribute('src','');
				    
				    break;

				  case 2:
				  // Add more cases as needed
				  	image.setAttribute('src','#c1');
				  	break;

				  case 3:
				    image.setAttribute('src','#c2');

				    break;

				  case 4:
				    image.setAttribute('src','#c3');

				    break;

				}
			}


		});



		kid.addEventListener('mouseleave', function(){
			console.log("Vgika apo to element");
			image.setAttribute('position','0 100 0');
			// parent.setAttribute('position','0 100 0');

		})
	}
});


AFRAME.registerComponent('grid-manager', {
        schema: {
          size: {type: 'number', default: 5}, // number of tiles on one side
          gap: {type: 'number', default: 1}, // gap between tiles
          walls: {type: 'array', default: []},
          depth: {type: 'number', default: 1},
          height: {type: 'number', default: 1},
          pleura: {type: 'string', default: "wall"}
          
        },
        init: function () {
          const data = this.data;
          const el = this.el;
          const size = data.size;
          const gap = data.gap;
          const depth = data.depth;
          const height = data.height;
          const pleura = data.pleura;
          

          this.tilesEnabled = true;
          this.tiles = [];


          // const rows = data.rows;
          // const columns = data.columns;

          const walls = [
            { position: { x: -2.65, y: 0.45, z: -7 }, rotation: { x: 90, y: 90, z: 0 }, depth:2, height:0.1, rows:1, columns:3, centerPos: { x:-1.5, y:1.8, z:-9 }, centerRot:{ x:0, y:90, z:0}, pleura: "wall" },

            { position: { x: -2.2, y: -0.5, z: -7 }, rotation: { x: 90, y:90, z: 0 }, depth:0.1, height:1, rows:1, columns:3, centerPos: { x:-1.5, y:1.8, z:-9 }, centerRot:{ x:0, y:90, z:0}, pleura: "floor" },


              // Front wall
            { position: { x: 1.8, y: 0.45, z: -11 }, rotation: { x: 90, y: 0, z: 90 }, depth:2, height:0.1, rows:1, columns:3, centerPos: { x:1, y:1.8, z:-9 }, centerRot:{ x:0, y:-90, z:0}, pleura: "wall" },

            { position: { x: 1.35, y: -0.5, z: -11 }, rotation: { x: 90, y:0, z: 90 }, depth:0.1, height:1, rows:1, columns:3, centerPos: { x:1, y:1.8, z:-9 }, centerRot:{ x:0, y:-90, z:0}, pleura: "floor" },


              // Back wall
            { position: { x: 7, y: 0.45, z: -4.86 }, rotation: { x: 90, y: 90, z: 90 }, depth:2, height:0.1, rows:1, columns:4, centerPos: { x:9, y:1.8, z:-4 }, centerRot:{ x:0, y:0, z:0}, pleura: "wall" },

            { position: { x: 7, y: -0.5, z: -4.4 }, rotation: { x: 90, y:90, z: 90 }, depth:0.1, height:1, rows:1, columns:4, centerPos: { x:9, y:1.8, z:-4 }, centerRot:{ x:0, y:0, z:0}, pleura: "floor" },


             // Left wall
            { position: { x: 14, y: 0.45, z: -0.45 }, rotation: { x: 90, y: 180, z: 0 }, depth:2, height:0.1, rows:1, columns:6, centerPos: { x:9, y:1.8, z:-1 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: 14, y: -0.5, z: -0.9 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:6, centerPos: { x:9, y:1.8, z:-1 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" },




              // Right wall
            { position: { x: -9.7, y: 0.45, z: -4.9 }, rotation: { x: 90, y: 0, z: 0 }, depth:2, height:0.1, rows:1, columns:2, centerPos: { x:-9, y:1.8, z:-4.5 }, centerRot:{ x:0, y:0, z:0}, pleura: "wall" },

            { position: { x: -9.7, y: -0.5, z: -4.45 }, rotation: { x: 90, y:0, z: 0 }, depth:0.1, height:1, rows:1, columns:2, centerPos: { x:-9, y:1.8, z:-4.5 }, centerRot:{ x:0, y:0, z:0}, pleura: "floor" },


              // Top wall
            { position: { x: -4.5, y: 0.45, z: -0.45 }, rotation: { x:90, y: 180, z: 0 }, depth:2, height:0.1, rows:1, columns:6, centerPos: { x:-9, y:1.8, z:-1 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: -4.5, y: -0.5, z: -0.9 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:6, centerPos: { x:-9, y:1.8, z:-1 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" },


            { position: { x: -16.55, y: 0.45, z: -2.65 }, rotation: { x: 90, y: 90, z: 0 }, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:-16, y:1.8, z:-2.7 }, centerRot:{ x:0, y:90, z:0}, pleura: "wall" },

            { position: { x: -16.05, y: -0.5, z: -2.65 }, rotation: { x: 90, y:90, z: 0 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:-16, y:1.8, z:-2.7 }, centerRot:{ x:0, y:90, z:0}, pleura: "floor" },




            { position: { x: 15.3, y: 0.45, z: -2.65 }, rotation: { x: 90, y: 0, z: 90 }, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:14.8, y:1.8, z:-2.7 }, centerRot:{ x:0, y:-90, z:0}, pleura: "wall" },

            { position: { x: 14.9, y: -0.5, z: -2.65 }, rotation: { x: 90, y:0, z: 90 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:14.8, y:1.8, z:-2.7 }, centerRot:{ x:0, y:-90, z:0}, pleura: "floor" },



            { position: { x: -0.5, y: 0.45, z: 1.5 }, rotation: { x: 90, y: 180, z: 0}, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:-0.5, y:1.8, z:1 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: -0.5, y: -0.5, z: 1 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:-0.5, y:1.8, z:1 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" } // Bottom wall


          ];
          


          walls.forEach((wall, index) => {
            this.createGrid(wall.position, wall.rotation, size, wall.depth, wall.height, gap, wall.rows, wall.columns, index, wall.centerPos, wall.centerRot, wall.pleura);
          });


          window.addEventListener('keydown', (event) => {
            if (event.key === 't') { // Change 't' to any key you prefer
              this.toggleTiles();
            }
          });



          

        },
        createGrid: function (position, rotation, size, depth, height, gap, rows, columns, wallIndex, centerPos,centerRot, pleura) {
          const el = this.el;
          const gridContainer = document.createElement('a-entity');
          gridContainer.setAttribute('position', position.x + ' ' + position.y + ' ' + position.z);
          gridContainer.setAttribute('rotation', rotation.x + ' ' + rotation.y + ' ' + rotation.z);

          // gridContainer.setAttribute('position', `${position.x} ${position.y} ${position.z}`);
      		// gridContainer.setAttribute('rotation', `${rotation.x} ${rotation.y} ${rotation.z}`);
          gridContainer.setAttribute('class', 'wallgrid');

          for (let i = 0; i < rows; i++) {
            for (let j = 0; j < columns; j++) {
              const x = j * (size + gap);
              const z = i * (size + gap);
              const tile = document.createElement('a-box');
              tile.setAttribute('id', counter);
              tile.setAttribute('position', `${x} 0 ${z}`);
              tile.setAttribute('width', size);
              tile.setAttribute('height', height); // Thin height for the tiles
              tile.setAttribute('depth', depth);
              tile.setAttribute('color', 'lightyellow');
              tile.setAttribute('class', 'gridtile enable ' + `${pleura}`);
              tile.setAttribute('data-x', j);
              tile.setAttribute('data-y', i);
              tile.setAttribute('datawall', wallIndex); // Store the wall index
              tile.setAttribute('show-gui',"");
              gridContainer.appendChild(tile);
              // insertTilesToDatabase();
              this.tiles.push(tile);
              counter++;
            }
          }

          el.appendChild(gridContainer);

					gridContainer.addEventListener('click', (event) => {

					  const x = event.target.getAttribute('data-x');
					  const y = event.target.getAttribute('data-y');
					  const wallIndex = event.target.getAttribute('datawall');

					  const panelExhibit = document.querySelector("#panelExhibit");
					  const panelBase = document.querySelector('#panelBase');


					//CLICK STA TILES --------> TOPOTHETISI PANEL GIA EISAGWGI EKTHEMATOS

					  if (event.target.classList.contains('gridtile')) {

              const previousSelectedTile = document.querySelector('.gridtile.selected');


		          if (event.target.classList.contains('selected')) {
		            previousSelectedTile.setAttribute('color', 'lightyellow');
		            previousSelectedTile.classList.remove('selected');
		            panelExhibit.setAttribute('visible',false);
		            panelExhibit.setAttribute('position','0 100 0');
		            panelBase.setAttribute('visible',false);
		            panelBase.setAttribute('position','0 100 0');

		            // console.log(`Tile selected at (${x}, ${y}) on wall ${wallIndex}`);
		          }
							else{
							    
							    if(previousSelectedTile){
							    	previousSelectedTile.setAttribute('color','lightyellow');
							    	previousSelectedTile.classList.remove('selected');
							    }
							    
							    event.target.setAttribute('color', 'green');
							    event.target.classList.add('selected');

							  	if(event.target.classList.contains('wall')){
							  		panelBase.setAttribute('visible',false);
							  		panelBase.setAttribute('position','0 100 0');
							  		panelExhibit.setAttribute('visible',true);
								    panelExhibit.setAttribute("position", centerPos.x + ' ' + centerPos.y + ' ' + centerPos.z);
								    panelExhibit.setAttribute("rotation", centerRot.x + ' ' + centerRot.y + ' ' + centerRot.z); 
							  	}

							  	else if(event.target.classList.contains('floor')){
							  		panelExhibit.setAttribute('visible',false);
							  		panelExhibit.setAttribute('position','0 100 0');
							  		panelBase.setAttribute('visible',true);
								    panelBase.setAttribute("position", centerPos.x + ' ' + centerPos.y + ' ' + centerPos.z);
								    panelBase.setAttribute("rotation", centerRot.x + ' ' + centerRot.y + ' ' + centerRot.z);
							  	}

							    
							    
							    tile = event.target;
							    // thesi = event.target.object3D;
							    // thesi.getWorldPosition(worldPosition);
							    // console.log(`Tile selected at (${x}, ${y}) on wall ${wallIndex}`);

							}
					  }
					});
        },

        toggleTiles: function () {
          this.tilesEnabled = !this.tilesEnabled; // Toggle the state

            if(transparent===100)
            	transparent = 0;
            else
            	transparent = 100;

          this.tiles.forEach(tile => {
            tile.setAttribute('material', {opacity:transparent}); // Toggle visibility
            tile.classList.toggle('disable', !this.tilesEnabled); // Toggle disabled class
            tile.classList.toggle('enable',this.tilesEnabled);

          });
        }

      });


//End of costum component Grid-Manager ----------------------------

// function insertTilesToDatabase(){
// 						$.ajax({
// 							url:"sql.php",
// 							method: "POST",
// 							data: {id:counter, action:"insert"},
// 							success: function(){
// 								console.log("Eginan insert ta tiles stin vasi");
// 							},
// 							error: function(xhr, status, error){
// 								console.log("An error occurred: " + error);
// 							}
// 						});
// 					}


function importExhibit(entity){
	let exhibit = document.createElement('a-entity');
	let container = document.querySelectorAll("a-gui-flex-container");
	let kid = entity;
	const kidArray = Array.from(container[1].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
	let index = kidArray.indexOf(kid);

	console.log(index);

	removeChild();	
					exhibit.setAttribute('position', data.exhibits[index].position);
					exhibit.setAttribute('rotation', "-90 0 0"); 

					if(page==2)
						index+= 5;

					exhibit.setAttribute('scale',data.exhibits[index].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					exhibit.setAttribute('id',index+"."+index);
					exhibit.setAttribute('class','clickable');
					exhibit.setAttribute("show-panel","");
					
					tile.appendChild(exhibit);
					if(index!=0)
					exhibit.setAttribute('gltf-model',`url(${data.exhibits[index].pathfile})`);
					// else
					// 	exhibit.remove(); //Einai to idio me to "exhibit.remove();"
					storeData();
					// console.log(exhibit);
					// this.exhibit = exhibit;


	function storeData(){

	  $.ajax({
	  url: "sql.php",
	  method: "POST",
	  data: { id:tile.id, exhibit:data.exhibits[index].id, action:"store"},
	  success: function(response) {
	    console.log("Selection stored successfully.");
	    // console.log(id);
	    // console.log(exhibit);
	   	//console.log(response);
	  },
	  		error: function(xhr, status, error) {
	    	console.log("An error occurred: " + error);
	  		}
		});
	}
}

	function retrieveData(){
		$.ajax({
			url:"sql.php",
			method:"POST",
			data: {action:"retrieve"},
			success: function(res) {
				
	    		console.log("Success Response");
	    		var json = JSON.parse(res);
	    		// console.log(json);
				if (data == null)
				{
					console.log("2nd Not ready yet!");
					setTimeout(retrieveData(),1);
				}
				else{
					console.log("Exhibits have been loaded successfully");
		    	for (var i=0; i<json.length; i++){
		    		let testId = document.getElementById(json[i].id);
		    		// console.log(testId);
		    	// // count = json.length;
		    	// console.log(data.exhibits[i].id +" " +data.exhibits[i].pathfile + "\n");


					
					if(json[i].exhibit!= null){
							var exhibit = document.createElement('a-entity');		
							exhibit.setAttribute('id',data.exhibits[json[i].exhibit].id+"."+data.exhibits[json[i].exhibit].id);
							exhibit.setAttribute('scale',data.exhibits[json[i].exhibit].scale);
							exhibit.setAttribute('position', data.exhibits[json[i].exhibit].position );
							exhibit.setAttribute('rotation', "-90 0 0"); 
							exhibit.setAttribute('class','clickable');
							testId.appendChild(exhibit);
							if(json[i].exhibit!=0)
								exhibit.setAttribute('gltf-model',`url(${data.exhibits[json[i].exhibit].pathfile})`);
							// else
							// 	exhibit.remove();	
					}
					if(json[i].base!=null){
							var base = document.createElement('a-entity');
							base.setAttribute('position', "0 0 0" );
							base.setAttribute('rotation', "-90 0 0");
							base.setAttribute('scale',data.stands[json[i].base].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
							base.setAttribute('id',"test");
							if(json[i].base!=0)
							base.setAttribute('gltf-model',`url(${data.stands[json[i].base].pathfile})`);
							testId.appendChild(base);
					}
	    		 }
	  		}
	  	}
		
		});
	}

function importBase(entity){
	let base = document.createElement('a-entity');

	let container = document.querySelectorAll("a-gui-flex-container");
	let kid = entity;
	const kidArray = Array.from(container[0].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
	let index = kidArray.indexOf(kid);
	// console.log(kid);
	console.log(index);


	// console.log(kidArray);

	removeChild();

					base.setAttribute('position', "0 0 0" );
					base.setAttribute('rotation', "-90 0 0");

					base.setAttribute('scale',data.stands[index].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					base.setAttribute('id',"test");
					// base.setAttribute('class','clickable');
					
					if(index!=0)
					base.setAttribute('gltf-model',`url(${data.stands[index].pathfile})`);

					tile.appendChild(base);


					storeDataBase();


	function storeDataBase(){
	  $.ajax({

	  url: "sql.php",
	  method: "POST",
	  data: { id:tile.id, base:data.stands[index].id, action:"storebase"},
	  success: function(response) {
	    console.log("Selection stored successfully.");
	    // console.log(id);
	    // console.log(exhibit);
	   	//console.log(response);
	  },
	  		error: function(xhr, status, error) {
	    	console.log("An error occurred: " + error);
	  		}
		});
	}
}
function deleteDB(){
	  $.ajax({
	  url: "sql.php",
	  method: "POST",
	  data: {action:"delete"},
	  success: function(response) {
	    console.log("Database Deleted successfully.");
	  },
	  		error: function(xhr, status, error) {
	    	console.log("An error occurred: " + error);
	  		}
		});
}

</script>

<!-- <body onload="loadExhibit()"></body>  -->

	
	<div id="myDiv"></div> <!--ΑΝ ΜΕΤΑΚΙΝΗΣΩ ΤΟ DIV ΔΕΝ ΘΑ ΛΕΙΤΟΥΡΓΕΙ ΣΩΣΤΑ Η ΕΜΦΑΝΙΣΗ ΤΗΣ ΛΙΣΤΑΣ -->
	

 <a-scene id="scene">

				<a-assets>

					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>
					<a-asset-items id="statue" src="StatueBases.obj"></a-asset-items>
<!-- 					<a-asset-items id="table1" src="table1/scene.gltf"></a-asset-items>
					<a-asset-items id="table2" src="table2/scene.gltf"></a-asset-items>
					<a-asset-items id="table3" src="table3/scene.gltf"></a-asset-items> -->

					<a-asset-items id="base1" src="models/3dbases/base3/base3.gltf"></a-asset-items>
					<a-asset-items id="base2" src="models/3dbases/base2/base2.gltf"></a-asset-items>
					<a-asset-items id="base3" src="models/3dbases/base3/base3.gltf"></a-asset-items>

					<img id="image1" src="images/emptyBase.png"></img>
					<img id="image2" src="images/base2.png"></img>
					<img id="image3" src="images/base3.png"></img>
					<img id="c1" src="images/c1.png"></img>
					<img id="c2" src="images/c2.png"></img>
					<img id="c3" src="images/c3.png"></img>


				</a-assets>


<a-sky color="lightblue"></a-sky>
<!-- <a-light type="ambient" color="#FFF" intensity="1"></a-light> -->
<!-- <a-light type="directional" color="#FFF" intensity="0.3" position="-1 2 1"></a-light> -->

<a-entity >
<a-entity gltf-model="#building" scale="2 2 2" position="-15 -0.5 17" rotation="0 90 0"></a-entity>
</a-entity>

<!-- <a-entity>
<a-entity gltf-model="#c1" scale="1 1 1" position="-2 1 -3" rotation="0 0 0"></a-entity>
</a-entity> -->

<!-- <a-entity >
	<a-entity gltf-model="#c3" scale="0.004 0.004 0.004" position="-10 1.5 -12" rotation="0 0 0">
		<a-light type="directional" color="#FFF" intensity="1" position="-6 0 3"></a-light>
		<a-light type="spot" color="#FFF" intensity="1" position="-3 0 1200"></a-light>
	</a-entity>
</a-entity> -->


<a-image id="imagePreview" position="0 1 -5" src="" visible="false" ></a-image>

 <!-- <a-entity obj-model="obj: #statue;" position="0 0 -5"></a-entity> -->

 <!-- <a-entity gltf-model="#table1" scale="1 1 1" position="-1 0 -3" rotation="0 0 0"></a-entity> -->
 <!-- <a-entity gltf-model="#table2" scale="0.01 0.01 0.01" position="0 0 -5" rotation="0 0 0"></a-entity> -->
 <!-- <a-entity gltf-model="#table3" scale="6 6 6" position="0 0 -3" rotation="0 0 0"></a-entity> -->



<a-box id="box" class="clickable" onclick="deleteDB()" position="-.5 0 -14" color="blue"></a-box>
<!-- <a-sphere id="sphere" color="red" position="0 0 -5"></a-sphere> -->

<a-entity grid-manager="size: 1; gap: 1;" position="0 0 0"></a-entity>

<a-gui-flex-container id="panelBase" width="5.5" height="2" position="0 100 0" rotation="0 90 0" panel-color="#072B73" opacity="0.8" flex-direction="row" justify-content="center" align-items="center" scale=".5 .5 1" visible="false">

	<a-gui-button 
						bevel="true"
						onclick="importBase(this)"
						class=""
						margin="0 0.3 0 0"
						width="1.5" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Empty"
						image-hover
						bevel-size="0.08"
						bevel-thickness="0.02"
	>
			</a-gui-button>

	<a-gui-button 
						bevel="true"
						onclick="importBase(this)"
						class=""
						margin="0 0 0 0"
						width="1.5" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Base2"
						image-hover
						bevel-size="0.08"
						bevel-thickness="0.02"
	>
			</a-gui-button>

	<a-gui-button 
						bevel="true"
						onclick="importBase(this)"
						class=""
						margin="0 0 0 0.3"
						width="1.5" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Base3"
						image-hover
						bevel-size="0.08"
						bevel-thickness="0.02"
	>
			</a-gui-button>
	
</a-gui-flex-container>

<a-gui-flex-container id="panelExhibit" scale=".5 .5 1" flex-direction="column" justify-content="center" align-items="center" width="2.25"height="6" position="0 100 0" rotation="0 0 0" panel-color="#072B73" opacity="0.8" visible="false">


			<a-gui-button bevel="true"
						onclick="importExhibit(this)" 
						id="0"
						class="rename"
						margin="0 0 .2 0"
						width="2" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Empty base"
						image-hover
						bevel-size="0.08"
						bevel-thickness="0.02"

			>
			</a-gui-button>

			<a-gui-button 
						onclick="importExhibit(this)"
						class="rename"
						margin="0 0 .2 0"						
						id="1"
						width="2" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Huge kid"
						image-hover
			>
			</a-gui-button>

			<a-gui-button
						onclick="importExhibit(this)"
						class="rename"
						margin="0 0 .2 0"
						id="2"
						width="2" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Bibelo bird"
						image-hover
			>
			</a-gui-button>

			<a-gui-button
						onclick="importExhibit(this)"
						class="rename"
						margin="0 0 .2 0"
						id="3"
						width="2" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Jar 1"
						image-hover
			>
			</a-gui-button>

			<a-gui-button
						onclick="importExhibit(this)"
						class="rename"
						margin="0 0 .2 0"
						id="4"
						width="2" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Jar 2"
						image-hover
			>
			</a-gui-button>


				<a-gui-flex-container scale="1 1 1" flex-direction="row" justify-content="center" align-items="center" component-padding="0" width="2.20" height="1" position="0 0 0" rotation="0 0 0" panel-color="#072B73" opacity="0.8" margin="0 0 -.20 0">  
					<!-- #072B73 -->

							<a-gui-icon-label-button
								width=".5" height="0.5"
								onclick="previousPage()"
								icon="F2F5"
								icon-font="assets/fonts/fa-solid-900.ttf"
								font-family="assets/fonts/PressStart2P-Regular.ttf"
								font-size="0.3"
								margin="0 0 0 0"
								rotation="0 0 180"
							>
							</a-gui-icon-label-button>

							<a-gui-icon-label-button
								width=".5" height="0.5"
								onclick="nextPage()"
								icon="F2F5"
								icon-font="assets/fonts/fa-solid-900.ttf"
								font-family="assets/fonts/PressStart2P-Regular.ttf"
								font-size="0.3"
								margin="0 0 0 0"
								rotation="0 0 0"
							>
							</a-gui-icon-label-button>

				</a-gui-flex-container>

		</a-gui-flex-container>


	<a-camera wasd-controls="acceleration:100" id="camera">
		
			<a-entity  id="cursor" raycaster="objects:.clickable, [gui-interactable], .info, .enable" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere;radius:0.03" material="color:orange;" position="0 0 -2.5;"  animation__color=" property:material.color; from:#FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
	</a-camera>

</a-scene> 



<script>

	// function testVarFunction() {
	// 	var elements = document.querySelectorAll(".rename");

	// 	var labelValue ="";

	// 	elements.forEach(function(element) {
  //   	element.setAttribute("value", labelValue);
  // 		});
		
	// }	
		// window.test = function(label) {
		// 	label.setAttribute("value", label.id);
		// 	let panel = label.parentNode;

		// }


</script>
</body>
</html>





