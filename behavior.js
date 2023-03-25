//Εμφάνιση db στο console, ασύγχρονα. Δεν λειτουργεί!!

// fetch('test.php')
//   .then(response => response.json())
//   .then(data => console.log(data));


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

	let base;
	let previousBase;
	let sameBase;

	AFRAME.registerComponent("show-list", {

	init: function(){
	var myDiv = document.querySelector("#myDiv");


		 this.el.addEventListener('click',function(){
		 		base=this; // Αποθήκευση βάσης που επιλέχθηκε από τον χρήστη
				myDiv.innerHTML = displayDescription();

				checkBase();
			 	console.log(base.id); 
			 	if(sameBase==true){
			 		if(myDiv.style.visibility==="hidden"){
			 			myDiv.style.visibility = "visible";
			 		}
			 		else{
			 			myDiv.style.visibility= "hidden";
			 		}
				 }
			 	if(sameBase==false){
			 		myDiv.style.visibility = "visible";
			 	}

		 })
	},
});

	function checkBase(){
		if (base==previousBase){		
			sameBase=true;
			//console.log("einai idies");
		}	
		if(base!=previousBase){	
			sameBase = false;
			//console.log("DEN einai idies");
		}
		previousBase = base;
	}


	function displayDescription(){
		var text="";
		text+= "<ul>";
		text+= "<h4><i>Διάλεξε ποιο έκθεμα θέλεις να τοποθετηθεί στην βάση</i>: " + base.id + "</h4>";
		for(var i=0; i<data.exhibits.length; i++){			
			text+= "<li> <i id="+data.exhibits[i].id+" onclick='placeExhibit(this)'> "+data.exhibits[i].title+ "</i>" + ": "; //Με το "this" παίρνω τα στοιχεία του κειμένου που επιλέχθηκε από τον χρήστη, συνεπώς και το έκθεμα που επέλεξε.
			text+= data.exhibits[i].description+ " <br></li>";
		}
		text+= "</ul>";
		//console.log(text);
		return text;
	}


function placeExhibit(entity){
		//console.log(exhibit);

		var id = entity.getAttribute('id');

		// console.log(id);
		

			if(this.exhibit){
					var exhibitId = this.exhibit.getAttribute('id');
					console.log(base.childNodes.length);
					

				if(this.exhibit.parentNode==base){


					if(exhibitId!= id + "." + id){

						if(base.childNodes){
							for (var i = base.childNodes.length - 1; i >= 0; i--) {
   				 			if (base.childNodes[i].tagName === 'A-ENTITY') {
      						base.removeChild(base.childNodes[i]);
    						}
  						}
						}


	    			var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('stored',true);
						base.appendChild(exhibit);
						this.exhibit = exhibit;

					}

				}
				if(this.exhibit.parentNode!=base){

					if(exhibitId!=id + "." + id){

						if(base.childNodes){
							for (var i = base.childNodes.length - 1; i >= 0; i--) {
   				 			if (base.childNodes[i].tagName === 'A-ENTITY') {
      						base.removeChild(base.childNodes[i]);
    						}
  						}
						}						

						var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('stored',true);
						base.appendChild(exhibit);
						this.exhibit = exhibit;

					}
					else{
						// this.exhibit.parentNode.removeChild(this.exhibit);
	    			// this.exhibit = null;
						if(base.childNodes){
							for (var i = base.childNodes.length - 1; i >= 0; i--) {
   				 			if (base.childNodes[i].tagName === 'A-ENTITY') {
      						base.removeChild(base.childNodes[i]);
    						}
  						}
						}

	    			var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('stored',true);
						base.appendChild(exhibit);
						this.exhibit = exhibit;
					}
				}						
			}
			else{
					var exhibit = document.createElement('a-entity');
		
					exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
					// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

					exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
					exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					exhibit.setAttribute('id',id+"."+id);
					exhibit.setAttribute('stored',true);
					base.appendChild(exhibit);
					this.exhibit = exhibit;
			}



}

