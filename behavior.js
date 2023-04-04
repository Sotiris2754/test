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


	AFRAME.registerComponent("show-list", {

	init: function(){
	var myDiv = document.querySelector("#myDiv");


		 this.el.addEventListener('click',function(){
		 		base=this; // Αποθήκευση βάσης που επιλέχθηκε από τον χρήστη
		 		
				//<!-- ...............  -->

				// Εδώ θα τρέχει μια function για να τσεκάρει αν υπάρχει αυτή η βάση στην βάση δεδομένων. Αν όχι, τότε θα κάνει INSERT!

				//<!-- ...............  -->
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
		text+= "<h4><i>Διάλεξε ποιο έκθεμα θέλεις να τοποθετηθεί στην βάση</i>: (" + base.id + ")</h4>";
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


		console.log(id);

		// console.log(id);
		

			if(this.exhibit){
					var exhibitId = this.exhibit.getAttribute('id');
					//console.log(base.childNodes.length);
					
					

				if(this.exhibit.parentNode==base){


					if(exhibitId!= id + "." + id){
						removeChild(base);

	    			var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('stored',true);
						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();

					}

				}
				if(this.exhibit.parentNode!=base){

					if(exhibitId!=id + "." + id){
						removeChild(base);						

						var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('stored',true);
						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();

					}
					else{
						// this.exhibit.parentNode.removeChild(this.exhibit);
	    				// this.exhibit = null;
						removeChild(base);

	    				var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('stored',true);
						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();
					}
				}						
			}
			else{
						removeChild(base);				


					var exhibit = document.createElement('a-entity');
		
					exhibit.setAttribute('position',0 +" " + 1 +" " + 0); 
					// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });

					exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
					exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					exhibit.setAttribute('id',id+"."+id);
					exhibit.setAttribute('stored',true);
					base.appendChild(exhibit);
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

		    		for (var i=1; i<=4; i++){
		    			base = document.getElementById(i);
		    			removeChild();
						//console.log(json[i]);
						if(json[i-1]!=null){

		    				var exhibit = document.createElement('a-entity');
							exhibit.setAttribute('position',0 +" " + 1 +" " + 0);
							exhibit.setAttribute('gltf-model',`url(${data.exhibits[json[i-1]].pathfile})`);
							exhibit.setAttribute('scale',data.exhibits[json[i-1]].scale);
							exhibit.setAttribute('id',json[i-1]+"."+json[i-1]);
							base.appendChild(exhibit);							
						}
					}					
	    		}
	  		},
	 		error: function(xhr, status, error) {
	   		console.log("An error occurred: " + error);
	  		}		
		});
		
	}

function removeChild(){
		//console.log(base);	
		if(base.childNodes){
			for (var k = base.childNodes.length -1; k >= 0; k--) {
   				if (base.childNodes[k].tagName === 'A-ENTITY') {
      				base.removeChild(base.childNodes[k]);
    			}	
			}
		}
}