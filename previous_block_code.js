
FETCH BLOCKS ===========================

// fetch("details.json").then(response => response.json()).then(json => {
	// 	json.map(item => {

	// 		let entity = document.createElement('a-box');
	// 		entity.setAttribute('id',item.id);
	// 		entity.setAttribute('position',item.position);
	// 		// entity.setAttribute('src',item.pathfile);
	// 		const scene  = document.getElementById('scene');
	// 		scene.appendChild(entity);

	// 	})

	// });
// let exhibits;

// 		fetch("details.json")
// 	  	.then(response => response.json()).then(data => {
// 	   	 	exhibits = data.exhibits;
// 	   	 	console.log("asdkjas");

// 	 	 });
// let employees;

// fetch('details.json')
//   .then(response => response.json())
//   .then(data => {
//     employees = data.employees;

//   })
//   .catch(error => {
//     console.error('Failed to retrieve employees data: ', error);
//   });
==================================



JS FUNCTIONS=========================

	Mouseleave EventListener-------


		// Θελω να καταστρέφει τα αντικείμενα μόλις κάνω hover-out/mouseleave

		// this.el.addEventListener('mouseleave',function(obj){
		// 		console.log("Katastrophi kokkinoy");

		// 		let id = obj.path[0].id;

		// 		if(id=='cube1'){

		// 			base.parentNode.removeChild(item);

		// 			destroy('#cube1');
		// 		}
		// 		if(id=='cube2'){

		// 			base.parentNode.removeChild();
		// 		}
				

		// 	});
	-----------------------------


	Auto tick rotation--------

		// AFRAME.registerComponent("preview", {

		// 	tick: function(){

		// 		this.el.getObject3D("mesh").rotation.y += 0.01;
		// 	}

		// });
	-----------------------


	Video player --------------



// 	AFRAME.registerComponent("a", {

// 	init: function(){
// 	var myVideo = document.querySelector("#video01");
// 	var videoController = document.querySelector("#videoController");
// 		 this.el.addEventListener('click',function(){
 	
// 		 	if(myVideo.paused){
// 		 		myVideo.play();
// 		 		videoController.setAttribute("color","red");
// 		 		}
// 		 	else{
// 				myVideo.pause();
// 				videoController.setAttribute("color","green");
// 		 		}
// 		 })
// 	},
// });

--------------------------------


SHOW AND HIDE LIST FIRST ------------

// AFRAME.registerComponent("showlist", {

// 	init: function(){
// 		let list = document.querySelector('#list');


// 		 this.el.addEventListener('click',function(obj){ //obj == To clickable object
// 			let p = obj.srcElement.object3D.position; // p I thesi tou antikeimenou pou egine clicked
// 			list.setAttribute('visible','true'); // Emfanisi listas
// 		 })
// 	},
// });

 - - - - - - - - - - - - - - - - - - - - - - - -


// AFRAME.registerComponent("hidelist", {

// 	init: function(){
// 		let list = document.querySelector('#list');

// 		this.el.addEventListener('click',function(obj) {

// 			list.setAttribute('position','0 200 0'); // Allazw position giati me to "visible=flase" sinexizei na allilepidra o cursor 
// 			console.log('asdasd');
// 		})

// 	},

// });

 ------------------------------------------

========================================