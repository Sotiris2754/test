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
	let transparent = 0;
	// insertTilesToDatabase();
	let displayPos;

// AFRAME.registerComponent('pop-up',{
// 	init:function(){
// 		let exhibit = this.el;
		
// 		exhibit.addEventListener('click', (event) => {

// 			if(exhibit.classList.contains('exhibit')) {
				
// 				const popup = document.querySelector('#popup');
// 				popup.setAttribute();

// 			}
// 		});
// 	}
// });


AFRAME.registerComponent('image-hover', {
	init: function(){
		var kid = this.el;
		let image = document.querySelector('#imagePreview');
		var parent = kid.parentNode;
		let size = parent.children.length;
		let pos;
		let rot;
		// console.log(parent);

		let container = document.querySelectorAll("a-gui-flex-container");

		const kidArray1 = Array.from(container[0].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
		let index1 = kidArray1.indexOf(kid);

		const kidArray2 = Array.from(container[2].children);
		// console.log(kidArray2); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
		let index2 = kidArray2.indexOf(kid);



		kid.addEventListener('mouseenter', function(){
			// console.log(parent.children.length);
			// console.log(kidArray2);
		// console.log(parent.getAttribute('rotation'));
		pos = parent.getAttribute('position');
		rot = parent.getAttribute('rotation');
		// console.log(rot);
		// console.log(size);

			if(size==3){
				image.setAttribute('visible',true);
				// console.log(parent);
				// console.log(rot);

				image.setAttribute('position', pos.x + ' ' + (pos.y + 0.6) + ' ' + pos.z);
				image.setAttribute('rotation', rot.x + ' ' + rot.y + ' ' + rot.z);
				console.log(image.getAttribute('rotation'));

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
			if(size>4){
				// console.log(index2);

				image.setAttribute('visible',true);
				let grandParent = parent.parentNode;
				pos = grandParent.getAttribute('position');
				rot = grandParent.getAttribute('rotation');
				// console.log(grandParent.getAttribute('position'));
				// console.log(rot);

				// var value = kid.getAttribute('value');
				image.setAttribute('position', pos.x  + ' ' + (pos.y + 0.6) + ' ' + pos.z );
				image.setAttribute('rotation', rot.x + ' ' + rot.y + ' ' + rot.z);
				// console.log(image.getAttribute('rotation'));
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
			// console.log("Vgika apo to element");
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
            { position: { x: -2.65, y: 0.45, z: -7 }, rotation: { x: 90, y: 90, z: 0 }, depth:2, height:0.1, rows:1, columns:3, centerPos: { x:-0.9, y:1.6, z:-4.5 }, centerRot:{ x:0, y:90, z:0}, pleura: "wall" },

            { position: { x: -2.2, y: -0.5, z: -7 }, rotation: { x: 90, y:90, z: 0 }, depth:0.1, height:1, rows:1, columns:3, centerPos: { x:-0.9, y:1.6, z:-4.5 }, centerRot:{ x:0, y:90, z:0}, pleura: "floor" },


              // Front wall
            { position: { x: 1.8, y: 0.45, z: -11 }, rotation: { x: 90, y: 0, z: 90 }, depth:2, height:0.1, rows:1, columns:3, centerPos: { x:0.45, y:1.6, z:-4.5 }, centerRot:{ x:0, y:-90, z:0}, pleura: "wall" },

            { position: { x: 1.35, y: -0.5, z: -11 }, rotation: { x: 90, y:0, z: 90 }, depth:0.1, height:1, rows:1, columns:3, centerPos: { x:0.45, y:1.6, z:-4.5 }, centerRot:{ x:0, y:-90, z:0}, pleura: "floor" },


              // Back wall
            { position: { x: 7, y: 0.45, z: -4.86 }, rotation: { x: 90, y: 90, z: 90 }, depth:2, height:0.1, rows:1, columns:4, centerPos: { x:4.5, y:1.6, z:-2 }, centerRot:{ x:0, y:0, z:0}, pleura: "wall" },

            { position: { x: 7, y: -0.5, z: -4.4 }, rotation: { x: 90, y:90, z: 90 }, depth:0.1, height:1, rows:1, columns:4, centerPos: { x:4.5, y:1.6, z:-2 }, centerRot:{ x:0, y:0, z:0}, pleura: "floor" },


             // Left wall
            { position: { x: 14, y: 0.45, z: -0.45 }, rotation: { x: 90, y: 180, z: 0 }, depth:2, height:0.1, rows:1, columns:6, centerPos: { x:4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: 14, y: -0.5, z: -0.9 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:6, centerPos: { x:4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" },




              
            { position: { x: -9.7, y: 0.45, z: -4.9 }, rotation: { x: 90, y: 0, z: 0 }, depth:2, height:0.1, rows:1, columns:2, centerPos: { x:-4.5, y:1.6, z:-2.25 }, centerRot:{ x:0, y:0, z:0}, pleura: "wall" },

            { position: { x: -9.7, y: -0.5, z: -4.45 }, rotation: { x: 90, y:0, z: 0 }, depth:0.1, height:1, rows:1, columns:2, centerPos: { x:-4.5, y:1.6, z:-2.25 }, centerRot:{ x:0, y:0, z:0}, pleura: "floor" },


              
            { position: { x: -4.5, y: 0.45, z: -0.45 }, rotation: { x:90, y: 180, z: 0 }, depth:2, height:0.1, rows:1, columns:6, centerPos: { x:-4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: -4.5, y: -0.5, z: -0.9 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:6, centerPos: { x:-4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" },


            { position: { x: -16.55, y: 0.45, z: -2.65 }, rotation: { x: 90, y: 90, z: 0 }, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:-7.75, y:1.6, z:-1.35 }, centerRot:{ x:0, y:90, z:0}, pleura: "wall" },

            { position: { x: -16.05, y: -0.5, z: -2.65 }, rotation: { x: 90, y:90, z: 0 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:-7.75, y:1.6, z:-1.35 }, centerRot:{ x:0, y:90, z:0}, pleura: "floor" },




            { position: { x: 15.3, y: 0.45, z: -2.65 }, rotation: { x: 90, y: 0, z: 90 }, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:7.15, y:1.6, z:-1.35 }, centerRot:{ x:0, y:-90, z:0}, pleura: "wall" },

            { position: { x: 14.9, y: -0.5, z: -2.65 }, rotation: { x: 90, y:0, z: 90 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:7.15, y:1.6, z:-1.35 }, centerRot:{ x:0, y:-90, z:0}, pleura: "floor" },



            { position: { x: -0.5, y: 0.45, z: 1.5 }, rotation: { x: 90, y: 180, z: 0}, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:-0.25, y:1.6, z:0.3 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: -0.5, y: -0.5, z: 1 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:-0.25, y:1.6, z:0.3 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" }


          ];
          


          walls.forEach((wall, index) => {
            this.createGrid(wall.position, wall.rotation, size, wall.depth, wall.height, gap, wall.rows, wall.columns, index, wall.centerPos, wall.centerRot, wall.pleura);
          });


          // window.addEventListener('keydown', (event) => {
          //   if (event.key === 't') { // Change 't' to any key you prefer
          //     this.toggleTiles();

          //   }
          // });



          

        },
        createGrid: function (position, rotation, size, depth, height, gap, rows, columns, wallIndex, centerPos,centerRot, pleura) {
          const el = this.el;
          const gridContainer = document.createElement('a-entity');
          // gridContainer.setAttribute('scale','0.5 0.5 0.5');
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
              tile.setAttribute('color', '#697565');
              // tile.setAttribute('material', {src:'#gradient'});
              if(pleura=='floor'){
              	// tile.setAttribute('material','color: #d203fc; opacity: 0.8');
              	// tile.setAttribute('material', {src:'#gradient'});
              	tile.setAttribute('color', '#ECDFCC');
              }
              tile.setAttribute('class', 'gridtile enable ' + `${pleura}`);
              tile.setAttribute('data-x', j);
              tile.setAttribute('data-y', i);
              tile.setAttribute('datawall', wallIndex); // Store the wall index
              tile.setAttribute('show-gui',"");
              tile.setAttribute('material', {opacity:transparent});
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

						if(event.target.classList.contains('exhibit')){

					  	// const previousSelectedTile = document.querySelector('.gridtile.selected');
							const popup = document.querySelector('#frame');

					  	let arg = event.target.id.split('.')[0]; //keeping the first digit of the exhibits id (1.1, 2.2 etc)

					  	popUpValue2(arg,centerPos,centerRot);
					  }
					});
        },

        toggleTiles: function () {
          this.tilesEnabled = !this.tilesEnabled; // Toggle the state

            if(transparent===100)
            	transparent = 0;
            else
            	transparent = 100;
		          panelExhibit.setAttribute('visible',false);
		          panelExhibit.setAttribute('position','0 100 0');
		          if(tile){
		          	tile.classList.remove('selected');
		          	tile.setAttribute('color', 'lightyellow');
		        	}
          this.tiles.forEach(tile => {
            tile.setAttribute('material', {opacity:transparent}); // Toggle visibility
            tile.classList.toggle('disable', !this.tilesEnabled); // Toggle disabled class
            tile.classList.toggle('enable',this.tilesEnabled);
            


          });
        }

      });



function importExhibit(entity){
	let exhibit = document.createElement('a-entity');
	let container = document.querySelectorAll("a-gui-flex-container");
	let kid = entity;
	const kidArray = Array.from(container[2].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
	let index = kidArray.indexOf(kid);

	console.log(index);

	removeChild();	
					exhibit.setAttribute('position', data.exhibits[index].position);
					exhibit.setAttribute('rotation', "-90 0 0"); 

					if(page==2)
						index+= 5;

					exhibit.setAttribute('scale',data.exhibits[index].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					exhibit.setAttribute('id',index+"."+index);
					exhibit.setAttribute('class','clickable exhibit');
					exhibit.setAttribute("show-panel","");
					exhibit.setAttribute("pop-up","");
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
							exhibit.setAttribute('class','clickable exhibit');
							exhibit.setAttribute("pop-up","");
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


					// storeDataBase();


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

	function popUpValue2(id,centerPos, centerRot){
		const popup = document.querySelector('#frame');
		let infoText = document.querySelector('#infoText');
		const popupClose = document.querySelector('#exitbutton');
		const panel = document.querySelector('#panel');

		infoText.setAttribute("value",data.exhibits[id].description);
		infoText.setAttribute('color','black');
		

		if(panelBase.getAttribute("visible")||panelExhibit.getAttribute("visible")){
		 	panelExhibit.setAttribute('visible',false);
		  panelExhibit.setAttribute('position','0 100 0');
		  panelBase.setAttribute('visible',false);
		  panelBase.setAttribute('position','0 100 0');
		 }

		if(!popup.getAttribute("visible")){
			popup.setAttribute("visible",true);
			popup.setAttribute("position", centerPos.x + ' ' + (centerPos.y + 0.2 ) + ' ' + centerPos.z);
			popup.setAttribute("rotation", centerRot.x + ' ' + centerRot.y + ' ' + centerRot.z);



		  const previousSelectedTile = document.querySelector('.gridtile.selected');
		  
		  if(previousSelectedTile){

		    if(previousSelectedTile.classList.contains('floor')){
		    	previousSelectedTile.setAttribute('color', '#ECDFCC');
		    }
		    else if(previousSelectedTile.classList.contains('wall')) {
		    	previousSelectedTile.setAttribute('color', '#697565');
		    }

				previousSelectedTile.classList.remove('selected');

			}
		}
		else{
			popup.setAttribute("visible",false);
		}
	}

</script>

<!-- <body onload="loadExhibit()"></body>  -->

	
	

 <a-scene id="scene">

				<a-assets>

					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>
					<a-asset-items id="newbuilding" src="Building/newBuilding.gltf"></a-asset-items>
					<a-asset-items id="home" src="home_test.gltf"></a-asset-items>
					<a-asset-items id="home-obj" src="home_test.obj"></a-asset-items>
					<a-asset-items id="home-mtl" src="home_test.mtl"></a-asset-items>

					<a-asset-items id="statue" src="StatueBases.obj"></a-asset-items>
<!-- 					<a-asset-items id="table1" src="table1/scene.gltf"></a-asset-items>
					<a-asset-items id="table2" src="table2/scene.gltf"></a-asset-items>
					<a-asset-items id="table3" src="table3/scene.gltf"></a-asset-items> -->

					<a-asset-items id="base1" src="models/3dbases/base3/base3.gltf"></a-asset-items>
					<a-asset-items id="base2" src="models/3dbases/base2/base2.gltf"></a-asset-items>
					<a-asset-items id="base3" src="models/3dbases/base3/base3.gltf"></a-asset-items>

					<img id="gradient" src="images/lightyellow.jpg"></img>
					<img id="image1" src="images/emptyBase.png"></img>
					<img id="image2" src="images/base2.png"></img>
					<img id="image3" src="images/base3.png"></img>
					<img id="c1" src="images/c1.png"></img>
					<img id="c2" src="images/c2.png"></img>
					<img id="c3" src="images/c3.png"></img>
					<img id="close" src="images/exit.png"></img>


				</a-assets>


<a-sky color="lightblue"></a-sky>
<!-- <a-light type="ambient" color="#FFF" intensity="1"></a-light> -->
<!-- <a-light type="directional" color="#FFF" intensity="0.3" position="-1 2 1"></a-light> -->

<a-entity scale="0.5 0.5 0.5" position="0 .5 0">

<a-entity >
<a-entity gltf-model="#building" scale="2 2 2" position="-15 -0.5 17" rotation="0 90 0"></a-entity>
</a-entity>

<a-entity grid-manager="size: 1; gap: 1;" position="0 0 0"></a-entity>

</a-entity>



<a-image id="imagePreview"  scale="0.5 0.5 0.5" position="0 1 -5" src="" visible="false" ></a-image>


<a-entity id="frame" position=" -0.2 1 -5" visible="false">

	<a-plane color="#ECDFCC" id="panel" width="1.5" height="0.75">

		<a-text  id="infoText" align="center" width="2"></a-text>
		<a-image id="exitbutton"closebutton class="clickable" src="#close" scale="0.2 0.2 0.2" position="0.6 .25 0.02"></a-image>
	
	</a-plane>	

</a-entity>


<script>

</script>



<!-- <a-box id="box" class="clickable" onclick="deleteDB()" position="-0.25 .75 -9" color="" material="src:#gradient"></a-box> -->
<!-- <a-sphere id="sphere" color="red" position="0 0 -5"></a-sphere> -->


<a-gui-label
	id="popup"
	position="0 1 -4"
	font-size="0.1"
	width="0.75"
	height="1"
	line-Height="1"
	visible="false"

>
	
</a-gui-label>

<a-gui-flex-container id="panelBase" width="5.5" height="2" position="0 100 0" rotation="0 90 0" panel-color="#072B73" opacity="0.8" flex-direction="row" justify-content="center" align-items="center" scale=".25 .25 0.5" visible="false">

	<a-gui-button 
						onclick="importBase(this)"
						class=""
						margin="0 0.3 0 0"
						width="1.5" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Empty"
						image-hover
						bevel="true"
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


<a-gui-flex-container id="panelExhibit" scale=" 0.25 0.25 .5" flex-direction="column" width="9" height="2" position="0 100 0" panel-color="#072B73" opacity="0.8" justify-content="center" align-items="center" visible="false" >

		<a-gui-flex-container flex-direction="row" position="0 0 0" rotation="0 0 0" justify-content="center"  panel-color="#072B73" opacity="0.8" visible="true">


					<a-gui-button 
								onclick="importExhibit(this)" 
								id="0"
								margin="-0.3 0 0 0"
								class="rename"
								width="1.5" 
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="Empty base"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								

					>
					</a-gui-button>

					<a-gui-button 
								onclick="importExhibit(this)"
								class="rename"
								margin="-0.3 0 0 0.2"					
								id="1"
								width="1.5" 
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="Huge kid"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								
					>
					</a-gui-button>

					<a-gui-button
								onclick="importExhibit(this)"
								class="rename"
								margin="-0.3 0 0 0.2"	
								id="2"
								width="1.5" 
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="Bibelo bird"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								
					>
					</a-gui-button>

					<a-gui-button
								onclick="importExhibit(this)"
								class="rename"
								id="3"
								margin="-0.3 0 0 0.2"	
								width="1.5"  
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="Jar 1"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								
					>
					</a-gui-button>

					<a-gui-button
								onclick="importExhibit(this)"
								class="rename"
								id="4"
								margin="-0.3 0 0 0.2"	
								width="1.5"  
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="Jar 2"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
					>
					</a-gui-button>

				</a-gui-flex-container>

						<a-gui-flex-container flex-direction="row" justify-content="center" align-items="center" component-padding="0" width="2.20" height="1" position="0 0 0" rotation="0 0 0" panel-color="#072B73" opacity="0.8" margin="-.2 0 -.20 0">  
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

	<a-camera wasd-controls="acceleration:30" id="camera">
		
			<a-entity  id="cursor" raycaster="objects:.clickable, [gui-interactable], .info" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere;radius:0.008" material="color:orange;" position="0 0 -.5;"  animation__color=" property:material.color; from:#FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
	</a-camera>

</a-scene> 



<script>



</script>
</body>
</html>





