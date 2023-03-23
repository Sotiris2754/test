AFRAME.registerComponent("test", {

	init: function(){
	let base = document.querySelector('#modelbase');
	let p = base.getAttribute('position');
	let scene = document.querySelector('a-scene');


	this.el.addEventListener('mouseenter',function(obj){
		
		//let id = obj.path[0].id;
		 let id =obj.srcElement.id;

		if(id=='cube1'){
			//console.log(p);
			let cube = document.createElement('a-entity');
			cube.setAttribute('geometry',{
				primitive: 'box'
			});
			cube.setAttribute('material', 'color:red');
			cube.setAttribute('scale', '0.5 0.5 0.5');	
			cube.setAttribute('position','0 0.6 0');
			//cube.setAttribute('preview');  Thelw na dosei component gia na kanei rotation
			base.appendChild(cube);
			//console.log(cube);
		}


			if(id=='cube2'){
			//console.log(p);
			let cube = document.createElement('a-entity');
			cube.setAttribute('geometry',{
				primitive: 'box'
			});
			cube.setAttribute('material', 'color:green');
			cube.setAttribute('scale', '0.5 0.5 0.5');			
			cube.setAttribute('position','0 0.6 0');
			base.appendChild(cube);
			//console.log(cube);
		}


		});


	},


});



//import data from '/WebCatalog/content.json' assert { type: 'JSON' };
//const exhibits = require("./WebCatalog/content.json");

let data;
let response;

async function fetchContent()
{
	//response = await fetch("http://localhost:8000/WebCatalog/content.json"); // works - needs data = await response.json(); 
	response = await fetch("details.json"); // works - needs data = await response.json(); 
	data = await response.json();
	
	//const response = await fetch("http://localhost:8000/WebCatalog/content.json").then( response =>{console.log(response);}); // works and gets response
	//const response = await fetch("http://localhost:8000/WebCatalog/content.json").then(response => {data = response.json(); loadExhibit();});
	
}

function loadExhibit()
{
	//console.log(response);
	//console.log(data);
	
	
	if (response == null)
	{
		console.log("Not ready yet!");
		setTimeout(loadExhibit, 1000);
	}
	else
	{
		console.log("Data loaded! ") 
		//console.log(data);
	}
	
	
	
	// let fields = document.getElementsByClassName("vcorfu-content");
	
	// for (let i = 0; i < fields.length; i++)
	// {
	// 	console.log(fields[i].getAttribute('data-field'));
		
	// 	switch (fields[i].getAttribute('data-field'))
	// 	{
	// 		case "title":
	// 			fields[i].innerHTML = data.exhibits[0].title[parameters.language];
	// 		break;
			
	// 		case "text":
	// 			fields[i].innerHTML = data.exhibits[0].text[parameters.language];
	// 		break;
			
	// 		case "3d-model":
			
	// 		break;
			
	// 		case "images":
			
	// 		break;
			
	// 		case "map-field":
	// 			//fields[i].innerHTML += data.exhibits[0].gpsCoordinates.lat + ", " + data.exhibits[0].gpsCoordinates.long;
	// 			fields[i].innerHTML = "";
	// 			showExhibitOnTheMap(data.exhibits[0].gpsCoordinates.lat, data.exhibits[0].gpsCoordinates.long);
	// 		break;
	// 	}
	// }
	
}