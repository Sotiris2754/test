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
}

	let base;
	let previousBase;
	let sameBase;
	let count=4;
	let text="";


	AFRAME.registerComponent("show-list", {

	init: function(){
	var myDiv = document.querySelector("#myDiv");
		 this.el.addEventListener('click',function(){
		 		base=this; // Αποθήκευση βάσης που επιλέχθηκε από τον χρήστη
		 		
				//<!-- ...............  -->

				// Εδώ θα τρέχει μια function για να τσεκάρει αν υπάρχει αυτή η βάση στην βάση δεδομένων. Αν όχι, τότε θα κάνει INSERT!

				//<!-- ...............  -->
				// myDiv.style.visibility = "visible"
				myDiv.innerHTML = displayDescription();

				checkBase();
			 	console.log(base.id); 
			 	// if(sameBase==true){
			 	// 	if(myDiv.style.visibility==="hidden"){
			 	// 		myDiv.style.visibility = "visible";
			 	// 	}
			 	// 	else{
			 	// 		myDiv.style.visibility= "hidden";
			 	// 	}
				//  }
			 	// if(sameBase==false){
			 	// 	myDiv.style.visibility = "visible";
			 	// }
		 })
	},
});

	function displayDescription(){
		if(text==="")
		{		
				text+= "<ul>";
				text+= "<h4><i>Διάλεξε ποιο έκθεμα θέλεις να τοποθετηθεί στην βάση</i>: (" + base.id + ")</h4>";
				for(var i=0; i<data.exhibits.length; i++){			
					text+= "<li id="+data.exhibits[i].id+" onclick='placeExhibit(this)'> <b>"+data.exhibits[i].title+ "</b>" + ": "; //Με το "this" παίρνω τα στοιχεία του κειμένου που επιλέχθηκε από τον χρήστη, συνεπώς και το έκθεμα που επέλεξε.
					text+= data.exhibits[i].description+ " <br></li>";
				}
				text+= "</ul>";
				//console.log(text);
				return text;
			}
			else{
				text="";
				return text;
				// console.log(myDiv.innerHTML);
			}
	}

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

function placeExhibit(entity){
		//console.log(exhibit);

		var id = entity.getAttribute('id');
		// console.log(id);		
		console.log(this.exhibit);
			if(this.exhibit){
					var exhibitId = this.exhibit.getAttribute('id');
					console.log(exhibitId);

				if(this.exhibit.parentNode==base){
					// console.log(this.exhibit.parentNode);

					if(exhibitId!= id + "." + id){
					removeChild(base);

	    			var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
						if(id!=0)
						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);

						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();
					}

				}
				if(this.exhibit.parentNode!=base){

					if(exhibitId!=id + "." + id){
						removeChild(base);						
						var exhibit = document.createElement('a-entity');
						exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
						if(id!=0)
						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();

					}
					else{
						// this.exhibit.parentNode.removeChild(this.exhibit);
	    				// this.exhibit = null;
						removeChild(base);

	    				var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
						if(id!=0)
						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);

						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();
					}
				}						
			}
			else{
					removeChild(base);				

					var exhibit = document.createElement('a-entity');
		
					exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
					// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
					if(id!=0)
					exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
					exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					exhibit.setAttribute('id',id+"."+id);
					base.appendChild(exhibit);
					console.log(exhibit);
					this.exhibit = exhibit;
					storeData();
			}
	function storeData(){
	  $.ajax({
	  url: "sqlite.php",
	  method: "POST",
	  data: { id:base.id, exhibit:data.exhibits[id].id , action:"store"},
	  success: function(response) {
	    console.log("Selection stored successfully.");
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
			url:"sqlite.php",
			method:"POST",
			data: {action:"view"},
			success: function(json) {
	    		console.log("Success Response");
	    		var json = JSON.parse(json);
	    		//console.log(json);
				if (data == null)
				{
					console.log("2nd Not ready yet!");
					setTimeout(retrieveData(),1);
				}
				else{
		    		for (var i=0; i<json.length; i++){
		    		count = json.length;

					var stand = document.createElement('a-entity');
					stand.setAttribute('id',data.stands[i].id);
					stand.setAttribute('show-list','show-list');
					stand.setAttribute('position',data.stands[i].position);
					stand.setAttribute('gltf-model',`url(${data.stands[i].pathfile})`);
					stand.setAttribute('rotation',data.stands[i].rotation);
					// stand.setAttribute('scale',data.stands[i].scale);
					stand.setAttribute('class','clickable stand');
					scene.appendChild(stand);

		    			// base = document.getElementById(i); THA XRISIMOPOIISW TIN METAVLITI "STAND"
		    			removeChild();
						//console.log(json);
						if(json[i]!=null){
		    				var exhibit = document.createElement('a-entity');
							exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0);
							if(json[i]!=0)
							exhibit.setAttribute('gltf-model',`url(${data.exhibits[json[i]].pathfile})`);
							exhibit.setAttribute('scale',data.exhibits[json[i]].scale);
							exhibit.setAttribute('id',json[i]+"."+json[i]);
							exhibit.setAttribute('class','clickable');
							stand.appendChild(exhibit);
						}
					}					
	    		}
	  		},
		
		});
	}

function removeChild(){
		if(base!=null){
		if(base.childNodes){
			for (var k = base.childNodes.length -1; k >= 0; k--) {
   				if (base.childNodes[k].tagName === 'A-ENTITY') {
      				base.removeChild(base.childNodes[k]);
    			}	
			}
		}
	}
}

function addBases(){
	if(data.stands.length>count){
		var stand = document.createElement('a-entity');
		stand.setAttribute('id',data.stands[count].id);
		stand.setAttribute('show-list','show-list');
		stand.setAttribute('position',data.stands[count].position);
		stand.setAttribute('gltf-model',`url(${data.stands[count].pathfile})`);
		stand.setAttribute('rotation',data.stands[count].rotation);
		stand.setAttribute('class','clickable stand');
		scene.appendChild(stand);
		count++;
		base = stand;
		addBaseToServer();
		//console.log(base);
	}
	else
		return;
}

function removeBases(){
	if(count>4){
		removeBaseFromServer();
		
		var stand = document.getElementById(count);
		console.log(stand);
		scene.removeChild(stand);
		count--;
	}

	
}


	function addBaseToServer(){
		console.log('Prosthese vasi');
		$.ajax({
			url: "sqlite.php",
			method:"POST",
			data: {action:"add"},
			success: function(response) {
		    console.log("Base added successfully.");
		  	}
		});
	}

	function removeBaseFromServer(){
		$.ajax({
			url: "sqlite.php",
			method:"POST",
			data: {action:"remove"},
			success: function(response) {
		    console.log("Base removed successfully.");
		  	}
		});
	}	